<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reward_models');
        $this->load->library('session');

        // Pastikan user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Daftar Reward';
        $data['rewards'] = $this->Reward_models->get_all_rewards();

        $total_poin = 0;

        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');

            if ($user_id !== null && $user_id !== false) {
                $this->load->model('Pengumpulan_models');
                $user_total_poin = $this->Pengumpulan_models->get_total_poin_by_pengguna($user_id);
                $total_poin = (int)$user_total_poin;
            }
        }

        $data['total_poin'] = $total_poin;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('reward/index', $data);
        $this->load->view('templates/footer');
    }

    public function claim($id) {
        $reward = $this->Reward_models->get_reward_by_id($id);
        $user_id = $this->session->userdata('user_id');

        if (empty($reward)) {
            show_404();
        }

        $this->load->model('Pengumpulan_models');
        $user_total_poin = $this->Pengumpulan_models->get_total_poin_by_pengguna($user_id);
        $user_total_poin = (int)$user_total_poin;

        if ($user_total_poin < (int)$reward->total_poin) {
            $this->session->set_flashdata('error', 'Poin tidak mencukupi untuk mengklaim reward ini');
            redirect('reward');
        }

        $data = [
            'id_pengguna' => $user_id,
            'id_reward' => $id,
            'poin_digunakan' => $reward->total_poin,
            'tanggal_klaim' => date('Y-m-d H:i:s'),
            'status' => 'claimed'
        ];

        if ($this->Reward_models->claim_reward($data)) {
            // Reset point user jika level_id == 3 (user biasa)
            if ($this->session->userdata('level_id') == 3) {
                // Set semua poin pengumpulan user menjadi 0
                $this->load->model('Pengumpulan_models');
                $pengumpulan_user = $this->Pengumpulan_models->get_by_pengguna($user_id);
                foreach ($pengumpulan_user as $row) {
                    $this->Pengumpulan_models->update($row->pengumpulan_id, ['poin' => 0]);
                }
            }
            $this->session->set_flashdata('success', 'Reward berhasil diklaim');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengklaim reward');
        }

        redirect('reward/history');
    }

    public function edit($id) {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('nama_reward', 'Nama Reward', 'required|trim');
        $this->form_validation->set_rules('total_poin', 'Poin Dibutuhkan', 'required|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
        
        // Add validation rules based on user level
        if ($this->session->userdata('level_id') == 1) {
            $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        } else {
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
        }

        if ($this->form_validation->run() == FALSE) {
            // If validation fails or for initial load, show the edit form
            $data['title'] = 'Edit Reward';
            $data['reward'] = $this->Reward_models->get_reward_by_id($id);
            $data['rewards'] = $this->Reward_models->get_all_rewards();

            // Check if reward exists
            if (empty($data['reward'])) {
                show_404();
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('reward/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // If validation passes, update the reward
            $update_data = [
                'nama_reward' => $this->input->post('nama_reward'),
                'total_poin' => $this->input->post('total_poin'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            // Add stock or status based on user level
            if ($this->session->userdata('level_id') == 1) {
                $update_data['stok'] = $this->input->post('stok');
            } else {
                $update_data['status'] = $this->input->post('status');
            }

            if ($this->Reward_models->update($id, $update_data)) {
                $this->session->set_flashdata('success', 'Reward berhasil diupdate!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate reward.');
            }

            redirect('reward');
        }
    }

    public function history() {
        $data['title'] = 'Riwayat Klaim Reward';
        $user_id = $this->session->userdata('user_id');
        $data['history'] = $this->Reward_models->get_reward_history($user_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('reward/history', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        if ($this->Reward_models->delete($id)) {
            $this->session->set_flashdata('success', 'Reward berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus reward.');
        }
        redirect('reward');
    }

    public function delete_claim($klaim_id) {
        // Ambil data klaim sebelum dihapus
        $claim = $this->Reward_models->get_claim_by_id($klaim_id);
        if ($claim) {
            $user_id = $claim->id_pengguna;
            $poin_digunakan = (int)$claim->poin_digunakan;
            // Kembalikan poin ke user jika user biasa
            if ($this->session->userdata('level_id') == 3) {
                $this->load->model('Pengumpulan_models');
                $pengumpulan_user = $this->Pengumpulan_models->get_by_pengguna($user_id);
                if (!empty($pengumpulan_user)) {
                    // Tambahkan ke pengumpulan pertama (atau bisa dibagi rata jika mau lebih kompleks)
                    $first = $pengumpulan_user[0];
                    $this->Pengumpulan_models->update($first->pengumpulan_id, ['poin' => $first->poin + $poin_digunakan]);
                }
            }
        }
        if ($this->Reward_models->delete_claim($klaim_id)) {
            $this->session->set_flashdata('success', 'Klaim reward berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus klaim reward.');
        }
        redirect('reward/history');
    }

    public function update_stock($id) {
        // Check if user is admin (level 1)
        if ($this->session->userdata('level_id') != 1) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk mengubah stok.');
            redirect('reward');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('reward');
        } else {
            $new_stock = $this->input->post('stok');
            if ($this->Reward_models->update_stock($id, $new_stock)) {
                $this->session->set_flashdata('success', 'Stok berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui stok.');
            }
            redirect('reward');
        }
    }
}
