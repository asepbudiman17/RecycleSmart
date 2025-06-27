
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Kategori Sampah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?= site_url('kategori_sampah/create') ?>" method="post">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control <?= form_error('nama_kategori') ? 'is-invalid' : '' ?>" 
                                   id="nama_kategori" name="nama_kategori" value="<?= set_value('nama_kategori') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('nama_kategori') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" 
                                      id="deskripsi" name="deskripsi" rows="3"><?= set_value('deskripsi') ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('deskripsi') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="point_per_kg">Point per Kg</label>
                            <input type="number" step="0.01" class="form-control <?= form_error('point_per_kg') ? 'is-invalid' : '' ?>" 
                                   id="point_per_kg" name="point_per_kg" value="<?= set_value('point_per_kg') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('point_per_kg') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('kategori_sampah') ?>" class="btn btn-secondary">Kembali</a>
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

