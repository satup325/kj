<?php
class Produk_model extends CI_Model
{
    public function get_all()
    {
        $this->db->order_by('nama_produk', 'ASC');
        return $this->db->get('produk')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('produk', ['id_produk' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_produk', $id);
        return $this->db->update('produk', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_produk', $id)->delete('produk');
    }

    // ✅ Untuk tampilan default (urut A-Z)
    public function get_paginated($limit, $offset)
    {
        $this->db->order_by('nama_produk', 'ASC'); // Urutkan A-Z
        return $this->db->get('produk', $limit, $offset)->result();
    }

    // ✅ Untuk pencarian dengan keyword dan pagination
    public function search($keyword, $limit, $offset)
    {
        $this->db->like('nama_produk', $keyword);
        $this->db->order_by('nama_produk', 'ASC'); // ini penting
        return $this->db->get('produk', $limit, $offset)->result();
    }


    // ✅ Untuk hitung total hasil pencarian
    public function count_search($keyword)
    {
        $this->db->like('nama_produk', $keyword);
        return $this->db->count_all_results('produk');
    }

    public function get_stok_menipis()
    {
        return $this->db->where('stok <=', 5)
            ->order_by('nama_produk', 'ASC')
            ->get('produk')
            ->result();
    }

    public function count_all()
    {
        return $this->db->count_all('produk');
    }
}
