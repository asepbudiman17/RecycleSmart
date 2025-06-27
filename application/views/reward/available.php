<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Poin Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_poin ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php foreach ($rewards as $reward) : ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $reward->nama_reward ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Poin Dibutuhkan:</strong> <?= $reward->poin_required ?>
                        </div>
                        <div class="mb-3">
                            <strong>Deskripsi:</strong><br>
                            <?= $reward->deskripsi ?>
                        </div>
                        <?php if ($total_poin >= $reward->poin_required): ?>
                            <a href="<?= base_url('reward/claim/' . $reward->id) ?>" 
                               class="btn btn-primary btn-sm"
                               onclick="return confirm('Apakah Anda yakin ingin mengklaim reward ini?')">
                                Claim
                            </a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>
                                Poin Tidak Mencukupi
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($rewards)) : ?>
        <div class="alert alert-info">
            Tidak ada reward yang tersedia untuk poin Anda saat ini.
        </div>
    <?php endif; ?>
</div> 