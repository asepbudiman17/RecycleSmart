<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waste_category_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_categories() {
        $query = $this->db->get('waste_categories');
        return $query->result();
    }

    public function get_category($id) {
        $query = $this->db->get_where('waste_categories', array('id' => $id));
        return $query->row();
    }

    public function create_category($data) {
        return $this->db->insert('waste_categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('waste_categories', $data);
    }

    public function delete_category($id) {
        return $this->db->delete('waste_categories', array('id' => $id));
    }
} 