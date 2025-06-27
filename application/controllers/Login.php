<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat model Pengguna_models
        $this->load->model('Pengguna_models');
        // Memuat helper URL agar fungsi site_url() bisa digunakan
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'session']);
    }

    // Fungsi untuk menampilkan halaman login
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('login/index');  // Memanggil view login/index.php
    }

    // Fungsi untuk memproses login
    public function process()
    {
        // Set rules form validation
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // Validasi form
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('login');
        } else {
            $name = $this->input->post('name');
            $password = $this->input->post('password');

            // Pastikan kamu menggunakan model yang tepat, dan sesuaikan metode login
            $user = $this->Pengguna_models->login($name, $password);  // Pastikan model dan metode yang digunakan sesuai

            if ($user) {
                // Verifikasi password
                if (!password_verify($password, $user['password'])) {
                    $this->session->set_flashdata('error', 'Nama atau password salah!');
                    redirect('login');
                }

                // Set session data
                $session_data = [
                    'user_id' => $user['user_id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'nik' => $user['nik'],
                    'level_id' => $user['level_id'],
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Redirect berdasarkan level
                $redirect_urls = [
                    1 => 'dashboard',  // Admin
                    2 => 'dashboard',  // Staff
                    3 => 'dashboard'         // User
                ];

                $redirect_url = isset($redirect_urls[$user['level_id']]) ? $redirect_urls[$user['level_id']] : 'dashboard';
                redirect($redirect_url);
            } else {
                $this->session->set_flashdata('error', 'Nama atau password salah!');
                redirect('login');
            }
        }
    }

    // Fungsi untuk menampilkan halaman register
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('login/register');  // Memanggil view register
    }

    // Fungsi untuk memproses registrasi
    public function register_process()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|exact_length[16]|is_unique[users.nik]');
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('login/register');
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'name' => $this->input->post('name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),  // Encrypt password
                'level_id' => 3, // Default level pengguna
                'status' => 'active' // Langsung aktifkan akun
            ];

            // Pastikan kamu menggunakan model yang tepat untuk registrasi
            if ($this->Pengguna_models->add_pengguna($data)) {  // Ganti metode sesuai dengan yang ada di model
                $this->session->set_flashdata('success', 'Registrasi berhasil! Akun Anda langsung aktif.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat registrasi.');
                redirect('login/register');
            }
        }
    }

    // Fungsi untuk logout
    public function logout()
    {
        // Hapus semua data session
        $this->session->unset_userdata(['user_id', 'name', 'level_id', 'logged_in']);
        $this->session->sess_destroy();
        
        $this->session->set_flashdata('success', 'Anda telah berhasil logout');
        redirect('login');
    }

    public function forgot_password() {
        $this->load->view('login/forgot_password');
    }

    public function forgot_password_process() {
        $telepon = $this->input->post('telepon');
        $user = $this->Pengguna_models->get_by_telepon($telepon);
        if (!$user) {
            $this->session->set_flashdata('error', 'Nomor HP tidak ditemukan!');
            redirect('login/forgot_password');
        }
        $kode_reset = rand(100000, 999999);
        $this->session->set_userdata('reset_user_id', $user->user_id);
        $this->session->set_userdata('reset_kode', $kode_reset);
        $this->session->set_flashdata('success', 'Kode reset Anda: <b>' . $kode_reset . '</b> (simulasi, kirim via SMS untuk produksi)');
        redirect('login/forgot_password');
    }

    public function reset_password() {
        $this->load->view('login/reset_password');
    }

    public function reset_password_process() {
        $kode = $this->input->post('kode_reset');
        $password = $this->input->post('password');
        $reset_kode = $this->session->userdata('reset_kode');
        $user_id = $this->session->userdata('reset_user_id');
        if ($kode != $reset_kode) {
            $this->session->set_flashdata('error', 'Kode reset salah!');
            redirect('login/reset_password');
        }
        $this->Pengguna_models->update_pengguna($user_id, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        $this->session->unset_userdata('reset_kode');
        $this->session->unset_userdata('reset_user_id');
        $this->session->set_flashdata('success', 'Password berhasil direset, silakan login.');
        redirect('login');
    }
}
