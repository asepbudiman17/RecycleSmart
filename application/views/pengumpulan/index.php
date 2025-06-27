

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengumpulan Sampah</h1>

    <!-- Tombol Tambah -->
    <a href="<?= site_url('pengumpulan/create') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Pengumpulan
    </a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if ($this->session->userdata('level_id') == 3): ?>
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pengumpulann</h6>
            <?php else: ?>
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pengumpulan</h6>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pengguna</th>
                            <th>Kategori Sampah</th>
                            <th>Berat (Kg)</th>
                            <th>Poin</th>
                            <th>Status</th>
                            <?php if ($this->session->userdata('level_id') != 3): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($pengumpulan as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= htmlspecialchars($item['tanggal'] ? date('d-m-Y', strtotime($item['tanggal'])) : 'N/A') ?>
                                </td>
                                <td><?= htmlspecialchars($item['nama_pengguna'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($item['nama_kategori'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($item['berat'] ?? '0') ?></td>
                                <td><?= htmlspecialchars($item['poin'] ?? '0') ?></td>
                                <td>
                                    <?php
                                        $status_text = htmlspecialchars($item['status'] ?? 'N/A');
                                        $badge_class = 'badge-secondary'; // Default badge
                                        if ($status_text === 'selesai' || $status_text === 'diterima') {
                                            $badge_class = 'badge-success';
                                        } elseif ($status_text === 'dijadwalkan' || $status_text === 'diproses') {
                                            $badge_class = 'badge-warning';
                                        } elseif ($status_text === 'ditolak') {
                                            $badge_class = 'badge-danger';
                                        }
                                    ?>
                                    <span class="badge <?= $badge_class ?>"><?= ucwords($status_text) ?></span>
                                </td>
                                <?php if ($this->session->userdata('level_id') != 3): ?>
                                    <td>
                                        <a href="<?= site_url('pengumpulan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= site_url('pengumpulan/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
