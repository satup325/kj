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

        // Ambil limit dan halaman dari query string
        $limit = $this->input->get('limit') ?: 5;
        $page = $this->input->get('page') ?: 1;
        $offset = ($page - 1) * $limit;

        // Ambil total transaksi selesai
        $total = $this->Transaksi_model->count_transaksi_selesai_by_user($id_user);

        // Ambil data transaksi dengan limit dan offset
        $transaksi_ids = $this->Transaksi_model->get_transaksi_ids_paginated($id_user, $limit, $offset);
        $id_list = array_map(fn($obj) => $obj->id_transaksi, $transaksi_ids);

        $raw = $this->Transaksi_model->get_transaksi_detail_by_ids($id_list);


        // Kelompokkan berdasarkan ID transaksi
        $transaksi = [];
        foreach ($raw as $row) {
            $id = $row->id_transaksi;

            if (!isset($transaksi[$id])) {
                $transaksi[$id] = [
                    'id_transaksi' => $id,
                    'tanggal' => $row->tanggal,
                    'items' => []
                ];
            }

            $transaksi[$id]['items'][] = [
                'nama_produk' => $row->nama_produk,
                'jumlah' => $row->jumlah,
                'subtotal' => $row->subtotal
            ];
        }

        $data['transaksi'] = $transaksi;
        $data['total'] = $total;
        $data['limit'] = $limit;
        $data['page'] = $page;

        $this->load->view('user/selesai', $data);
    }

    public function struk($id_transaksi)
    {
        // Load model transaksi
        $this->load->model('Transaksi_model');

        // Ambil data transaksi utama
        $transaksi = $this->Transaksi_model->get_transaksi_by_id($id_transaksi);

        // Jika tidak ditemukan
        if (!$transaksi) {
            show_404();
        }

        // Ambil detail transaksi
        $detail = $this->Transaksi_model->get_detail_by_id_transaksi($id_transaksi);

        // Ambil data user
        $user = $this->db->get_where('akun', ['id_akun' => $transaksi->id_user])->row();

        // Load view struk
        $this->load->view('user/struk', compact('transaksi', 'detail', 'user'));
    }

    public function struk_pdf($id_transaksi)
    {
        $this->load->model('Transaksi_model');

        $transaksi = $this->Transaksi_model->get_transaksi_by_id($id_transaksi);
        if (!$transaksi) {
            show_404();
        }

        $detail = $this->Transaksi_model->get_detail_by_id_transaksi($id_transaksi);
        $user = $this->db->get_where('akun', ['id_akun' => $transaksi->id_user])->row();

        $this->load->library('pdf');
        $html = $this->load->view('user/struk_pdf', compact('transaksi', 'detail', 'user'), true);
        $this->pdf->loadHtml($html);
        $this->pdf->render();
        $this->pdf->stream("struk_transaksi_{$id_transaksi}.pdf", ['Attachment' => true]);
    }
}
