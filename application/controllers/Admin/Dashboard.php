<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url');

    // Cek login
    if (!$this->session->userdata('logged_in')) {
      redirect('auth/login');
    }

    // Cek role admin
    if ($this->session->userdata('role') !== 'admin') {
      show_error('Akses ditolak. Halaman ini hanya untuk admin.', 403, 'Forbidden');
    }

    $this->load->model('Produk_model');
    $this->load->model('User_model');
    $this->load->model('Laporan_model');
  }

  public function index()
  {
    $data['produk'] = $this->Produk_model->count_all();
    $data['user'] = $this->User_model->count_all();
    $data['laporan'] = $this->Laporan_model->count_all();

    $this->load->view('admin/dashboard', $data);
  }
}
