<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kategori Sampah</h3>
                    <div class="card-tools">
                        <?php if ($this->session->userdata('level_id') != 3): ?>
                        <a href="<?= site_url('kategori_sampah/create') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Kategori
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Point per Kg</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kategori_sampah as $kategori) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $kategori->nama_kategori; ?></td>
                                        <td><?= $kategori->deskripsi; ?></td>
                                        <td><?= $kategori->point_per_kg; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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