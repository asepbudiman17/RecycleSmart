<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <?php
            if ($user->level_id == 1) echo 'Profil Administrator';
            elseif ($user->level_id == 2) echo 'Profil Staff';
            else echo 'Profil Pengguna';
        ?>
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Profil</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Nama:</strong>
                </div>
                <div class="col-md-9">
                    <?= htmlspecialchars($user->name); ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-9">
                    <?= htmlspecialchars($user->email); ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>NIK:</strong>
                </div>
                <div class="col-md-9">
                    <?= htmlspecialchars($user->nik); ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Level:</strong>
                </div>
                <div class="col-md-9">
                    <?php
                        if ($user->level_id == 1) echo 'Admin';
                        elseif ($user->level_id == 2) echo 'Staff';
                        else echo 'User';
                    ?>
                </div>
            </div>
            <hr>
            <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
</div> 