<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Reward</h6>
        </div>
        <div class="card-body">
            <?= form_open('reward/edit/' . $reward->reward_id) ?>
                <div class="form-group">
                    <label for="nama_reward">Nama Reward</label>
                    <select class="form-control <?= form_error('nama_reward') ? 'is-invalid' : '' ?>"
                            id="nama_reward" name="nama_reward">
                        <option value="">-- Pilih Nama Reward --</option>
                        <?php foreach ($rewards as $r) : ?>
                            <?php if ($r->total_poin == $reward->total_poin) : ?>
                                <option value="<?= $r->nama_reward ?>" <?= set_select('nama_reward', $r->nama_reward, $r->nama_reward === $reward->nama_reward) ?>><?= $r->nama_reward ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                     <div class="invalid-feedback">
                        <?= form_error('nama_reward') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="poin_required">Poin yang Dibutuhkan</label>
                    <input type="number" class="form-control <?= form_error('poin_required') ? 'is-invalid' : '' ?>" 
                           id="poin_required" name="poin_required" value="<?= set_value('poin_required', $reward->total_poin) ?>">
                    <div class="invalid-feedback">
                        <?= form_error('poin_required') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" 
                              id="deskripsi" name="deskripsi" rows="3"><?= set_value('deskripsi', $reward->deskripsi) ?></textarea>
                    <div class="invalid-feedback">
                        <?= form_error('deskripsi') ?>
                    </div>
                </div>

                <?php if ($this->session->userdata('level_id') == 1) : ?>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control <?= form_error('stok') ? 'is-invalid' : '' ?>" 
                           id="stok" name="stok" value="<?= set_value('stok', $reward->stok) ?>">
                    <div class="invalid-feedback">
                        <?= form_error('stok') ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control <?= form_error('status') ? 'is-invalid' : '' ?>" 
                            id="status" name="status">
                        <option value="aktif" <?= set_select('status', 'aktif', $reward->status === 'aktif') ?>>Aktif</option>
                        <option value="nonaktif" <?= set_select('status', 'nonaktif', $reward->status === 'nonaktif') ?>>Nonaktif</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= form_error('status') ?>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('reward') ?>" class="btn btn-secondary">Kembali</a>
            <?= form_close() ?>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger mt-3">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 