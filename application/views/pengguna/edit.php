<div class="container-fluid">
    <h1>Edit Pengguna</h1>
    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('pengguna/edit/' . $pengguna->user_id) ?>" method="post">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="nama" value="<?= htmlspecialchars($pengguna->name) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($pengguna->email) ?>" required>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= htmlspecialchars($pengguna->nik) ?>" required>
                </div>
                <div class="form-group">
                    <label for="level_id">Level</label>
                    <select class="form-control" id="level_id" name="level_id" required>
                        <option value="1" <?= $pengguna->level_id == 1 ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= $pengguna->level_id == 2 ? 'selected' : '' ?>>Staff</option>
                        <option value="3" <?= $pengguna->level_id == 3 ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('pengguna') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div> 