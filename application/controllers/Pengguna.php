<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    // Konstruktor untuk memuat model pengguna
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengguna_models');
        // Memuat helper dan library yang diperlukan
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'session']);
        
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    // Menampilkan data pengguna
    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 1) {
            $data['pengguna'] = $this->Pengguna_models->get_all();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('pengguna/index', $data);
            $this->load->view('templates/footer');
        } else {
            show_error('Anda tidak memiliki akses ke halaman ini.');
        }
    }

    // Menambahkan pengguna (menampilkan form)
    public function add()
    {
        // Cek apakah user memiliki level Admin (level_id = 1)
        $level_id = $this->session->userdata('level_id');
        if ($level_id == 1) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('pengguna/add'); // Load view for adding user
            $this->load->view('templates/footer');
        } else {
            show_error('Anda tidak memiliki akses ke halaman ini.');
        }
    }

    // Menambahkan pengguna (proses form)
    public function create()
    {
        // Validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('level_id', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('pengguna/add'); // Load the add view again on validation failure
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'nik' => $this->input->post('nik'),
                'level_id' => $this->input->post('level_id')
            );

            if ($this->Pengguna_models->add_pengguna($data)) {
                $this->session->set_flashdata('success', 'Data pengguna berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data pengguna');
            }
            redirect('pengguna');
        }
    }

    // Mengedit pengguna
    public function edit($id)
    {
        // Mengambil data pengguna berdasarkan ID
        $data['pengguna'] = $this->Pengguna_models->get_by_id($id);
        
        if (empty($data['pengguna'])) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan');
            redirect('pengguna');
        }

        // Validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('level_id', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengguna/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $update_data = array(
                'name' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'nik' => $this->input->post('nik'),
                'level_id' => $this->input->post('level_id')
            );

            // Panggil model untuk update data
            if ($this->Pengguna_models->update_pengguna($id, $update_data)) {
                $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data pengguna. Error: ' . $this->db->error()['message']);
            }
            redirect('pengguna');
        }
    }

    // Menghapus pengguna
    public function delete($id)
    {
        if ($this->Pengguna_models->delete_pengguna($id)) {
            $this->session->set_flashdata('success', 'Data pengguna berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengguna');
        }
        redirect('pengguna');
    }

    // Menampilkan profil user biasa
    public function profil()
    {
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 3) {
            $data['user'] = $this->Pengguna_models->get_by_id($user_id);
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('pengguna/profil', $data);
            $this->load->view('templates/footer');
        } else {
            show_error('Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
