<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward_models extends CI_Model {

    private $table = 'reward';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_rewards() {
        $this->db->select('reward_id as id, nama_reward, total_poin, deskripsi, stok');
        $query = $this->db->get($this->table);
        $result = $query->result();

        // Ensure total_poin is integer
        foreach ($result as $row) {
            $row->total_poin = (int)$row->total_poin;
            $row->stok = (int)$row->stok;
        }

        return $result;
    }

    public function get_reward_by_id($id) {
        return $this->db->get_where($this->table, ['reward_id' => $id])->row();
    }

    public function claim_reward($data) {
        return $this->db->insert('reward_klaim', $data); // pastikan tabel reward_klaim ada
    }

    public function get_reward_history($user_id) {
        $this->db->select('rk.*, r.nama_reward');
        $this->db->from('reward_klaim rk');
        $this->db->join('reward r', 'r.reward_id = rk.id_reward');
        $this->db->where('rk.id_pengguna', $user_id);
        $this->db->order_by('rk.tanggal_klaim', 'DESC');
        return $this->db->get()->result();
    }

    // Fungsi baru untuk mendapatkan semua riwayat klaim reward
    public function get_all_reward_claims() {
        $this->db->select('rk.*, r.nama_reward, u.name as nama_pengguna, u.level_id');
        $this->db->from('reward_klaim rk');
        $this->db->join('reward r', 'r.reward_id = rk.id_reward');
        $this->db->join('users u', 'u.user_id = rk.id_pengguna');
        $this->db->order_by('rk.tanggal_klaim', 'DESC');
        return $this->db->get()->result();
    }

    // Fungsi untuk menghapus reward berdasarkan ID
    public function delete($id) {
        $this->db->where('reward_id', $id);
        return $this->db->delete($this->table);
    }

    // Fungsi untuk menghapus klaim reward berdasarkan ID Klaim
    public function delete_claim($klaim_id) {
        $this->db->where('klaim_id', $klaim_id);
        return $this->db->delete('reward_klaim'); // Hapus dari tabel reward_klaim
    }

    // Fungsi untuk memperbarui stok reward
    public function update_stock($id, $new_stock) {
        $this->db->where('reward_id', $id);
        return $this->db->update($this->table, ['stok' => $new_stock]);
    }

    // Fungsi untuk mengambil data klaim reward berdasarkan klaim_id
    public function get_claim_by_id($klaim_id) {
        return $this->db->get_where('reward_klaim', ['klaim_id' => $klaim_id])->row();
    }
}
