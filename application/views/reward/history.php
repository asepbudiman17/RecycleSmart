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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Claim Reward</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Reward</th>
                            <th>Poin Digunakan</th>
                            <th>Tanggal Claim</th>
                            <th>Status</th>
                            <?php if ($this->session->userdata('level_id') == 3) : ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($history as $item) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item->nama_reward ?></td>
                                <td><?= $item->poin_digunakan ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($item->tanggal_klaim)) ?></td>
                                <td>
                                    <span class="badge badge-<?= $item->status === 'pending' ? 'warning' : ($item->status === 'approved' ? 'success' : 'danger') ?>">
                                        <?= ucfirst($item->status) ?>
                                    </span>
                                </td>
                                <?php if ($this->session->userdata('level_id') == 3) : ?>
                                <td>
                                    </a>
                                    <a href="<?= base_url('reward/delete_claim/' . $item->klaim_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus klaim reward ini?')">
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

    <a href="<?= base_url('reward') ?>" class="btn btn-secondary">Kembali</a>

    <?php if (empty($history)) : ?>
        <div class="alert alert-info">
            Anda belum pernah mengclaim reward.
        </div>
    <?php endif; ?>
</div> 