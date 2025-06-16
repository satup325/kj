<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        // Hanya admin yang boleh
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Akses ditolak. Halaman ini hanya untuk admin.', 403, 'Forbidden');
        }
    }

    public function index()
    {
        $q      = $this->input->get('q');
        $sort   = $this->input->get('sort') ?: 'id_akun';
        $order  = $this->input->get('order') === 'desc' ? 'desc' : 'asc';
        $limit  = (int) ($this->input->get('entries') ?: 5);
        $page   = (int) ($this->input->get('page') ?: 1);
        $offset = ($page - 1) * $limit;

        // === Total rows
        if ($q) {
            $this->db->like('username', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('role', $q);
        }
        $total_rows = $this->db->get('akun')->num_rows();

        // === Ambil data
        if ($q) {
            $this->db->like('username', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('role', $q);
        }
        $this->db->order_by($sort, $order);
        $this->db->limit($limit, $offset);
        $users = $this->db->get('akun')->result();

        $total_pages = ceil($total_rows / $limit);

        $data = [
            'users' => $users,
            'q' => $q,
            'sort' => $sort,
            'order' => $order,
            'entries' => $limit,
            'page' => $page,
            'total_pages' => $total_pages
        ];

        $this->load->view('admin/user/index', $data);
    }


    public function tambah()
    {
        $this->load->view('admin/user/tambah');
    }

    public function store()
    {
        $username = $this->input->post('username', true);
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password_confirm = $this->input->post('password_confirm');
        $role = $this->input->post('role');

        // Validasi password
        if ($password != $password_confirm) {
            $data['error'] = 'Password tidak cocok.';
            $data['old_input'] = $_POST;
            $this->load->view('admin/user/tambah', $data);
            return;
        }

        // Cek duplikat username atau email
        $existing_user = $this->db->where('username', $username)
            ->or_where('email', $email)
            ->get('akun')
            ->row();

        if ($existing_user) {
            $data['error'] = 'Username atau Email sudah digunakan.';
            $data['old_input'] = $_POST;
            $this->load->view('admin/user/tambah', $data);
            return;
        }

        // Simpan data
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ];

        $this->User_model->insert($data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        redirect('admin/user');
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->get_by_id($id);
        if (!$data['user']) {
            show_404();
        }
        $this->load->view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $username = $this->input->post('username', true);
        $email    = $this->input->post('email', true);
        $role     = $this->input->post('role', true);
        $password = $this->input->post('password');
        $confirm  = $this->input->post('password_confirm');

        // Cek duplikasi username atau email untuk user lain
        $existing_user = $this->db->where('id_akun !=', $id)
            ->group_start()
            ->where('username', $username)
            ->or_where('email', $email)
            ->group_end()
            ->get('akun')
            ->row();

        if ($existing_user) {
            $data['error'] = 'Username atau Email sudah digunakan oleh user lain.';
            $data['user'] = $this->User_model->get_by_id($id);
            $data['old_input'] = $_POST;
            $this->load->view('admin/user/edit', $data);
            return;
        }

        // Siapkan data update
        $data = [
            'username' => $username,
            'email'    => $email,
            'role'     => $role,
        ];

        // Jika password diisi dan cocok, update password juga
        if (!empty($password)) {
            if ($password === $confirm) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $data['error'] = 'Password tidak cocok.';
                $data['user'] = $this->User_model->get_by_id($id);
                $data['old_input'] = $_POST;
                $this->load->view('admin/user/edit', $data);
                return;
            }
        }

        $this->User_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
        redirect('admin/user');
    }

    public function hapus($id)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }

        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/user');
    }
}
