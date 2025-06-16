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
        $periode = $this->input->get('periode');

        switch ($periode) {
            case 'harian':
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d');
                break;
            case 'mingguan':
                $start_date = date('Y-m-d', strtotime('monday this week'));
                $end_date = date('Y-m-d', strtotime('sunday this week'));
                break;
            case 'bulanan':
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-t');
                break;
            case 'tahunan':
                $start_date = date('Y-01-01');
                $end_date = date('Y-12-31');
                break;
            default:
                $start_date = null;
                $end_date = null;
                break;
        }

        if ($start_date && $end_date) {
            $data['laporan'] = $this->Laporan_model->get_by_date_range($start_date, $end_date);
        } else {
            $data['laporan'] = $this->Laporan_model->get_all();
        }

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

        $this->load->library('pdf');
        $this->pdf->loadHtml($this->load->view('admin/laporan/cetak', $data, true));
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Laporan_" . $id . ".pdf", array("Attachment" => 0));
    }

    public function cetak_filter()
    {
        $periode = $this->input->get('periode');

        switch ($periode) {
            case 'harian':
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d');
                break;
            case 'mingguan':
                $start_date = date('Y-m-d', strtotime('monday this week'));
                $end_date = date('Y-m-d', strtotime('sunday this week'));
                break;
            case 'bulanan':
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-t');
                break;
            case 'tahunan':
                $start_date = date('Y-01-01');
                $end_date = date('Y-12-31');
                break;
            default:
                $start_date = null;
                $end_date = null;
                break;
        }

        if ($start_date && $end_date) {
            $data['laporan'] = $this->Laporan_model->get_by_date_range($start_date, $end_date);
        } else {
            $data['laporan'] = $this->Laporan_model->get_all();
        }

        $data['periode'] = ucfirst($periode ?: 'Semua');

        $this->load->library('pdf');
        $this->pdf->load_view('admin/laporan/cetak_filter', $data);
        $this->pdf->render();
        $this->pdf->stream("Laporan_" . $periode . ".pdf", array("Attachment" => 0));
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
