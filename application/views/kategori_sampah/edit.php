<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Main content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Kategori Sampah</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kategori</h6>
        </div>
        <div class="card-body">
            <?= form_open('kategori_sampah/edit/' . $kategori->kategori_id) ?>
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control <?= form_error('nama_kategori') ? 'is-invalid' : '' ?>" 
                           id="nama_kategori" name="nama_kategori" value="<?= set_value('nama_kategori', $kategori->nama_kategori) ?>">
                    <div class="invalid-feedback">
                        <?= form_error('nama_kategori') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" 
                              id="deskripsi" name="deskripsi" rows="3"><?= set_value('deskripsi', $kategori->deskripsi) ?></textarea>
                    <div class="invalid-feedback">
                        <?= form_error('deskripsi') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="point_per_kg">Point per Kg</label>
                    <input type="number" class="form-control <?= form_error('point_per_kg') ? 'is-invalid' : '' ?>" 
                           id="point_per_kg" name="point_per_kg" value="<?= set_value('point_per_kg', $kategori->point_per_kg) ?>">
                    <div class="invalid-feedback">
                        <?= form_error('point_per_kg') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('kategori_sampah') ?>" class="btn btn-secondary">Kembali</a>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php $this->load->view('templates/footer'); ?>
