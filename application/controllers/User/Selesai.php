<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Selesai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pastikan user sudah login dan role user
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
            redirect('auth/login');
        }

        // Load model
        $this->load->model('User/Transaksi_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_akun');
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_selesai_by_user($id_user);

        $this->load->view('user/selesai', $data);
    }
}
