<?php
// Set timezone
date_default_timezone_set('Asia/Jakarta');
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #000;
        padding: 5px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .text-center {
        text-align: center;
    }
</style>

<?php if ($tanggal_mulai && $tanggal_selesai): ?>
    <p>Periode: <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> - <?= date('d/m/Y', strtotime($tanggal_selesai)) ?></p>
<?php endif; ?>

<h3>Laporan Pengumpulan</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pengguna</th>
            <th>Kategori</th>
            <th>Berat (kg)</th>
            <th>Poin</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($laporan_pengumpulan)): ?>
            <?php $no = 1; foreach ($laporan_pengumpulan as $pengumpulan) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($pengumpulan->tanggal)) ?></td>
                    <td><?= $pengumpulan->nama_pengguna ?></td>
                    <td><?= $pengumpulan->nama_kategori ?></td>
                    <td><?= number_format($pengumpulan->berat, 2) ?></td>
                    <td><?= $pengumpulan->poin ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pengumpulan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Laporan Penjemputan</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Jemput</th>
            <th>Nama Pengguna</th>
            <th>Alamat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($laporan_penjemputan)): ?>
            <?php $no = 1; foreach ($laporan_penjemputan as $penjemputan) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= isset($penjemputan->tanggal_waktu_penjemputan) ? date('d/m/Y H:i', strtotime($penjemputan->tanggal_waktu_penjemputan)) : '-' ?></td>
                    <td><?= $penjemputan->nama_pengguna ?></td>
                    <td><?= $penjemputan->alamat ?></td>
                    <td><?= !empty($penjemputan->status) ? $penjemputan->status : 'Selesai' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Tidak ada data penjemputan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Total Poin per Pengguna</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Total Poin</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($total_poin_pengguna)): ?>
            <?php $no = 1; foreach ($total_poin_pengguna as $pengguna) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $pengguna->name ?></td>
                    <td><?= $pengguna->total_poin ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Tidak ada data poin pengguna.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h3>Riwayat Klaim Reward</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2): // Tampilkan kolom pengguna hanya untuk admin/staff ?>
                <th>Nama Pengguna</th>
                <th>Level</th>
            <?php endif; ?>
            <th>Nama Reward</th>
            <th>Poin Digunakan</th>
            <th>Tanggal Claim</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($reward_claims_history)): ?>
            <?php $i = 1; foreach ($reward_claims_history as $claim): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2): ?>
                        <td><?= htmlspecialchars($claim->nama_pengguna ?? 'N/A') ?></td>
                        <td><?= $claim->level_id ?? 'N/A' ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($claim->nama_reward ?? 'N/A') ?></td>
                    <td><?= $claim->poin_digunakan ?? 'N/A' ?></td>
                    <td><?= isset($claim->tanggal_klaim) ? date('d/m/Y H:i', strtotime($claim->tanggal_klaim)) : 'N/A' ?></td>
                    <td>
                         <?= ucfirst($claim->status ?? 'N/A') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2) ? 7 : 5 ?>" class="text-center">Tidak ada riwayat klaim reward.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<p class="text-center">Dicetak pada: <?= date('d/m/Y H:i:s') ?></p> 