<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <?php if ($this->session->userdata('level_id') == 2): ?>
                Dashboard <span class="text-primary">Pengepul</span>
            <?php elseif ($this->session->userdata('level_id') == 3): ?>
                Dashboard <span class="text-primary">User</span>
            <?php else: ?>
                Dashboard
            <?php endif; ?>
        </h1>
    </div>
    <p class="mb-4">Selamat datang, <?= ucwords(htmlspecialchars($this->session->userdata('name'))); ?>!</p>

    <!-- Content Row -->
    <div class="row">

        <!-- Kategori Sampah Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kategori Sampah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kategori_sampah ?? 0; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penjemputan Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Penjemputan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penjemputan ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Poin Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Poin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengumpulan_points ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->userdata('level_id') == 2): ?>
    <!-- Content row for Pengepul -->
    <div class="row">
        <div class="col-lg-12 mb-4">
             <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Aktivitas</h6>
                </div>
                <div class="card-body">
                   <p>Akses cepat ke laporan aktivitas.</p>
                   <a href="<?= site_url('laporan_aktivitas') ?>" class="btn btn-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php $this->load->view('templates/footer'); ?>
