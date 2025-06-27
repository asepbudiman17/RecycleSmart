<?php $current_url = $this->uri->segment(1); ?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #2c3e50;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-recycle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Recycle Smart</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= (($this->uri->segment(1) == 'dashboard' && $this->uri->segment(2) === null) || $this->uri->segment(1) == '') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akun Saya
    </div>

    <!-- Nav Item - Profil Pengguna -->
    <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard' && $this->uri->segment(2) == 'profile') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('dashboard/profile') ?>">
            <i class="fas fa-user"></i>
            <span>
                <?php if (isset($_SESSION['level_id']) && $_SESSION['level_id'] == 1): ?>
                    Profil Admin
                <?php elseif (isset($_SESSION['level_id']) && $_SESSION['level_id'] == 2): ?>
                    Profil Staff
                <?php else: ?>
                    Profil Pengguna
                <?php endif; ?>
            </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <!-- Nav Item - Kategori Sampah -->
    <li class="nav-item <?= ($current_url == 'kategori_sampah') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('kategori_sampah') ?>">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori Sampah</span>
        </a>
    </li>

    <!-- Nav Item - Users -->
    <?php if ($this->session->userdata('level_id') == 1): ?>
    <li class="nav-item <?= ($current_url == 'pengguna') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('pengguna') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Nav Item - Pengumpulan -->
    <?php if ($this->session->userdata('level_id') == 1): ?>
    <li class="nav-item <?= ($current_url == 'pengumpulan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('pengumpulan') ?>">
            <i class="fas fa-fw fa-recycle"></i>
            <span>Pengumpulan</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Nav Item - Penjemputan -->
    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2): ?>
    <li class="nav-item <?= ($current_url == 'penjemputan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('penjemputan') ?>">
            <i class="fas fa-fw fa-truck"></i>
            <span>Penjemputan</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Nav Item - Pengumpulan (for Level 3 users, replaces 'Penjemputan' for them) -->
    <?php if ($this->session->userdata('level_id') == 3): ?>
    <li class="nav-item <?= ($current_url == 'pengumpulan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('pengumpulan') ?>">
            <i class="fas fa-fw fa-recycle"></i>
            <span>Pengumpulan</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan & Reward
    </div>

    <!-- Nav Item - Laporan Aktivitas -->
    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2 || $this->session->userdata('level_id') == 3): ?>
    <li class="nav-item <?= ($current_url == 'laporan_aktivitas') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('laporan_aktivitas') ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan Aktivitas</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Nav Item - Reward -->
    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 3): ?>
    <li class="nav-item <?= ($current_url == 'reward') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('reward') ?>">
            <i class="fas fa-fw fa-gift"></i>
            <span>Reward</span>
        </a>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->
<!-- Begin Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
