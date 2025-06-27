<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <!-- Filter Laporan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            <form action="<?= site_url('laporan_aktivitas/filter') ?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="<?= isset($tanggal_mulai) ? $tanggal_mulai : '' ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" value="<?= isset($tanggal_selesai) ? $tanggal_selesai : '' ?>">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2">Filter</button>
                        <a href="<?= site_url('laporan_aktivitas/cetak_pdf' . (isset($tanggal_mulai) ? '?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai : '')) ?>" class="btn btn-danger" target="_blank">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Laporan Pengumpulan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengumpulan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
            </div>
        </div>
    </div>

    <!-- Laporan Penjemputan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <?php if ($this->session->userdata('level_id') == 3) : ?>
                    Laporan Penjemputan
                <?php else: ?>
                    Laporan Penjemputan
                <?php endif; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal & Waktu Penjemputan</th>
            <th>Nama Pengguna</th>
            <th>Alamat</th>
            <th>Catatan</th>
            <th>Berat (Kg)</th>
            <th>Poin</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($laporan_penjemputan)): ?>
            <?php $no = 1; foreach ($laporan_penjemputan as $penjemputan): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y H:i:s', strtotime($penjemputan->tanggal_waktu_penjemputan)) ?></td>
                    <td><?= htmlspecialchars($penjemputan->nama_pengguna ?? '-') ?></td>
                    <td><?= htmlspecialchars($penjemputan->alamat ?? '-') ?></td>
                    <td><?= htmlspecialchars($penjemputan->catatan ?? '-') ?></td>
                    <td><?= number_format($penjemputan->berat, 2) ?></td>
                    <td><?= $penjemputan->poin ?></td>
                    <td>
                        <?php if ($penjemputan->status == 'Selesai'): ?>
                            <span class="badge bg-success"><?= $penjemputan->status ?></span>
                        <?php else: ?>
                            <span class="badge bg-warning"><?= $penjemputan->status ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Tidak ada data penjemputan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Klaim Reward -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Klaim Reward</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                        <?php $i = 1; ?>
                        <?php if (!empty($reward_claims_history)): ?>
                            <?php foreach ($reward_claims_history as $claim): ?>
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
                                         <span class="badge badge-<?= $claim->status === 'pending' ? 'warning' : ($claim->status === 'approved' ? 'success' : 'danger') ?>">
                                            <?= ucfirst($claim->status ?? 'N/A') ?>
                                        </span>
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
            </div>
        </div>
    </div>

</div>
