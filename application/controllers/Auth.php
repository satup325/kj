<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        // Cek jika sudah login
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            if ($role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('user/dashboard');
            }
        }

        $this->load->view('auth/login');
    }

    public function do_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'id_akun'  => $user->id_akun,
                'username' => $user->username,
                'role'     => $user->role,
                'logged_in' => true
            ]);

            // Redirect sesuai role
            if ($user->role === 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('user/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth/login');
        }
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function do_register()
    {
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm_password');

        // Validasi
        if ($password !== $confirm) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok.');
            redirect('auth/register');
            return;
        }

        // Cek username/email
        if ($this->Auth_model->is_username_exists($username)) {
            $this->session->set_flashdata('error', 'Username sudah terdaftar.');
            redirect('auth/register');
            return;
        }

        if ($this->Auth_model->is_email_exists($email)) {
            $this->session->set_flashdata('error', 'Email sudah terdaftar.');
            redirect('auth/register');
            return;
        }

        // Simpan user
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
            'dibuat_pada' => date('Y-m-d H:i:s')
        ];

        if ($this->Auth_model->register_user($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
            redirect('auth/register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
