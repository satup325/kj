<?php
class Produk_model extends CI_Model
{

    public function get_all()
    {
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

    public function search($keyword)
    {
        $this->db->like('nama_produk', $keyword);
        return $this->db->get('produk')->result();
    }

    public function count_all()
    {
        return $this->db->count_all('produk');
    }
}
