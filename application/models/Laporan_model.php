<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    private $table = 'laporan';

    public function get_all()
    {
        $this->db->select('laporan.*, produk.nama_produk');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id_produk = laporan.id_produk');
        $this->db->order_by('laporan.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id_laporan)
    {
        $this->db->select('laporan.*, produk.nama_produk');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id_produk = laporan.id_produk');
        $this->db->where('laporan.id_laporan', $id_laporan);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id_laporan)
    {
        $this->db->where('id_laporan', $id_laporan);
        return $this->db->delete($this->table);
    }

    public function get_by_date_range($start_date, $end_date)
    {
        $this->db->select('laporan.*, produk.nama_produk');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id_produk = laporan.id_produk');
        $this->db->where('DATE(tanggal) >=', $start_date);
        $this->db->where('DATE(tanggal) <=', $end_date);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function insert_with_update_stok($data)
    {
        // Catat laporan pembelian
        $this->db->insert('laporan', $data);

        $produk = $this->db->get_where('produk', ['id_produk' => $data['id_produk']])->row();
        if ($produk->stok < $data['jumlah']) {
            $this->session->set_flashdata('error', 'Stok tidak mencukupi!');
            redirect('admin/laporan/tambah');
            return;
        }

        // Kurangi stok produk
        $this->db->set('stok', 'stok - ' . (int)$data['jumlah'], false);
        $this->db->where('id_produk', $data['id_produk']);
        return $this->db->update('produk');
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
}
