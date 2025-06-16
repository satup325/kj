<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function get_all()
    {
        $this->db->select('
            transaksi.id_transaksi,
            transaksi.tanggal,
            transaksi.total,
            transaksi.id_user,
            transaksi_detail.jumlah,
            transaksi_detail.subtotal,
            produk.nama_produk
        ');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi.id_transaksi = transaksi_detail.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = transaksi_detail.id_produk');
        $this->db->order_by('transaksi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id_transaksi)
    {
        $this->db->select('
            transaksi.id_transaksi,
            transaksi.tanggal,
            transaksi.total,
            transaksi.id_user,
            transaksi_detail.jumlah,
            transaksi_detail.harga,
            transaksi_detail.subtotal,
            produk.nama_produk
        ');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi.id_transaksi = transaksi_detail.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = transaksi_detail.id_produk');
        $this->db->where('transaksi.id_transaksi', $id_transaksi);
        return $this->db->get()->result();
    }

    public function get_by_date_range($start_date, $end_date)
    {
        $this->db->select('
            transaksi.id_transaksi,
            transaksi.tanggal,
            transaksi.total,
            transaksi_detail.jumlah,
            transaksi_detail.subtotal,
            produk.nama_produk
        ');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi.id_transaksi = transaksi_detail.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = transaksi_detail.id_produk');
        $this->db->where('DATE(transaksi.tanggal) >=', $start_date);
        $this->db->where('DATE(transaksi.tanggal) <=', $end_date);
        $this->db->order_by('transaksi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_last_id_transaksi()
    {
        $this->db->select_max('id_transaksi');
        $result = $this->db->get('transaksi')->row();
        return $result->id_transaksi ?? 0;
    }

    public function count_filtered($periode)
    {
        $this->apply_periode_filter($periode);
        return $this->db->count_all_results('transaksi');
    }

    public function get_filtered($periode, $limit, $offset)
    {
        $this->db->select('
        transaksi.id_transaksi,
        transaksi.tanggal,
        transaksi.total,
        transaksi_detail.jumlah,
        transaksi_detail.subtotal,
        produk.nama_produk
    ');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail', 'transaksi.id_transaksi = transaksi_detail.id_transaksi');
        $this->db->join('produk', 'produk.id_produk = transaksi_detail.id_produk');
        $this->apply_periode_filter($periode);
        $this->db->order_by('transaksi.tanggal', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    private function apply_periode_filter($periode)
    {
        $today = date('Y-m-d');
        if ($periode == 'harian') {
            $this->db->where('DATE(transaksi.tanggal)', $today);
        } elseif ($periode == 'mingguan') {
            $monday = date('Y-m-d', strtotime('monday this week'));
            $sunday = date('Y-m-d', strtotime('sunday this week'));
            $this->db->where('DATE(transaksi.tanggal) >=', $monday);
            $this->db->where('DATE(transaksi.tanggal) <=', $sunday);
        } elseif ($periode == 'bulanan') {
            $this->db->where('MONTH(transaksi.tanggal)', date('m'));
            $this->db->where('YEAR(transaksi.tanggal)', date('Y'));
        } elseif ($periode == 'tahunan') {
            $this->db->where('YEAR(transaksi.tanggal)', date('Y'));
        }
    }

    public function count_all()
    {
        return $this->db->count_all('transaksi');
    }
}
