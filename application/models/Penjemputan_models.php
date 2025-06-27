<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjemputan_models extends CI_Model {

    private $table = 'penjemputan';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('penjemputan.penjemputan_id, CONCAT(penjemputan.tanggal_penjemputan, CHAR(32), penjemputan.waktu_penjemputan) as tanggal_waktu_penjemputan, penjemputan.catatan, penjemputan.berat, penjemputan.poin, penjemputan.status, users.name as nama_pengguna, users.alamat as alamat_pengguna');
        $this->db->from($this->table);
        $this->db->join('users', 'users.user_id = penjemputan.pelanggan_id');
        $this->db->order_by('penjemputan.tanggal_penjemputan', 'DESC');
        return $this->db->get()->result();
    }

    // ✅ Diganti nama agar cocok dengan pemanggilan di controller
    public function getById($id) {
        $this->db->select('penjemputan.penjemputan_id, CONCAT(penjemputan.tanggal_penjemputan, CHAR(32), penjemputan.waktu_penjemputan) as tanggal_waktu_penjemputan, penjemputan.catatan, penjemputan.berat, penjemputan.poin, penjemputan.status, users.name as nama_pengguna, users.alamat as alamat_pengguna');
        $this->db->from($this->table);
        $this->db->join('users', 'users.user_id = penjemputan.pelanggan_id');
        $this->db->where('penjemputan.penjemputan_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_user_id($user_id) {
        $this->db->select('penjemputan.penjemputan_id, CONCAT(penjemputan.tanggal_penjemputan, CHAR(32), penjemputan.waktu_penjemputan) as tanggal_waktu_penjemputan, penjemputan.catatan, penjemputan.berat, penjemputan.poin, penjemputan.status');
        $this->db->from($this->table);
        $this->db->where('penjemputan.pelanggan_id', $user_id);
        $this->db->order_by('penjemputan.tanggal_penjemputan', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_pengguna($pelanggan_id) {
        $this->db->select('penjemputan.penjemputan_id, CONCAT(penjemputan.tanggal_penjemputan, CHAR(32), penjemputan.waktu_penjemputan) as tanggal_waktu_penjemputan, penjemputan.catatan, penjemputan.berat, penjemputan.poin, penjemputan.status, users.name as nama_pengguna, users.alamat as alamat_pengguna');
        $this->db->from($this->table);
        $this->db->join('users', 'users.user_id = penjemputan.pelanggan_id');
        $this->db->where('penjemputan.pelanggan_id', $pelanggan_id);
        $this->db->order_by('penjemputan.tanggal_penjemputan', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('penjemputan_id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('penjemputan_id', $id);
        return $this->db->delete($this->table);
    }

    public function update_status($id, $status) {
        $this->db->where('penjemputan_id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function count_by_pengguna($pelanggan_id) {
        $this->db->where('pelanggan_id', $pelanggan_id);
        return $this->db->count_all_results($this->table);
    }
}
