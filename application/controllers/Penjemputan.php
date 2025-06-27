<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjemputan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Penjemputan_models');
        $this->load->model('Pengguna_models');
        $this->load->model('Pengumpulan_models');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Penjemputan Sampah';
        $user_id = $this->session->userdata('user_id');
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 1 || $level_id == 2) { // Include level 2 to see all data
            $data['penjemputan'] = $this->Penjemputan_models->get_all();
        } else {
            $data['penjemputan'] = $this->Penjemputan_models->get_by_pengguna($user_id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjemputan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $level_id = $this->session->userdata('level_id');

        if ($level_id == 3) { // Jika pengguna biasa (User)
            $this->form_validation->set_rules('berat', 'Berat (Kg)', 'required|numeric');
            $this->form_validation->set_rules('tanggal_penjemput', 'Tanggal Penjemput', 'required|trim');
            $this->form_validation->set_rules('waktu_penjemputan', 'Waktu Penjemputan', 'required|trim');
            $this->form_validation->set_rules('catatan', 'Catatan', 'trim');

        } else { // Jika Admin atau Staff/Pengepul
            $this->form_validation->set_rules('id_pengguna', 'Pengguna', 'required|trim');
            $this->form_validation->set_rules('berat', 'Berat (Kg)', 'required|numeric');
            $this->form_validation->set_rules('tanggal_penjemput', 'Tanggal Penjemput', 'required|trim');
            $this->form_validation->set_rules('waktu_penjemputan', 'Waktu Penjemputan', 'required|trim');
            $this->form_validation->set_rules('catatan', 'Catatan', 'trim');
            
            // Hanya validasi id_penjemput jika bukan admin
            if ($level_id != 1) {
                $this->form_validation->set_rules('id_penjemput', 'Penjemput', 'required|trim');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Penjemputan Sampah';
            $user_id = $this->session->userdata('user_id');
            
            if ($level_id == 3) { // Jika pengguna biasa (User)
                $data['pengguna_saat_ini'] = $this->Pengguna_models->get_by_id($user_id);
            } else { // Jika Admin atau Staff/Pengepul
                $data['pengguna'] = $this->Pengguna_models->get_all();
                
                // Jika admin, ambil semua staff (level 2)
                if ($level_id == 1) {
                    $data['penjemput'] = $this->Pengguna_models->get_by_level(2);
                } else {
                    // Jika staff, ambil semua staff dan user
                    $data['penjemput'] = array_merge(
                        $this->Pengguna_models->get_by_level(2),
                        $this->Pengguna_models->get_by_level(3)
                    );
                }
            }
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('penjemputan/create', $data);
            $this->load->view('templates/footer');
        } else {
            $user_id = $this->session->userdata('user_id');
            $level_id = $this->session->userdata('level_id');

            $insert_data = [
                'tanggal_penjemputan' => $this->input->post('tanggal_penjemput'),
                'waktu_penjemputan' => $this->input->post('waktu_penjemputan'),
                'catatan' => $this->input->post('catatan'),
                'status' => 'menunggu',
                'berat' => $this->input->post('berat')
            ];

            if ($level_id == 3) { // Jika pengguna biasa (User)
                $insert_data['pelanggan_id'] = $user_id;
            } else { // Jika Admin atau Staff/Pengepul
                $insert_data['pelanggan_id'] = $this->input->post('id_pengguna');
                
                // Jika admin, ambil staff pertama yang tersedia
                if ($level_id == 1) {
                    $staff = $this->Pengguna_models->get_by_level(2);
                    if (!empty($staff)) {
                        $insert_data['penjemput_id'] = $staff[0]->user_id;
                    }
                } else {
                    $insert_data['penjemput_id'] = $this->input->post('id_penjemput');
                }
            }
            
            $this->Penjemputan_models->insert($insert_data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data penjemputan berhasil ditambahkan!</div>');
            redirect('penjemputan');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('id_pengguna', 'Pengguna', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat (Kg)', 'required|numeric');
        $this->form_validation->set_rules('tanggal_penjemputan', 'Tanggal Penjemputan', 'required|trim');
        $this->form_validation->set_rules('waktu_penjemputan', 'Waktu Penjemputan', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Penjemputan Sampah';
            $data['penjemputan'] = $this->Penjemputan_models->getById($id);
            $data['pengguna'] = $this->Pengguna_models->get_all();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('penjemputan/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'pelanggan_id' => $this->input->post('id_pengguna'),
                'berat' => $this->input->post('berat'),
                'tanggal_penjemputan' => $this->input->post('tanggal_penjemputan'),
                'waktu_penjemputan' => $this->input->post('waktu_penjemputan'),
                'catatan' => $this->input->post('catatan')
            ];
            $this->Penjemputan_models->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data penjemputan berhasil diupdate!</div>');
            redirect('penjemputan');
        }
    }

    public function delete($id) {
        $this->Penjemputan_models->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data penjemputan berhasil dihapus!</div>');
        redirect('penjemputan');
    }

    public function update_status($id, $status) {
        $this->Penjemputan_models->update_status($id, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Status penjemputan berhasil diupdate!</div>');
        redirect('penjemputan');
    }

    public function selesai($id) {
        $this->form_validation->set_rules('catatan_selesai', 'Catatan Penyelesaian', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, redirect kembali dengan pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Catatan penyelesaian wajib diisi!</div>');
            redirect('penjemputan');
        } else {
            $catatan = $this->input->post('catatan_selesai');

            // Get penjemputan details untuk mendapatkan berat dan pelanggan_id
            $penjemputan = $this->Penjemputan_models->getById($id); // Pastikan model ini mengembalikan objek dengan properti 'berat' dan 'pelanggan_id'

            $berat = $penjemputan->berat; // Ambil berat dari data penjemputan

            // Hitung point berdasarkan berat (Asumsi: 1 Kg = 10 Point)
            $point_didapat = $berat * 10; // Pastikan rumus ini sesuai

            $data_update = [
                'status' => 'selesai',
                'catatan' => $catatan,
                'poin' => $point_didapat // Simpan point yang dihitung ke kolom poin
            ];

            // Find related pengumpulan entries that are not yet linked
            // (Logika ini sepertinya untuk menghubungkan pengumpulan dengan penjemputan, biarkan apa adanya)
            $pengumpulan_entries = $this->Pengumpulan_models->get_pengumpulan_for_penjemputan_linking(
                $penjemputan->pelanggan_id,
                $penjemputan->tanggal_penjemputan
            );

            // If there are related pengumpulan entries, link them to this penjemputan
            if (!empty($pengumpulan_entries)) {
                $pengumpulan_ids = array();
                foreach ($pengumpulan_entries as $entry) {
                    $pengumpulan_ids[] = $entry->pengumpulan_id;
                }
                // Update penjemputan_id di tabel pengumpulan
                $this->Pengumpulan_models->update_penjemputan_id($pengumpulan_ids, $id);

                // Anda mungkin juga perlu memperbarui point di entri pengumpulan yang terhubung
                // jika point disimpan per item pengumpulan juga, tapi berdasarkan model sebelumnya
                // sepertinya poin diambil dari SUM pengumpulan, jadi mungkin tidak perlu update di sini
            }

            // Update data penjemputan (termasuk status dan point)
            $this->Penjemputan_models->update($id, $data_update); // Pastikan model ini mengupdate kolom total_poin dengan benar

            // --- Logika update point di tabel user ---
            // Pastikan fungsi ini ada di Pengguna_models.php dan namanya sama.
            // Fungsi ini harus bisa menambahkan $point_didapat ke  poin pengguna dengan user_id = $penjemputan->pelanggan_id
            if ($point_didapat > 0) { // Pastikan point_didapat lebih dari 0 sebelum menambahkan
                 $this->Pengguna_models->tambah_point_pengguna($penjemputan->pelanggan_id, $point_didapat);
            }
            // *******************************************


            $this->session->set_flashdata('message', '<div class="alert alert-success">Penjemputan berhasil diselesaikan! Point (' . $point_didapat . ') berhasil ditambahkan ke pengguna.</div>'); // Update pesan konfirmasi
            redirect('penjemputan');
        }
    }

    public function batalkan_selesai($id) {
        $data = [
            'status' => 'proses',
            'catatan' => null // atau sesuaikan jika catatan ingin dipertahankan
        ];
        $this->Penjemputan_models->update($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Status penjemputan berhasil dibatalkan!</div>');
        redirect('penjemputan');
    }
}
