<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	public function count_all()
	{
		return $this->db->count_all('produk');
	}

	public function get_all()
	{
		return $this->db->get('produk')->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('produk', ['id_produk' => $id])->row();
	}

	public function kurangi_stok($id_produk, $jumlah)
	{
		$this->db->set('stok', 'stok - ' . (int)$jumlah, false);
		$this->db->where('id_produk', $id_produk);
		$this->db->update('produk');
	}

	public function get_paginated($limit, $offset)
	{
		return $this->db->get('produk', $limit, $offset)->result();
	}

	public function search($keyword, $limit, $offset)
	{
		$this->db->like('nama_produk', $keyword, 'both', false);
		return $this->db->get('produk', $limit, $offset)->result();
	}

	public function count_search($keyword)
	{
		$this->db->like('nama_produk', $keyword, 'both', false);
		return $this->db->count_all_results('produk');
	}
}
