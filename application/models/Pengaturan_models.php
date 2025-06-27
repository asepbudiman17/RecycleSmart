<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_models extends CI_Model {

    private $table = 'pengaturan';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_key($key) {
        return $this->db->get_where($this->table, ['key' => $key])->row();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_by_key($key, $value) {
        $this->db->where('key', $key);
        return $this->db->update($this->table, ['value' => $value]);
    }
}
