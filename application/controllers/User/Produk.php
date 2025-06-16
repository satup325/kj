<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Cek login dan role
		if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
			redirect('auth/login');
		}

		$this->load->model('User/Produk_model');
	}

	public function index()
	{
		$this->load->library('pagination');

		$limit = $this->input->get('limit') ?? 5;
		$page = $this->input->get('page') ?? 1;
		$offset = ($page - 1) * $limit;
		$keyword = $this->input->get('keyword');

		if ($keyword) {
			$data['produk'] = $this->Produk_model->search($keyword, $limit, $offset);
			$total_rows = $this->Produk_model->count_search($keyword);
		} else {
			$data['produk'] = $this->Produk_model->get_paginated($limit, $offset);
			$total_rows = $this->Produk_model->count_all();
		}

		// Pagination manual (tanpa library CI)
		$data['total_rows'] = $total_rows;
		$data['limit'] = $limit;
		$data['page'] = $page;
		$data['keyword'] = $keyword;
		$data['total_pages'] = ceil($total_rows / $limit);

		$this->load->view('user/produk', $data);
	}
}
