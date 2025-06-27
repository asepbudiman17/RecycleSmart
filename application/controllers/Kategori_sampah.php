<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_sampah extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kategorisampah_models');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Kategori Sampah';
        $data['kategori_sampah'] = $this->Kategorisampah_models->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori_sampah/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('point_per_kg', 'Point per Kg', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Kategori Sampah';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kategori_sampah/create');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi' => $this->input->post('deskripsi'),
                'point_per_kg' => $this->input->post('point_per_kg')
            ];
            
            $this->Kategorisampah_models->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambahkan!</div>');
            redirect('kategori_sampah');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('point_per_kg', 'Point per Kg', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kategori Sampah';
            $data['kategori'] = $this->Kategorisampah_models->get_by_id($id);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kategori_sampah/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori'),
                'deskripsi' => $this->input->post('deskripsi'),
                'point_per_kg' => $this->input->post('point_per_kg')
            ];
            
            $this->Kategorisampah_models->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diupdate!</div>');
            redirect('kategori_sampah');
        }
    }

    public function delete($id) {
        // Delete related records in pengumpulan table first
        $this->load->model('Pengumpulan_models');
        $this->Pengumpulan_models->delete_by_kategori_id($id);

        // Now delete the category
        $this->Kategorisampah_models->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus!</div>');
        redirect('kategori_sampah');
    }
}
