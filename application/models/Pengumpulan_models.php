<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumpulan_models extends CI_Model {

    private $table = 'pengumpulan';

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menambahkan data pengumpulan baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Fungsi penting untuk total poin user
    public function get_total_poin_by_pengguna($pengguna_id) {
        $this->db->select_sum('poin');
        $this->db->where('pengguna_id', $pengguna_id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row ? (int)$row->poin : 0;
    }

    // Fungsi untuk mendapatkan semua data pengumpulan
    public function get_all() {
        $this->db->select('pengumpulan.*, users.name as nama_pengguna, users.alamat as alamat_pengguna, kategori_sampah.nama_kategori');
        $this->db->join('users', 'users.user_id = pengumpulan.pengguna_id');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // Fungsi untuk mendapatkan total semua poin dari semua pengguna
    public function get_total_all_poin() {
        $this->db->select_sum('poin');
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row ? (int)$row->poin : 0;
    }

    // Fungsi untuk mendapatkan data pengumpulan berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('pengumpulan_id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    // Fungsi untuk memperbarui data pengumpulan
    public function update($id, $data) {
        $this->db->where('pengumpulan_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Fungsi untuk mendapatkan data pengumpulan yang belum terhubung dengan penjemputan untuk linking
    public function get_pengumpulan_for_penjemputan_linking($pengguna_id, $tanggal) {
        $this->db->where('pengguna_id', $pengguna_id);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('penjemputan_id IS NULL'); // Hanya ambil yang belum terhubung
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // Fungsi untuk memperbarui penjemputan_id pada data pengumpulan
    public function update_penjemputan_id($pengumpulan_ids, $penjemputan_id) {
        $this->db->where_in('pengumpulan_id', $pengumpulan_ids);
        $this->db->set('penjemputan_id', $penjemputan_id);
        return $this->db->update($this->table);
    }

    // Fungsi untuk menghapus data pengumpulan
    public function delete($id) {
        $this->db->where('pengumpulan_id', $id);
        return $this->db->delete($this->table);
    }

    // Fungsi untuk mendapatkan data pengumpulan berdasarkan ID pengguna
    public function get_by_pengguna($pengguna_id) {
        $this->db->select('pengumpulan.*, users.name as nama_pengguna, users.alamat as alamat_pengguna, kategori_sampah.nama_kategori');
        $this->db->from($this->table);
        $this->db->join('users', 'users.user_id = pengumpulan.pengguna_id');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');
        $this->db->where('pengumpulan.pengguna_id', $pengguna_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk statistik pengumpulan per kategori
    public function get_statistik_per_kategori() {
        $this->db->select('kategori_sampah.nama_kategori, SUM(pengumpulan.berat) as total_berat');
        $this->db->from('pengumpulan');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');
        $this->db->group_by('pengumpulan.kategori_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_combined() {
        $this->db->select("
            p.tanggal, 
            pj.waktu_penjemputan as waktu, 
            u.name as nama_pengguna, 
            ks.nama_kategori, 
            p.berat, 
            p.poin, 
            p.status, 
            p.pengumpulan_id as id
        ", FALSE);
        $this->db->from('pengumpulan p');
        $this->db->join('users u', 'u.user_id = p.pengguna_id');
        $this->db->join('kategori_sampah ks', 'ks.kategori_id = p.kategori_id');
        $this->db->join('penjemputan pj', 'pj.tanggal_penjemputan = p.tanggal AND pj.pelanggan_id = p.pengguna_id', 'left');
        $this->db->order_by('p.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_all_combined_by_user($user_id) {
        $this->db->select("
            p.tanggal, 
            pj.waktu_penjemputan as waktu, 
            u.name as nama_pengguna, 
            ks.nama_kategori, 
            p.berat, 
            p.poin, 
            p.status, 
            p.pengumpulan_id as id
        ", FALSE);
        $this->db->from('pengumpulan p');
        $this->db->join('users u', 'u.user_id = p.pengguna_id');
        $this->db->join('kategori_sampah ks', 'ks.kategori_id = p.kategori_id');
        $this->db->join('penjemputan pj', 'pj.tanggal_penjemputan = p.tanggal AND pj.pelanggan_id = p.pengguna_id', 'left');
        $this->db->where('p.pengguna_id', $user_id);
        $this->db->order_by('p.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }
    

    // Fungsi lain tetap sesuai kebutuhan...
}
