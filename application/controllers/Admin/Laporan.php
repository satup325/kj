<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        $this->load->model('Laporan_model');
    }

    public function index()
    {
        $data['laporan'] = $this->Laporan_model->get_all();
        $this->load->view('admin/laporan/index', $data);
    }

    public function detail($id)
    {
        $data['laporan'] = $this->Laporan_model->get_by_id($id);
        if (!$data['laporan']) {
            show_404();
        }
        $this->load->view('admin/laporan/detail', $data);
    }

    public function cetak($id)
    {
        $data['laporan'] = $this->Laporan_model->get_by_id($id);
        if (!$data['laporan']) {
            show_404();
        }

        $this->load->library('pdf'); // pastikan ada library PDF
        $this->pdf->load_view('admin/laporan/cetak', $data);
        $this->pdf->render();
        $this->pdf->stream("Laporan_" . $id . ".pdf", array("Attachment" => 0));
    }

    public function store()
    {
        $data = [
            'id_produk' => $this->input->post('id_produk'),
            'jumlah' => $this->input->post('jumlah'),
            'total' => $this->input->post('total'),
            'tanggal' => date('Y-m-d H:i:s'),
        ];

        $this->load->model('Laporan_model');
        $this->Laporan_model->insert_with_update_stok($data);

        redirect('admin/laporan');
    }
}
