<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Penjemputan Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger"><?= validation_errors(); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('message')): ?>
                        <?= $this->session->flashdata('message'); ?>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('level_id') == 3) : // Form untuk pengguna biasa (User) ?>
                        <form action="<?= base_url('penjemputan/create') ?>" method="post">
                            <div class="form-group">
                                <label for="pengguna">Pengguna</label>
                                <input type="text" class="form-control" id="pengguna" value="<?= htmlspecialchars($this->session->userdata('name')); ?>" readonly>
                                <input type="hidden" name="id_pengguna" value="<?= $this->session->userdata('user_id'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" 
                                    id="alamat" name="alamat" rows="3"><?= set_value('alamat', isset($pengguna_saat_ini) ? $pengguna_saat_ini->alamat : '') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="berat">Berat (Kg)</label>
                                <input type="number" step="0.01" class="form-control <?= form_error('berat') ? 'is-invalid' : '' ?>" 
                                    id="berat" name="berat" value="<?= set_value('berat') ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('berat') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_penjemput">Tanggal Jemput</label>
                                <input type="date" class="form-control <?= form_error('tanggal_penjemput') ? 'is-invalid' : '' ?>" 
                                    id="tanggal_penjemput" name="tanggal_penjemput" value="<?= set_value('tanggal_penjemput', date('Y-m-d')) ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal_penjemput') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="waktu_penjemputan">Waktu Jemput</label>
                                <input type="time" class="form-control <?= form_error('waktu_penjemputan') ? 'is-invalid' : '' ?>" 
                                    id="waktu_penjemputan" name="waktu_penjemputan" value="<?= set_value('waktu_penjemputan') ?>" min="08:00" max="16:00">
                                <div class="invalid-feedback">
                                    <?= form_error('waktu_penjemputan') ?>
                                </div>
                                <p class="text-muted" style="font-weight: 400;">waktu oprasional 08.00 - 16.00</p>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" 
                                    id="catatan" name="catatan" rows="3"><?= set_value('catatan') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('catatan') ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('penjemputan') ?>" class="btn btn-secondary">Kembali</a>
                        </form>

                    <?php else : // Form untuk Admin atau Staff/Pengepul ?>

                        <form action="<?= base_url('penjemputan/create') ?>" method="post">
                            <div class="form-group">
                                <label for="id_pengguna">Pengguna</label>
                                <select class="form-control <?= form_error('id_pengguna') ? 'is-invalid' : '' ?>" id="id_pengguna" name="id_pengguna">
                                    <option value="">Pilih Pengguna</option>
                                    <?php foreach ($pengguna as $p) : ?>
                                        <option value="<?= $p->user_id; ?>" data-alamat="<?= htmlspecialchars($p->alamat); ?>" <?= set_select('id_pengguna', $p->user_id); ?>>
                                            <?= $p->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('id_pengguna') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" 
                                    id="alamat" name="alamat" rows="3"><?= set_value('alamat') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="berat">Berat (Kg)</label>
                                <input type="number" step="0.01" class="form-control <?= form_error('berat') ? 'is-invalid' : '' ?>" 
                                    id="berat" name="berat" value="<?= set_value('berat') ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('berat') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_penjemput">Tanggal Jemput</label>
                                <input type="date" class="form-control <?= form_error('tanggal_penjemput') ? 'is-invalid' : '' ?>" 
                                    id="tanggal_penjemput" name="tanggal_penjemput" value="<?= set_value('tanggal_penjemput', date('Y-m-d')) ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('tanggal_penjemput') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="waktu_penjemputan">Waktu Jemput</label>
                                <input type="time" class="form-control <?= form_error('waktu_penjemputan') ? 'is-invalid' : '' ?>" 
                                    id="waktu_penjemputan" name="waktu_penjemputan" value="<?= set_value('waktu_penjemputan') ?>" min="08:00" max="16:00">
                                <div class="invalid-feedback">
                                    <?= form_error('waktu_penjemputan') ?>
                                </div>
                                <p class="text-muted" style="font-weight: 400;">waktu oprasional 08.00 - 16.00</p>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" 
                                    id="catatan" name="catatan" rows="3"><?= set_value('catatan') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('catatan') ?>
                                </div>
                            </div>

                            <?php if ($this->session->userdata('level_id') != 1) : ?>
                            <div class="form-group">
                                <label for="id_penjemput">Penjemput</label>
                                <select class="form-control <?= form_error('id_penjemput') ? 'is-invalid' : '' ?>" id="id_penjemput" name="id_penjemput">
                                    <option value="">Pilih Penjemput</option>
                                    <?php foreach ($penjemput as $p) : ?>
                                        <option value="<?= $p->user_id; ?>" <?= set_select('id_penjemput', $p->user_id); ?>>
                                            <?= htmlspecialchars($p->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('id_penjemput') ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('penjemputan') ?>" class="btn btn-secondary">Kembali</a>
                        </form>

                    <?php endif; ?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectPengguna = document.getElementById('id_pengguna');
    const alamatField = document.getElementById('alamat');

    if (selectPengguna && alamatField) {
        selectPengguna.addEventListener('change', function() {
            const selectedOption = selectPengguna.options[selectPengguna.selectedIndex];
            const alamat = selectedOption.getAttribute('data-alamat') || '';
            alamatField.value = alamat;
        });
    }
});
</script> 