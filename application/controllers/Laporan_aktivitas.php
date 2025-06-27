<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_aktivitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Laporanaktivitas_models');
        $this->load->library('session');
        
        // Load Reward_models
        $this->load->model('Reward_models');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Laporan Aktivitas';
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 1 || $level_id == 2) { // Include level 2 to see all report data
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan();
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan();
            $data['reward_claims_history'] = $this->Reward_models->get_all_reward_claims(); // Ambil semua klaim reward untuk admin/staff
        } else { // Level 3
            // Hanya ambil laporan penjemputan dan riwayat klaim reward untuk pengguna level 3
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan(null, null, $user_id);
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan(null, null, $user_id);
            $data['reward_claims_history'] = $this->Reward_models->get_reward_history($user_id);
            // Hapus data laporan aktivitas gabungan jika ada
            unset($data['laporan_aktivitas_gabungan']);
        }

        $data['total_berat_kategori'] = $this->Laporanaktivitas_models->get_total_berat_per_kategori();
        $data['total_poin_pengguna'] = $this->Laporanaktivitas_models->get_total_poin_per_pengguna();
        $data['statistik_harian'] = $this->Laporanaktivitas_models->get_statistik_harian();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_aktivitas/index', $data);
        $this->load->view('templates/footer');
    }

    public function filter() {
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        $data['title'] = 'Laporan Aktivitas';
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 1 || $level_id == 2) { // Include level 2 to see all filtered report data
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan($tanggal_mulai, $tanggal_selesai);
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan($tanggal_mulai, $tanggal_selesai);
            $data['reward_claims_history'] = $this->Reward_models->get_all_reward_claims(); // Ambil semua klaim reward untuk admin/staff
        } else { // Level 3
             // Hanya ambil laporan penjemputan dan riwayat klaim reward dengan filter tanggal untuk pengguna level 3
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan($tanggal_mulai, $tanggal_selesai, $user_id);
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan($tanggal_mulai, $tanggal_selesai, $user_id);
            $data['reward_claims_history'] = $this->Reward_models->get_reward_history($user_id);
             // Hapus data laporan aktivitas gabungan jika ada
            unset($data['laporan_aktivitas_gabungan']);
        }

        $data['total_berat_kategori'] = $this->Laporanaktivitas_models->get_total_berat_per_kategori($tanggal_mulai, $tanggal_selesai);
        $data['total_poin_pengguna'] = $this->Laporanaktivitas_models->get_total_poin_per_pengguna($tanggal_mulai, $tanggal_selesai);
        $data['statistik_harian'] = $this->Laporanaktivitas_models->get_statistik_harian($tanggal_mulai, $tanggal_selesai);
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_selesai'] = $tanggal_selesai;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_aktivitas/index', $data);
        $this->load->view('templates/footer');
    }

    public function export_excel() {
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan($tanggal_mulai, $tanggal_selesai);
        $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan($tanggal_mulai, $tanggal_selesai);
        $data['total_berat_kategori'] = $this->Laporanaktivitas_models->get_total_berat_per_kategori($tanggal_mulai, $tanggal_selesai);
        $data['total_poin_pengguna'] = $this->Laporanaktivitas_models->get_total_poin_per_pengguna($tanggal_mulai, $tanggal_selesai);
        $data['statistik_harian'] = $this->Laporanaktivitas_models->get_statistik_harian($tanggal_mulai, $tanggal_selesai);

        $this->load->view('laporan_aktivitas/export_excel', $data);
    }

    public function cetak_pdf() {
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 1 || $level_id == 2) {
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan($tanggal_mulai, $tanggal_selesai);
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan($tanggal_mulai, $tanggal_selesai);
            $data['reward_claims_history'] = $this->Reward_models->get_all_reward_claims(); // Ambil semua klaim reward untuk admin/staff
        } else { // Level 3
             // Hanya ambil laporan penjemputan dan riwayat klaim reward dengan filter tanggal untuk pengguna level 3
            // Note: Laporan pengumpulan untuk level 3 diambil tanpa filter tanggal di sini, sesuai dengan logika index/filter
            // Jika ingin filter juga, perlu sesuaikan model atau panggil model dengan parameter filter
            $data['laporan_pengumpulan'] = $this->Laporanaktivitas_models->get_laporan_pengumpulan(null, null, $user_id);
            $data['laporan_penjemputan'] = $this->Laporanaktivitas_models->get_laporan_penjemputan($tanggal_mulai, $tanggal_selesai, $user_id);
            $data['reward_claims_history'] = $this->Reward_models->get_reward_history($user_id);
        }

        $data['total_berat_kategori'] = $this->Laporanaktivitas_models->get_total_berat_per_kategori($tanggal_mulai, $tanggal_selesai);
        $data['total_poin_pengguna'] = $this->Laporanaktivitas_models->get_total_poin_per_pengguna($tanggal_mulai, $tanggal_selesai);
        $data['statistik_harian'] = $this->Laporanaktivitas_models->get_statistik_harian($tanggal_mulai, $tanggal_selesai);
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_selesai'] = $tanggal_selesai;

        // Load library TCPDF
        $this->load->library('pdf');

        // Set document information
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('RecycleSmart');
        $this->pdf->SetTitle('Laporan Aktivitas');

        // Set default header data
        $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Laporan Aktivitas', 'RecycleSmart');

        // Set margins
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $this->pdf->AddPage();

        // Set font
        $this->pdf->SetFont('helvetica', '', 10);

        // Generate the content
        $html = $this->load->view('laporan_aktivitas/cetak_pdf', $data, true);

        // Print the content
        $this->pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF
        $this->pdf->Output('Laporan_Aktivitas.pdf', 'I');
    }
}
