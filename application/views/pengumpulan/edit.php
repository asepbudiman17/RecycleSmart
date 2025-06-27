<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pengumpulan Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?= base_url('pengumpulan/edit/' . $pengumpulan->pengumpulan_id) ?>" method="post">
                        <div class="form-group">
                            <label for="id_pengguna">Pengguna</label>
                            <select class="form-control <?= form_error('id_pengguna') ? 'is-invalid' : '' ?>" id="id_pengguna" name="id_pengguna" disabled>
                                <option value="">Pilih Pengguna</option>
                                <?php foreach ($pengguna as $p) : ?>
                                    <option value="<?= $p->user_id; ?>" <?= set_select('id_pengguna', $p->user_id, ($p->user_id == $pengumpulan->pengguna_id)); ?>>
                                        <?= htmlspecialchars($p->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_pengguna" value="<?= $pengumpulan->pengguna_id ?>">
                            <div class="invalid-feedback">
                                <?= form_error('id_pengguna') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_kategori">Kategori Sampah</label>
                            <select class="form-control <?= form_error('id_kategori') ? 'is-invalid' : '' ?>" id="id_kategori" name="id_kategori" disabled>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->kategori_id; ?>" <?= set_select('id_kategori', $k->kategori_id, ($k->kategori_id == $pengumpulan->kategori_id)); ?>>
                                        <?= htmlspecialchars($k->nama_kategori); ?> (<?= $k->point_per_kg; ?> poin/kg)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_kategori" value="<?= $pengumpulan->kategori_id ?>">
                            <div class="invalid-feedback">
                                <?= form_error('id_kategori') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="berat">Berat (Kg)</label>
                            <input type="number" step="0.01" class="form-control <?= form_error('berat') ? 'is-invalid' : '' ?>" 
                                id="berat" name="berat" value="<?= set_value('berat', $pengumpulan->berat) ?>">
                            <div class="invalid-feedback">
                                <?= form_error('berat') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control <?= form_error('tanggal') ? 'is-invalid' : '' ?>" 
                                id="tanggal" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d', strtotime($pengumpulan->tanggal))) ?>" readonly>
                            <div class="invalid-feedback">
                                <?= form_error('tanggal') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('pengumpulan') ?>" class="btn btn-secondary">Kembali</a>
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
