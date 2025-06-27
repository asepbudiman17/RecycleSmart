<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Pengguna</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
        </div>
        <div class="card-body">
            <?= form_open('pengguna/create'); ?>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="text-danger"> ', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger"> ', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= set_value('nik'); ?>">
                    <?= form_error('nik', '<small class="text-danger"> ', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="level_id">Level</label>
                    <select class="form-control" id="level_id" name="level_id">
                        <option value="">Pilih Level</option>
                        <option value="1" <?= set_select('level_id', '1'); ?>>Admin</option>
                        <option value="2" <?= set_select('level_id', '2'); ?>>Staff</option>
                        <option value="3" <?= set_select('level_id', '3'); ?>>User</option>
                    </select>
                    <?= form_error('level_id', '<small class="text-danger"> ', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('pengguna') ?>" class="btn btn-secondary">Batal</a>
            <?= form_close(); ?>
        </div>
    </div>
</div> 