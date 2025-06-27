<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_models extends CI_Model
{
    // Fungsi untuk login
    public function login($name, $password)
    {
        // Query untuk mengambil data pengguna berdasarkan nama
        $this->db->select('*');
        $this->db->from('users'); // Pastikan nama tabel sesuai
        $this->db->where('name', $name); // Sesuaikan kolom yang digunakan
        $query = $this->db->get();

        // Periksa apakah ada pengguna dengan nama tersebut
        if ($query->num_rows() == 1) {
            $user = $query->row_array();

            // Periksa apakah password cocok
            if (password_verify($password, $user['password'])) {
                return $user; // Kembalikan data pengguna jika login sukses
            }
        }

        return false; // Jika login gagal
    }

    // Fungsi untuk menambahkan pengguna baru
    public function add_pengguna($data)
    {
        return $this->db->insert('users', $data); // Menambahkan pengguna baru ke tabel users
    }

    // Fungsi untuk mengambil semua data pengguna
    public function get_all()
    {
        $this->db->select('user_id, name, email, nik, level_id, alamat');
        return $this->db->get('users')->result();
    }

    public function get_by_id($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row();
    }

    // Fungsi untuk memperbarui data pengguna
    public function update_pengguna($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }

    public function get_by_level($level_id) {
        $this->db->where('level_id', $level_id);
        return $this->db->get('users')->result();
    }

    public function count_by_level($level_id)
    {
        $this->db->where('level_id', $level_id);
        return $this->db->count_all_results('users');
    }

    // Fungsi untuk menambahkan point ke pengguna
    public function tambah_point_pengguna($user_id, $points_to_add) {
        // Asumsi nama kolom point di tabel users/pengguna adalah 'poin'
        $this->db->where('user_id', $user_id);
        $this->db->set('poin', 'poin + ' . (int)$points_to_add, FALSE); // Menambahkan point ke kolom poin yang sudah ada
        $this->db->update('users'); // Ganti 'users' jika nama tabelnya beda
    }

    public function get_by_telepon($telepon) {
        return $this->db->get_where('users', ['telepon' => $telepon])->row();
    }
}
