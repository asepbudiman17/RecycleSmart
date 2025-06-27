<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategorisampah_models extends CI_Model {

    private $table = 'kategori_sampah';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['kategori_id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('kategori_id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('kategori_id', $id);
        return $this->db->delete($this->table);
    }
}
