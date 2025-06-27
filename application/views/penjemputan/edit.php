<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Penjemputan Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?= site_url('penjemputan/edit/'. $penjemputan->penjemputan_id) ?>" method="post">
                        <div class="form-group">
                            <label for="id_pengguna">Pengguna</label>
                            <select class="form-control <?= form_error('id_pengguna') ? 'is-invalid' : '' ?>" id="id_pengguna" name="id_pengguna">
                                <option value="">Pilih Pengguna</option>
                                <?php foreach ($pengguna as $p) : ?>
                                    <option value="<?= $p->user_id; ?>" data-alamat="<?= htmlspecialchars($p->alamat); ?>" <?= set_select('id_pengguna', $p->user_id, ($p->user_id == $penjemputan->pelanggan_id)); ?>>
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
                                id="alamat" name="alamat" rows="3"><?= set_value('alamat', $penjemputan->alamat_pengguna) ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('alamat') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="berat">Berat (Kg)</label>
                            <input type="number" step="0.01" class="form-control <?= form_error('berat') ? 'is-invalid' : '' ?>" 
                                id="berat" name="berat" value="<?= set_value('berat', $penjemputan->berat) ?>">
                            <div class="invalid-feedback">
                                <?= form_error('berat') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_penjemputan">Tanggal Jemput</label>
                            <input type="date" class="form-control <?= form_error('tanggal_penjemputan') ? 'is-invalid' : '' ?>" 
                                id="tanggal_penjemputan" name="tanggal_penjemputan" value="<?= set_value('tanggal_penjemputan', isset($penjemputan->tanggal_penjemputan) ? $penjemputan->tanggal_penjemputan : '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('tanggal_penjemputan') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="waktu_penjemputan">Waktu Jemput</label>
                            <input type="time" class="form-control <?= form_error('waktu_penjemputan') ? 'is-invalid' : '' ?>" 
                                id="waktu_penjemputan" name="waktu_penjemputan" value="<?= set_value('waktu_penjemputan', isset($penjemputan->waktu_penjemputan) ? $penjemputan->waktu_penjemputan : '') ?>" min="08:00" max="16:00">
                            <div class="invalid-feedback">
                                <?= form_error('waktu_penjemputan') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" 
                                id="catatan" name="catatan" rows="3"><?= set_value('catatan', $penjemputan->catatan) ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('catatan') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('penjemputan') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
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