<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanaktivitas_models extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_laporan_pengumpulan($tanggal_mulai = null, $tanggal_selesai = null, $user_id = null) {
        $this->db->select('pengumpulan.*, users.name as nama_pengguna, kategori_sampah.nama_kategori');
        $this->db->from('pengumpulan');
        $this->db->join('users', 'users.user_id = pengumpulan.pengguna_id');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');
        
        if ($user_id !== null) {
            $this->db->where('pengumpulan.pengguna_id', $user_id);
        }

        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('pengumpulan.tanggal >=', $tanggal_mulai);
            $this->db->where('pengumpulan.tanggal <=', $tanggal_selesai);
        }
        
        $this->db->order_by('pengumpulan.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_laporan_penjemputan($tanggal_mulai = null, $tanggal_selesai = null, $user_id = null) {
        $this->db->select('CONCAT(penjemputan.tanggal_penjemputan, CHAR(32), penjemputan.waktu_penjemputan) as tanggal_waktu_penjemputan, penjemputan.catatan, penjemputan.berat, CAST(penjemputan.poin AS SIGNED) as poin, penjemputan.status, users.name as nama_pengguna, users.alamat as alamat');
        $this->db->from('penjemputan');
        $this->db->join('users', 'users.user_id = penjemputan.pelanggan_id');
        
        if ($user_id !== null) {
            $this->db->where('penjemputan.pelanggan_id', $user_id);
        }

        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('penjemputan.tanggal_penjemputan >=', $tanggal_mulai);
            $this->db->where('penjemputan.tanggal_penjemputan <=', $tanggal_selesai);
        }
        
        $this->db->order_by('penjemputan.tanggal_penjemputan', 'DESC');
        return $this->db->get()->result();
    }

    public function get_total_berat_per_kategori($tanggal_mulai = null, $tanggal_selesai = null) {
        $this->db->select('kategori_sampah.nama_kategori, SUM(pengumpulan.berat) as total_berat');
        $this->db->from('pengumpulan');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');
        
        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('pengumpulan.tanggal >=', $tanggal_mulai);
            $this->db->where('pengumpulan.tanggal <=', $tanggal_selesai);
        }
        
        $this->db->group_by('kategori_sampah.kategori_id');
        return $this->db->get()->result();
    }

    public function get_total_poin_per_pengguna($tanggal_mulai = null, $tanggal_selesai = null) {
        $this->db->select('users.name, SUM(pengumpulan.poin) as total_poin');
        $this->db->from('pengumpulan');
        $this->db->join('users', 'users.user_id = pengumpulan.pengguna_id');
        
        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('pengumpulan.tanggal >=', $tanggal_mulai);
            $this->db->where('pengumpulan.tanggal <=', $tanggal_selesai);
        }
        
        $this->db->group_by('users.user_id');
        return $this->db->get()->result();
    }

    public function get_statistik_harian($tanggal_mulai = null, $tanggal_selesai = null) {
        $this->db->select('tanggal, COUNT(*) as jumlah_transaksi, SUM(berat) as total_berat, SUM(poin) as total_poin');
        $this->db->from('pengumpulan');
        
        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('tanggal >=', $tanggal_mulai);
            $this->db->where('tanggal <=', $tanggal_selesai);
        }
        
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get()->result();
    }

    // Fungsi baru untuk mendapatkan data aktivitas gabungan (pengumpulan dan penjemputan) untuk pengguna level 3
    public function get_user_activities($tanggal_mulai = null, $tanggal_selesai = null, $user_id = null) {
        // Query untuk data pengumpulan
        $this->db->select(
            'pengumpulan.tanggal AS tanggal_aktivitas,
             users.name AS nama_pengguna,
             kategori_sampah.nama_kategori AS detail_aktivitas,
             pengumpulan.berat AS nilai_aktivitas,
             pengumpulan.poin AS poin_aktivitas,
             NULL AS alamat_aktivitas,
             NULL AS status_aktivitas,
             \'Pengumpulan\' AS jenis_aktivitas'
        );
        $this->db->from('pengumpulan');
        $this->db->join('users', 'users.user_id = pengumpulan.pengguna_id');
        $this->db->join('kategori_sampah', 'kategori_sampah.kategori_id = pengumpulan.kategori_id');

        if ($user_id !== null) {
            $this->db->where('pengumpulan.pengguna_id', $user_id);
        }

        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('pengumpulan.tanggal >=', $tanggal_mulai);
            $this->db->where('pengumpulan.tanggal <=', $tanggal_selesai);
        }

        $query_pengumpulan = $this->db->get_compiled_select();

        // Query untuk data penjemputan
        $this->db->select(
            'penjemputan.tanggal_penjemputan AS tanggal_aktivitas,
             users.name AS nama_pengguna,
             NULL AS detail_aktivitas,
             NULL AS nilai_aktivitas,
             NULL AS poin_aktivitas,
             users.alamat AS alamat_aktivitas,
             penjemputan.status AS status_aktivitas,
             \'Penjemputan\' AS jenis_aktivitas'
        );
        $this->db->from('penjemputan');
        $this->db->join('users', 'users.user_id = penjemputan.pelanggan_id');

        if ($user_id !== null) {
            $this->db->where('penjemputan.pelanggan_id', $user_id);
        }

        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('penjemputan.tanggal_penjemputan >=', $tanggal_mulai);
            $this->db->where('penjemputan.tanggal_penjemputan <=', $tanggal_selesai);
        }

        $query_penjemputan = $this->db->get_compiled_select();

        // Gabungkan kedua query menggunakan UNION ALL
        $combined_query = $query_pengumpulan . ' UNION ALL ' . $query_penjemputan;

        // Urutkan berdasarkan tanggal aktivitas
        $combined_query .= ' ORDER BY tanggal_aktivitas DESC';

        $query = $this->db->query($combined_query);
        return $query->result();
    }
}
