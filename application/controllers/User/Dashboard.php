<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek apakah user sudah login dan berperan sebagai 'user'
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
            redirect('auth/login');
        }

        // Load model dari folder models/User/
        $this->load->model('User/Produk_model');
        $this->load->model('User/Keranjang_model');
        $this->load->model('User/Transaksi_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_akun');

        $data = [
            'produk'    => $this->Produk_model->count_all(),
            'keranjang' => $this->Keranjang_model->count_by_user($id_user),
            'selesai'   => $this->Transaksi_model->count_selesai_by_user($id_user),
        ];

        $this->load->view('user/dashboard', $data);
    }
}
