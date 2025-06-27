<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Pastikan user sudah login
        if (!$this->session->userdata('user_id')) {
            redirect('login'); // Arahkan ke login jika belum login
        }
        // Load models
        $this->load->model('Pengguna_models');
        $this->load->model('Pengumpulan_models'); // Load Pengumpulan_models
        $this->load->model('Penjemputan_models'); // Load Penjemputan_models
        $this->load->model('Reward_models'); // Load Reward_models
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');
        
        $data['user'] = $this->Pengguna_models->get_by_id($user_id); // Fetch user data
        
        // Ambil total poin dari pengumpulan untuk user yang login
        if ($level_id == 1) {
            $data['total_pengumpulan_points'] = $this->Pengumpulan_models->get_total_all_poin(); // Get total points for all users
            
            // Ambil semua data yang diperlukan untuk dashboard admin
            $data['jumlah_kategori_sampah'] = $this->db->count_all('kategori_sampah');
            $data['jumlah_users'] = $this->Pengguna_models->count_by_level(3);
            $data['jumlah_admin'] = $this->Pengguna_models->count_by_level(1);
            $data['jumlah_staff'] = $this->Pengguna_models->count_by_level(2);
            $data['jumlah_pengumpulan'] = $this->db->count_all('pengumpulan');
            $data['jumlah_penjemputan'] = count($this->Penjemputan_models->get_all());
            $data['jumlah_reward'] = $this->db->count_all('reward');

            // Ambil semua riwayat klaim reward
            $data['reward_claims_history'] = $this->Reward_models->get_all_reward_claims();
            // Ambil statistik pengumpulan per kategori
            $data['statistik_per_kategori'] = $this->Pengumpulan_models->get_statistik_per_kategori();

            $this->load->view('dashboard/admin', $data); // Load admin dashboard for Admin, pass user data
        } else {
            $data['total_pengumpulan_points'] = $this->Pengumpulan_models->get_total_poin_by_pengguna($user_id); // Get total points for logged-in user
            $data['jumlah_penjemputan'] = $this->Penjemputan_models->count_by_pengguna($user_id); // Get number of penjemputan for logged-in user
            $data['jumlah_kategori_sampah'] = $this->db->count_all('kategori_sampah');
            $this->load->view('dashboard/index', $data);  // Load general dashboard for other levels (Pengepul/User), pass user data
        }
    }

    // Method untuk menampilkan halaman profil pengguna
    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Profil Pengguna';
        $data['user'] = $this->Pengguna_models->get_by_id($user_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile_update() {
        $user_id = $this->session->userdata('user_id');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        // Validasi sederhana (bisa dikembangkan)
        if (!$email) {
            $this->session->set_flashdata('error', 'Email tidak boleh kosong!');
            redirect('dashboard/profile');
        }
        $this->Pengguna_models->update_pengguna($user_id, [
            'email' => $email,
            'telepon' => $telepon
        ]);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        redirect('dashboard/profile');
    }
}
?>
