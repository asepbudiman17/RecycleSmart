<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_models extends CI_Model {  // Nama kelas sesuai dengan file

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk mendapatkan semua data pengguna
    public function get_all_users() {
        $query = $this->db->get('users'); // Tabel 'users' di database
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    // Fungsi untuk mendapatkan data pengguna berdasarkan ID
    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id)); // Mencari berdasarkan ID
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    // Fungsi untuk menyimpan data pengguna baru
    public function insert_user($data) {
        // Pastikan password di-hash sebelum disimpan
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->db->insert('users', $data); // Menyimpan data ke tabel 'users'
    }

    // Fungsi untuk memperbarui data pengguna berdasarkan ID
    public function update_user($user_id, $data) {
        if (isset($data['password'])) {
            // Pastikan password di-hash jika ada yang diupdate
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data); // Memperbarui data berdasarkan ID
    }

    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function delete_user($user_id) {
        return $this->db->delete('users', array('id' => $user_id)); // Menghapus pengguna berdasarkan ID
    }

    // Fungsi untuk memeriksa apakah email sudah terdaftar
    public function check_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0; // Mengembalikan true jika email sudah terdaftar
    }

    // Fungsi untuk login pengguna
    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row_array();
        
        // Jika pengguna ditemukan, cek apakah passwordnya valid
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Mengembalikan data pengguna jika login berhasil
        } else {
            return null; // Jika password tidak cocok, mengembalikan null
        }
    }
}
