
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Seluruh Pengguna</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pengguna</h6>
            <a href="<?= site_url('pengguna/add') ?>" class="btn btn-primary btn-sm mt-2">Tambah Pengguna</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pengguna as $user) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($user->name); ?></td>
                            <td><?= htmlspecialchars($user->email); ?></td>
                            <td><?= htmlspecialchars($user->nik); ?></td>
                            <td>
                                <?php
                                    if ($user->level_id == 1) echo 'Admin';
                                    elseif ($user->level_id == 2) echo 'Staff';
                                    else echo 'User';
                                ?>
                            </td>
                            <td>
                                <a href="<?= site_url('pengguna/edit/' . $user->user_id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= site_url('pengguna/delete/' . $user->user_id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
