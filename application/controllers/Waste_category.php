<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waste_category extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('waste_category_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['categories'] = $this->waste_category_model->get_all_categories();
        $data['title'] = 'Kategori Sampah';
        
        $this->load->view('templates/header', $data);
        $this->load->view('waste_category/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Kategori Sampah';
            
            $this->load->view('templates/header', $data);
            $this->load->view('waste_category/create');
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->waste_category_model->create_category($data);
            redirect('waste_category');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['category'] = $this->waste_category_model->get_category($id);
            $data['title'] = 'Edit Kategori Sampah';
            
            $this->load->view('templates/header', $data);
            $this->load->view('waste_category/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->waste_category_model->update_category($id, $data);
            redirect('waste_category');
        }
    }

    public function delete($id) {
        $this->waste_category_model->delete_category($id);
        redirect('waste_category');
    }
} 