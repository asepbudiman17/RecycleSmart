<!-- Main content -->
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

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Reward</h6>
            <a href="<?= site_url('reward/history') ?>" class="btn btn-info btn-sm">
                <i class="fas fa-history"></i> Riwayat Klaim Reward
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Reward</th>
                            <th>Poin Dibutuhkan</th>
                            <th>Deskripsi</th>
                            <?php if ($this->session->userdata('level_id') == 1) : ?>
                                <th>Stok</th>
                                <th>Aksi</th>
                            <?php else: ?>
                                <th>Status</th>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('level_id') == 3) : ?>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($rewards as $reward) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $reward->nama_reward ?></td>
                                <td><?= $reward->total_poin ?></td>
                                <td><?= $reward->deskripsi ?></td>
                                <td>
                                    <?php if ($this->session->userdata('level_id') == 1) : ?>
                                        <?= $reward->stok ?>
                                    <?php else: ?>
                                        <?php 
                                        $user_current_poin = isset($total_poin) ? (int)$total_poin : 0;
                                        $reward_required_poin = (int)$reward->total_poin;
                                        $reward_id = isset($reward->id) ? $reward->id : null;

                                        if ($user_current_poin >= $reward_required_poin && $reward_id !== null): ?>
                                            <a href="<?= base_url('reward/claim/' . $reward_id) ?>" 
                                               class="btn btn-primary btn-sm"
                                               onclick="return confirm('Apakah Anda yakin ingin mengclaim reward ini?')">
                                                Claim
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Claim
                                            </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($this->session->userdata('level_id') == 1) : ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateStockModal<?= $reward->id ?>">
                                            <i class="fas fa-edit"></i> Update Stok
                                        </button>

                                        <!-- Modal Update Stok -->
                                        <div class="modal fade" id="updateStockModal<?= $reward->id ?>" tabindex="-1" role="dialog" aria-labelledby="updateStockModalLabel<?= $reward->id ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateStockModalLabel<?= $reward->id ?>">Update Stok <?= $reward->nama_reward ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?= form_open('reward/update_stock/' . $reward->id) ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="stok">Jumlah Stok Baru</label>
                                                            <input type="number" class="form-control" id="stok" name="stok" value="<?= $reward->stok ?>" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <?php if ($this->session->userdata('level_id') == 3) : ?>
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
