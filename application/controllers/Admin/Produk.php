<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }

        $this->load->model('Produk_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['produk'] = $this->Produk_model->get_all();

        //search
        $keyword = $this->input->get('q');
        if ($keyword) {
            $data['produk'] = $this->Produk_model->search($keyword);
        } else {
            $data['produk'] = $this->Produk_model->get_all();
        }

        $q = $this->input->get('q');
        $sort = $this->input->get('sort');
        $order = $this->input->get('order') === 'desc' ? 'desc' : 'asc';

        // Filter
        if ($q) {
            $this->db->like('nama_produk', $q);
        }

        // Sorting
        $allowed_sort = ['nama_produk', 'jumlah_satuan_besar', 'isi', 'harga_satuan_besar', 'harga_eceran', 'harga_jual', 'stok'];
        if (in_array($sort, $allowed_sort)) {
            $this->db->order_by($sort, $order);
        } else {
            $this->db->order_by('id_produk', 'DESC');
        }

        $data['produk'] = $this->db->get('produk')->result();
        $data['q'] = $q;
        $data['sort'] = $sort;
        $data['order'] = $order;

        $this->load->view('admin/produk/index', $data);
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $jumlah = $this->input->post('jumlah_satuan_besar');
            $isi = $this->input->post('isi');
            $harga_besar = $this->input->post('harga_satuan_besar');

            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'jumlah_satuan_besar' => $jumlah,
                'isi' => $isi,
                'harga_satuan_besar' => $harga_besar,
                'harga_eceran' => floor($harga_besar / $isi),
                'harga_satuan_besar' => $harga_besar,
                'stok' => $jumlah * $isi
            ];

            $this->Produk_model->insert($data);
            redirect('admin/produk');
        } else {
            $this->load->view('admin/produk/tambah');
        }
    }

    public function edit($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
        if (!$produk) {
            show_404();
        }

        if ($this->input->post()) {
            $jumlah = (int) $this->input->post('jumlah_satuan_besar');
            $isi = (int) $this->input->post('isi');
            $harga_satuan_besar = (int) $this->input->post('harga_satuan_besar');
            $harga_eceran = $isi > 0 ? floor($harga_satuan_besar / $isi) : 0;
            $harga_jual = (int) $this->input->post('harga_jual');
            $stok = $jumlah * $isi;

            // Gambar baru
            $gambar = $produk->gambar; // default: gambar lama
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './assets/images/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = time() . '_' . $_FILES['gambar']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $uploaded_data = $this->upload->data();
                    $gambar = $uploaded_data['file_name'];
                }
            }

            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'jumlah_satuan_besar' => $jumlah,
                'isi' => $isi,
                'harga_satuan_besar' => $harga_satuan_besar,
                'harga_eceran' => $harga_eceran,
                'harga_jual' => $harga_jual,
                'stok' => $stok,
                'gambar' => $gambar
            ];

            $this->Produk_model->update($id, $data);
            redirect('admin/produk');
        } else {
            $data['produk'] = $produk;
            $this->load->view('admin/produk/edit', $data);
        }
    }

    public function hapus($id)
    {
        $this->Produk_model->delete($id);
        redirect('admin/produk');
    }

    public function store()
    {
        $config['upload_path'] = './assets/images/produk/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 10240;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $gambar = null;
        if (!empty($_FILES['gambar']['name'])) {
            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/produk/tambah');
                return;
            }
        }

        // Hitung harga eceran dan stok
        $isi = $this->input->post('isi');
        $jumlah = $this->input->post('jumlah_satuan_besar');
        $harga_satuan_besar = $this->input->post('harga_satuan_besar');

        $data = [
            'nama_produk' => $this->input->post('nama_produk'),
            'jumlah_satuan_besar' => $jumlah,
            'isi' => $isi,
            'harga_satuan_besar' => $harga_satuan_besar,
            'harga_eceran' => floor($harga_satuan_besar / max($isi, 1)),
            'harga_jual' => $this->input->post('harga_jual'),
            'stok' => $jumlah * $isi,
            'gambar' => $gambar,
        ];

        $this->Produk_model->insert($data);
        redirect('admin/produk');
    }
}
