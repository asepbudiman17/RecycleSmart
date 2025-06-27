<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pengumpulan Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?= site_url('pengumpulan/create') ?>" method="post">
                        <div class="form-group">
                            <label for="nama_pengguna">Pengguna</label>
                            <?php if (strtolower($this->session->userdata('level_id')) == '1'): ?>
                                <select class="form-control" id="id_pengguna" name="id_pengguna">
                                    <option value="">Pilih Pengguna</option>
                                    <?php foreach ($pengguna as $p): ?>
                                        <option value="<?= $p->user_id; ?>" <?= set_select('id_pengguna', $p->user_id); ?>><?= $p->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <input type="text" class="form-control" id="nama_pengguna" value="<?= $user->name ?>" readonly>
                                <input type="hidden" name="id_pengguna" value="<?= $user->user_id ?>">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori Sampah</label>
                            <select class="form-control <?= form_error('kategori_id') ? 'is-invalid' : '' ?>" id="id_kategori" name="id_kategori">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->kategori_id; ?>" <?= set_select('kategori_id', $k->kategori_id); ?>>
                                        <?= $k->nama_kategori; ?> (<?= $k->point_per_kg; ?> poin/kg)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('kategori_id') ?>
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
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control <?= form_error('tanggal') ? 'is-invalid' : '' ?>" 
                                id="tanggal" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d')) ?>">
                            <div class="invalid-feedback">
                                <?= form_error('tanggal') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('pengumpulan') ?>" class="btn btn-secondary">Kembali</a>
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