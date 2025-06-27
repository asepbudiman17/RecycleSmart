<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Aplikasi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    
                    <form action="<?= base_url('pengaturan/update') ?>" method="post">
                        <?php
                        $settings = [];
                        foreach ($pengaturan as $p) {
                            $settings[$p->key] = $p->value;
                        }
                        ?>
                        
                        <div class="form-group">
                            <label for="nama_aplikasi">Nama Aplikasi</label>
                            <input type="text" class="form-control <?= form_error('nama_aplikasi') ? 'is-invalid' : '' ?>" 
                                id="nama_aplikasi" name="nama_aplikasi" 
                                value="<?= set_value('nama_aplikasi', $settings['nama_aplikasi'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('nama_aplikasi') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" 
                                id="alamat" name="alamat" rows="3"><?= set_value('alamat', $settings['alamat'] ?? '') ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('alamat') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control <?= form_error('telepon') ? 'is-invalid' : '' ?>" 
                                id="telepon" name="telepon" 
                                value="<?= set_value('telepon', $settings['telepon'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('telepon') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
                                id="email" name="email" 
                                value="<?= set_value('email', $settings['email'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('email') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="minimal_penukaran">Minimal Penukaran (Kg)</label>
                            <input type="number" class="form-control <?= form_error('minimal_penukaran') ? 'is-invalid' : '' ?>" 
                                id="minimal_penukaran" name="minimal_penukaran" 
                                value="<?= set_value('minimal_penukaran', $settings['minimal_penukaran'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('minimal_penukaran') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="poin_per_kg">Poin per Kg</label>
                            <input type="number" class="form-control <?= form_error('poin_per_kg') ? 'is-invalid' : '' ?>" 
                                id="poin_per_kg" name="poin_per_kg" 
                                value="<?= set_value('poin_per_kg', $settings['poin_per_kg'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= form_error('poin_per_kg') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
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
