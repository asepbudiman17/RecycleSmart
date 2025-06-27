<!-- Main content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <?php 
            if ($user->level_id == 1) echo 'Profil Administrator';
            elseif ($user->level_id == 2) echo 'Profil Staff';
            else echo 'Profil Pengguna';
        ?>
    </h1>

    <style>
        .form-group.row label.col-form-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 15px; /* Tambahkan sedikit padding agar colon tidak terlalu mepet ke kanan */
        }
        .form-group.row label.col-form-label::after {
            content: ":";
        }
        /* Aturan CSS baru untuk mengubah warna teks input menjadi hitam */
        input.form-control-plaintext {
            color: black !important; /* Gunakan !important untuk memastikan override */
        }
    </style>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Profil Anda</h6>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-primary btn-sm shadow-sm" id="editProfileBtn" type="button">
                            <i class="fas fa-edit fa-sm text-white-50"></i> Edit Profil
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= site_url('dashboard/profile_update') ?>" id="profileForm">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-dark" value="<?= ucwords(htmlspecialchars($user->name)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" readonly class="form-control-plaintext text-dark editable-field" id="userEmail" name="email" value="<?= htmlspecialchars($user->email); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-dark" value="<?= htmlspecialchars($user->nik); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Level</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-dark" value="<?php
                                    if ($user->level_id == 1) echo 'Admin';
                                    elseif ($user->level_id == 2) echo 'Pengepul';
                                    else echo 'User';
                                ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-dark" value="<?= htmlspecialchars($user->alamat ?? '-'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext text-dark editable-field" id="userTelepon" name="telepon" value="<?= htmlspecialchars($user->telepon ?? '-'); ?>">
                            </div>
                        </div>
                        <div class="form-group row d-none" id="profileFormButtons">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                    <i class="fas fa-save fa-sm text-white-50"></i> Simpan
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm shadow-sm ml-2" id="cancelEditBtn">
                                    <i class="fas fa-times fa-sm text-white-50"></i> Batal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editProfileBtn = document.getElementById('editProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const userEmailInput = document.getElementById('userEmail');
        const userTeleponInput = document.getElementById('userTelepon');
        const profileFormButtons = document.getElementById('profileFormButtons');
        let originalEmail = userEmailInput.value;
        let originalTelepon = userTeleponInput.value;

        editProfileBtn.addEventListener('click', function() {
            originalEmail = userEmailInput.value;
            originalTelepon = userTeleponInput.value;
            userEmailInput.removeAttribute('readonly');
            userTeleponInput.removeAttribute('readonly');
            userEmailInput.classList.remove('form-control-plaintext');
            userTeleponInput.classList.remove('form-control-plaintext');
            userEmailInput.classList.add('form-control');
            userTeleponInput.classList.add('form-control');
            editProfileBtn.classList.add('d-none');
            profileFormButtons.classList.remove('d-none');
        });

        cancelEditBtn.addEventListener('click', function() {
            userEmailInput.setAttribute('readonly', true);
            userTeleponInput.setAttribute('readonly', true);
            userEmailInput.classList.remove('form-control');
            userTeleponInput.classList.remove('form-control');
            userEmailInput.classList.add('form-control-plaintext');
            userTeleponInput.classList.add('form-control-plaintext');
            userEmailInput.value = originalEmail;
            userTeleponInput.value = originalTelepon;
            editProfileBtn.classList.remove('d-none');
            profileFormButtons.classList.add('d-none');
        });
    });
</script> 