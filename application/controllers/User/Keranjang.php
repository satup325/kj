<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek autentikasi & role
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
            redirect('auth/login');
        }

        // Load model
        $this->load->model('User/Keranjang_model');
        $this->load->model('User/Produk_model');
        $this->load->model('User/Transaksi_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_akun');
        $data['keranjang'] = $this->Keranjang_model->get_by_user($id_user);

        $this->load->view('user/keranjang', $data);
    }

    public function tambah()
    {
        $id_akun   = $this->session->userdata('id_akun');
        $id_produk = $this->input->post('id_produk');
        $jumlah    = $this->input->post('jumlah');

        if (!$id_akun) {
            redirect('auth');
            return;
        }

        if (!$id_produk || !$jumlah) {
            $this->session->set_flashdata('error', 'Produk tidak valid.');
            redirect('user/produk');
            return;
        }

        $item = $this->Keranjang_model->get_item($id_akun, $id_produk);

        $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row();

        if ($item) {
            $total = $item->jumlah + $jumlah;
            if ($total > $produk->stok) {
                $total = $produk->stok;
            }
            $this->Keranjang_model->update_jumlah($item->id_keranjang, $total);
        } else {
            if ($jumlah > $produk->stok) {
                $jumlah = $produk->stok;
            }
            $this->Keranjang_model->insert([
                'id_akun'   => $id_akun,
                'id_produk' => $id_produk,
                'jumlah'    => $jumlah,
                'tanggal'   => date('Y-m-d H:i:s')
            ]);
        }


        redirect('user/produk');
    }

    public function hapus($id_keranjang)
    {
        $this->Keranjang_model->delete($id_keranjang);
        redirect('user/keranjang');
    }

    public function checkout()
    {
        $id_user = $this->session->userdata('id_akun');
        $keranjang = $this->Keranjang_model->get_by_user($id_user);

        if (empty($keranjang)) {
            redirect('user/keranjang');
        }
        $this->db->trans_start(); // Mulai transaksi database

        // Hitung total semua item
        $total_semua = 0;
        foreach ($keranjang as $item) {
            $total_semua += $item->harga_jual * $item->jumlah;
        }

        // Simpan ke tabel transaksi
        $this->db->insert('transaksi', [
            'id_user'  => $id_user,
            'total'    => $total_semua,
            'status'   => 'selesai',
            'tanggal'  => date('Y-m-d H:i:s')
        ]);
        $id_transaksi = $this->db->insert_id();

        // Simpan semua item ke transaksi_detail
        foreach ($keranjang as $item) {
            $subtotal = $item->harga_jual * $item->jumlah;

            $this->db->insert('transaksi_detail', [
                'id_transaksi' => $id_transaksi,
                'id_produk'    => $item->id_produk,
                'jumlah'       => $item->jumlah,
				'harga'        => $item->harga_jual,
                'subtotal'     => $subtotal
            ]);

            // Kurangi stok
            $this->Produk_model->kurangi_stok($item->id_produk, $item->jumlah);
        }

        // Hapus isi keranjang
        $this->Keranjang_model->hapus_by_user($id_user);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Checkout gagal untuk user ID: ' . $id_user);
            $this->session->set_flashdata('error', 'Checkout gagal. Silakan coba lagi.');
            redirect('user/keranjang');
            return;
        }


        redirect('user/selesai');
    }

    public function beli_langsung()
    {
        $id_akun = $this->session->userdata('id_akun');
        if (!$id_akun) {
            redirect('auth');
            return;
        }

        $id_produk = $this->input->post('id_produk');
        $jumlah = (int) $this->input->post('jumlah');

        $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row();

        if (!$produk || $jumlah < 1 || $jumlah > $produk->stok) {
            $this->session->set_flashdata('error', 'Produk tidak valid atau jumlah melebihi stok.');
            redirect('user/produk');
            return;
        }

        $subtotal = $produk->harga_jual * $jumlah;

        // Simpan ke tabel transaksi
        $this->db->insert('transaksi', [
            'id_user' => $id_akun,
            'tanggal' => date('Y-m-d H:i:s'),
            'total'   => $subtotal,
            'status'  => 'selesai' // agar konsisten dengan fungsi checkout()
        ]);


        $id_transaksi = $this->db->insert_id();

        // Simpan ke transaksi_detail
        $this->db->insert('transaksi_detail', [
            'id_transaksi' => $id_transaksi,
            'id_produk'    => $id_produk,
            'jumlah'       => $jumlah,
			'harga'        => $produk->harga_jual,
            'subtotal'     => $subtotal
        ]);


        // Kurangi stok produk
        $this->db->set('stok', 'stok - ' . $jumlah, false);
        $this->db->where('id_produk', $id_produk);
        $this->db->update('produk');

        $this->session->set_flashdata('success', 'Pembelian berhasil!');
        redirect('user/selesai'); // halaman selesai transaksi
    }
}
