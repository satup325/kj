<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    public function count_by_user($id_akun)
    {
        return $this->db->where('id_akun', $id_akun)->count_all_results('keranjang');
    }


    public function get_by_user($id_akun)
    {
        return $this->db->select('keranjang.*, produk.nama_produk, produk.harga_jual, produk.gambar')
            ->from('keranjang')
            ->join('produk', 'produk.id_produk = keranjang.id_produk')
            ->where('keranjang.id_akun', $id_akun)
            ->get()
            ->result();
    }

    public function get_item($id_akun, $id_produk)
    {
        return $this->db->get_where('keranjang', [
            'id_akun' => $id_akun,
            'id_produk' => $id_produk
        ])->row();
    }

    public function update_jumlah($id_keranjang, $jumlah)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->update('keranjang', ['jumlah' => $jumlah]);
    }

    public function insert($data)
    {
        $this->db->insert('keranjang', $data);
    }

    public function delete($id_keranjang)
    {
        $this->db->delete('keranjang', ['id_keranjang' => $id_keranjang]);
    }

    public function hapus_by_user($id_akun)
    {
        $this->db->delete('keranjang', ['id_akun' => $id_akun]);
    }
}
