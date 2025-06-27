<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<style>
    .dashboard-container {
        padding: 2rem;
        background: #f8f9fc;
        min-height: 100vh;
    }

    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .dashboard-subtitle {
        color: #6c757d;
        font-size: 1rem;
    }

    .stats-card {
        background: #fff;
        border-radius: 15px;
        padding: 1.5rem;
        height: 100%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stats-info {
        text-align: left;
    }

    .stats-label {
        color: #6c757d;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .stats-icon {
        font-size: 2.5rem;
        color: #e0e0e0;
    }

    .text-primary { color: #4e73df !important; }
    .text-success { color: #1cc88a !important; }
    .text-warning { color: #f6c23e !important; }
    .text-danger { color: #e74a3b !important; }
    .text-info { color: #36b9cc !important; }
    .text-indigo { color: #6610f2 !important; }
    .text-purple { color: #6f42c1 !important; }
    .text-orange { color: #fd7e14 !important; }


    .chart-container {
        width: 100%;
        max-width: 800px;
        height: 400px;
        margin: 0 auto;
    }

</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Administrator</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Kategori Sampah -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kategori Sampah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kategori_sampah; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_users; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Poin Terkumpul -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Poin Terkumpul</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengumpulan_points ?? 'N/A'; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_admin; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Staff -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Staff</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_staff; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pengumpulan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengumpulan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengumpulan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-recycle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penjemputan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Penjemputan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penjemputan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reward Tersedia -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Reward Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_reward; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gift fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart Section: Statistik Pengumpulan Sampah -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pengumpulan Sampah</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="pengumpulanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data kategori dan total berat dari PHP
    const labels = [
        <?php if(isset($statistik_per_kategori) && is_array($statistik_per_kategori)) foreach($statistik_per_kategori as $stat): ?>
            '<?= $stat->nama_kategori ?>',
        <?php endforeach; ?>
    ];
    const data = [
        <?php if(isset($statistik_per_kategori) && is_array($statistik_per_kategori)) foreach($statistik_per_kategori as $stat): ?>
            <?= $stat->total_berat ?>,
        <?php endforeach; ?>
    ];
    const backgroundColors = [
        '#4CAF50', '#2196F3', '#FFC107', '#FF5722', '#8BC34A', '#00BCD4', '#E91E63', '#9C27B0'
    ];
    const ctx = document.getElementById('pengumpulanChart').getContext('2d');
    const pengumpulanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Sampah (kg)',
                data: data,
                backgroundColor: backgroundColors.slice(0, labels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Jumlah Sampah yang Dikumpulkan per Kategori',
                    font: { size: 18 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Kg' }
                }
            }
        }
    });
</script>

<?php $this->load->view('templates/footer'); ?>