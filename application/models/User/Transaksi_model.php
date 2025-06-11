<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function count_selesai_by_user($id_akun)
    {
        return $this->db
            ->where('id_user', $id_akun)
            ->where('status', 'selesai')
            ->count_all_results('transaksi');
    }

    public function get_by_user($id_akun)
    {
        return $this->db->select('transaksi.*, detail_transaksi.jumlah, detail_transaksi.subtotal, produk.nama_produk')
            ->from('transaksi')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi')
            ->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
            ->where('transaksi.id_user', $id_akun)
            ->order_by('transaksi.tanggal', 'DESC')
            ->get()
            ->result();
    }

    public function get_transaksi_selesai_by_user($id_user)
    {
        return $this->db->select('transaksi.tanggal, produk.nama_produk, transaksi_detail.jumlah, transaksi_detail.subtotal')
            ->from('transaksi')
            ->join('transaksi_detail', 'transaksi_detail.id_transaksi = transaksi.id_transaksi')
            ->join('produk', 'produk.id_produk = transaksi_detail.id_produk')
            ->where('transaksi.id_user', $id_user)
            ->where('transaksi.status', 'selesai')
            ->order_by('transaksi.tanggal', 'DESC')
            ->get()
            ->result();
    }
}
