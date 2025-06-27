<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pengaturan_models');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Pengaturan Aplikasi';
        $data['pengaturan'] = $this->Pengaturan_models->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('pengaturan/index', $data);
        $this->load->view('templates/footer');
    }

    public function update() {
        $this->form_validation->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('minimal_penukaran', 'Minimal Penukaran', 'required|trim|numeric');
        $this->form_validation->set_rules('poin_per_kg', 'Poin per Kg', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('pengaturan');
        } else {
            $settings = [
                'nama_aplikasi' => $this->input->post('nama_aplikasi'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'minimal_penukaran' => $this->input->post('minimal_penukaran'),
                'poin_per_kg' => $this->input->post('poin_per_kg')
            ];

            foreach ($settings as $key => $value) {
                $this->Pengaturan_models->update_by_key($key, $value);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Pengaturan berhasil diperbarui!</div>');
            redirect('pengaturan');
        }
    }
}
