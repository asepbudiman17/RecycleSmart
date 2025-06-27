<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumpulan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pengumpulan_models');
        $this->load->model('Kategorisampah_models');
        $this->load->model('Pengguna_models');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Pengumpulan Sampah';
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 3) { // Jika user
            $data['pengumpulan'] = $this->Pengumpulan_models->get_all_combined_by_user($user_id);
        } else { // Jika admin atau staff
            $data['pengumpulan'] = $this->Pengumpulan_models->get_all_combined();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengumpulan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->form_validation->set_rules('id_kategori', 'Kategori Sampah', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim|numeric');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

        // Ambil user yang sedang login
        $user_id = $this->session->userdata('user_id');
        $user = $this->Pengguna_models->get_by_id($user_id);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Pengumpulan Sampah';
            $data['user'] = $user;
            $data['kategori'] = $this->Kategorisampah_models->get_all();
            
            // Load semua data pengguna untuk admin
            if ($this->session->userdata('level_id') == 1) {
                $data['pengguna'] = $this->Pengguna_models->get_all();
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengumpulan/create', $data);
            $this->load->view('templates/footer');
        } else {
            // Proses simpan data
            $kategori = $this->Kategorisampah_models->get_by_id($this->input->post('id_kategori'));
            $point_per_kg = $kategori->point_per_kg;
            $berat = $this->input->post('berat');
            $poin = $berat * $point_per_kg;

            // Jika admin, gunakan id_pengguna dari form, jika tidak gunakan user_id yang login
            $pengguna_id = ($this->session->userdata('level_id') == 1)
                ? $this->input->post('id_pengguna')
                : $user_id;

            $data = [
                'pengguna_id' => $pengguna_id,
                'kategori_id' => $this->input->post('id_kategori'),
                'berat' => $berat,
                'poin' => $poin,
                'tanggal' => $this->input->post('tanggal'),
                'status' => 'selesai'
            ];

            $this->Pengumpulan_models->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data pengumpulan berhasil ditambahkan!</div>');
            redirect('pengumpulan');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('id_pengguna', 'Pengguna', 'required|trim');
        $this->form_validation->set_rules('id_kategori', 'Kategori Sampah', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim|numeric');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('Point per Kg', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Pengumpulan Sampah';
            $data['pengumpulan'] = $this->Pengumpulan_models->get_by_id($id);
            $data['pengguna'] = $this->Pengguna_models->get_all();
            $data['kategori'] = $this->Kategorisampah_models->get_all();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengumpulan/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // Hitung poin berdasarkan berat dan pengaturan poin per kg
            $kategori = $this->Kategorisampah_models->get_by_id($this->input->post('id_kategori'));
            $point_per_kg = $kategori->point_per_kg;
            $berat = $this->input->post('berat');
            $poin = $berat * $point_per_kg;

            $data = [
                'pengguna_id' => $this->input->post('id_pengguna'),
                'kategori_id' => $this->input->post('id_kategori'),
                'berat' => $berat,
                'poin' => $poin,
                'tanggal' => $this->input->post('tanggal'),
                'status' => 'selesai'
    
            ];
            
            $this->Pengumpulan_models->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data pengumpulan berhasil diupdate!</div>');
            redirect('pengumpulan');
        }
    }

    public function delete($id) {
        $this->Pengumpulan_models->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data pengumpulan berhasil dihapus!</div>');
        redirect('pengumpulan');
    }
}
