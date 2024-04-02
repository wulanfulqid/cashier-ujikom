<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('MSudi');
    }

    public function index()
    {
        $this->load->view('VLogin');
    }

    public function landing()
    {
        $this->load->view('landingpage');
    }

    public function process_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // Validasi gagal, kembali ke halaman login
            $this->load->view('login/index');
        } else {
            // Validasi berhasil, cek login
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->MSudi->get_user($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Login berhasil
                    $this->session->set_userdata('user_id', $user['id']);
                    $this->session->set_userdata('username', $user['username']);
                    $this->session->set_userdata('role', $user['role']);

                    // Redirect sesuai role
                    if ($user['role'] == 'admin') {
                        redirect('Welcome/index'); // Sesuaikan dengan URL dashboard admin
                    } elseif ($user['role'] == 'petugas') {
                        redirect('Welcome/index'); // Sesuaikan dengan URL dashboard petugas
                    } else {
                        // Role lainnya, sesuaikan dengan kebutuhan
                        redirect('Welcome/index');
                    }
                } else {
                    // Password salah
                    $this->session->set_flashdata('error', 'Password salah');
                    redirect('login');
                }
            } else {
                // User tidak ditemukan
                $this->session->set_flashdata('error', 'Username tidak ditemukan');
                redirect('login');
            }
        }
    }

    public function register()
{
    $this->load->view('VRegister'); 
}

public function process_register() {
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
        // Validasi gagal, kembali ke halaman registrasi
        $this->load->view('VRegister');
    } else {
        // Validasi berhasil, tambahkan user ke database
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'admin'
        );

        $this->load->model('MSudi');
        $this->MSudi->insert_user($data);

        // Tambahkan pesan sukses atau flashdata jika diperlukan
        $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');

        // Redirect ke halaman login
        redirect('login');
    }
}
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login/landing');
    }
}
