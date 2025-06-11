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
        $data['produk'] = $this->Produk_model->get_all();
        $this->load->view('user/produk', $data);
    }
}
