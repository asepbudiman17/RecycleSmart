<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Penjemputan Sampah</h3>
                    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2 || $this->session->userdata('level_id') == 3) : ?>
                    <div class="card-tools">
                        <a href="<?= base_url('penjemputan/create') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Penjemputan
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal & Waktu Penjemputan</th>
                                <th>Nama Pengguna</th>
                                <th>Alamat</th>
                                <th>Catatan</th>
                                <th>Berat (Kg)</th>
                                <th>Poin</th>
                                <th>Status</th>
                                <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2) : ?>
                                <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($penjemputan as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($p->tanggal_waktu_penjemputan)); ?>
                                        (<?= date('H:i', strtotime($p->tanggal_waktu_penjemputan)); ?> WIB)
                                    </td>
                                    <td><?= $p->nama_pengguna; ?></td>
                                    <td><?= $p->alamat_pengguna; ?></td>
                                    <td><?= $p->catatan; ?></td>
                                    <td><?= isset($p->berat) ? $p->berat : '0' ?></td>
                                    <td><?= isset($p->poin) ? $p->poin : '0' ?></td>
                                    <td>
                                        <?php if ($p->status == 'menunggu') : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($p->status == 'proses') : ?>
                                            <span class="badge badge-info">Proses</span>
                                        <?php elseif ($p->status == 'dalam_perjalanan') : ?>
                                            <span class="badge badge-info">Dalam Perjalanan</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2) : ?>
                                    <td>
                                        <?php if ($p->status == 'menunggu') : ?>
                                            <a href="<?= site_url('penjemputan/update_status/' . $p->penjemputan_id . '/dalam_perjalanan'); ?>" 
                                               class="btn btn-info btn-sm"
                                               onclick="return confirm('Apakah Anda yakin ingin memproses penjemputan ini?');">
                                                <i class="fas fa-play"></i> Proses
                                            </a>
                                        <?php elseif ($p->status == 'dalam_perjalanan') : ?>
                                            <!-- Tombol untuk memunculkan modal -->
                                           <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSelesai<?= $p->penjemputan_id ?>">
                                                <i class="fas fa-check"></i> Selesai
                                            </button>
                                             <a href="<?= site_url('penjemputan/edit/' . $p->penjemputan_id); ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= site_url('penjemputan/delete/' . $p->penjemputan_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                       
                                        <?php elseif ($p->status == 'selesai') : ?>
                                             <a href="<?= site_url('penjemputan/update_status/' . $p->penjemputan_id. '/dalam_perjalanan'); ?>" 
                                               class="btn btn-secondary btn-sm"
                                               onclick="return confirm('Apakah Anda yakin ingin membatalkan penyelesaian penjemputan ini?');">
                                                <i class="fas fa-undo"></i> Batalkan Selesai
                                            </a>
                                        <?php endif; ?>
                                        
                                           
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

<?php if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2) : ?>
<?php foreach ($penjemputan as $p) : ?>
<div class="modal fade" id="modalSelesai<?= $p->penjemputan_id ?>" tabindex="-1" role="dialog" aria-labelledby="modalSelesaiLabel<?= $p->penjemputan_id ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= site_url('penjemputan/selesai/' . $p->penjemputan_id) ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSelesaiLabel<?= $p->penjemputan_id ?>">Konfirmasi Penyelesaian Penjemputan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="catatan_selesai">Catatan Penyelesaian</label>
            <textarea class="form-control" name="catatan_selesai" id="catatan_selesai" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Selesaikan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
