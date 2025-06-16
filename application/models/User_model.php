<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'akun';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id_akun' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function find($id)
    {
        return $this->db->get_where($this->table, ['id_akun' => $id])->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id_akun', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_akun', $id)->delete($this->table);
    }

    public function count_all()
    {
        return $this->db->count_all('akun');
    }
}
