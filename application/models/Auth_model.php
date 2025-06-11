<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    protected $table = 'akun';

    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function get_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function is_username_exists($username)
    {
        return $this->db->where('username', $username)->count_all_results($this->table) > 0;
    }

    public function is_email_exists($email)
    {
        return $this->db->where('email', $email)->count_all_results($this->table) > 0;
    }

    public function register_user($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
