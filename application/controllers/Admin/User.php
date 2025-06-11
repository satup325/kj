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
        $data['users'] = $this->User_model->get_all();
        $this->load->view('admin/user/index', $data);
    }

    public function tambah()
    {
        $this->load->view('admin/user/tambah');
    }

    public function store()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password');
        $password_confirm = $this->input->post('password_confirm');
        $role = $this->input->post('role');

        if ($password != $password_confirm) {
            $this->session->set_flashdata('error', 'Password tidak cocok.');
            redirect('admin/user/tambah');
            return;
        }

        $data = [
            'username' => $username,
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
        $this->load->model('User_model');

        $data = [
            'username' => $this->input->post('username', true),
            'email'    => $this->input->post('email', true),
            'role'     => $this->input->post('role', true),
        ];

        // Jika password diisi, update password juga
        $password = $this->input->post('password');
        $confirm  = $this->input->post('password_confirm');

        if (!empty($password)) {
            if ($password === $confirm) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Password tidak cocok');
                redirect('admin/user/edit/' . $id);
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
