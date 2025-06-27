<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Reward Baru</h6>
        </div>
        <div class="card-body">
            <?= form_open('reward/create') ?>
                <div class="form-group">
                    <label for="jenis_reward">Jenis Reward</label>
                    <select class="form-control <?= form_error('jenis_reward') ? 'is-invalid' : '' ?>"
                            id="jenis_reward" name="jenis_reward">
                        <option value="">-- Pilih Jenis Reward --</option>
                        <option value="minuman" <?= set_select('jenis_reward', 'minuman') ?>>Minuman</option>
                        <option value="makanan" <?= set_select('jenis_reward', 'makanan') ?>>makanan</option>
                        <!-- Add more options as needed -->
                    </select>
                     <div class="invalid-feedback">
                        <?= form_error('jenis_reward') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_reward">Nama Reward</label>
                    <select class="form-control <?= form_error('nama_reward') ? 'is-invalid' : '' ?>"
                            id="nama_reward" name="nama_reward">
                        <option value="">-- Pilih Nama Reward --</option>
                        <?php foreach ($rewards as $reward) : ?>
                            <option value="<?= $reward->nama_reward ?>" data-poin="<?= $reward->poin_required ?>" <?= set_select('nama_reward', $reward->nama_reward) ?>><?= $reward->nama_reward ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= form_error('nama_reward') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="poin_required">Poin yang Dibutuhkan</label>
                    <input type="number" class="form-control <?= form_error('poin_required') ? 'is-invalid' : '' ?>" 
                           id="poin_required" name="poin_required" value="<?= set_value('poin_required') ?>">
                    <div class="invalid-feedback">
                        <?= form_error('poin_required') ?>
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
                    <label for="status">Status</label>
                    <select class="form-control <?= form_error('status') ? 'is-invalid' : '' ?>" 
                            id="status" name="status">
                        <option value="aktif" <?= set_select('status', 'aktif') ?>>Aktif</option>
                        <option value="nonaktif" <?= set_select('status', 'nonaktif') ?>>Nonaktif</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= form_error('status') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('reward') ?>" class="btn btn-secondary">Kembali</a>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Add JavaScript to handle point suggestion based on reward type -->
<script>
    // Function to update poin_required based on selected reward name
    document.getElementById('nama_reward').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const poinInput = document.getElementById('poin_required');
        
        // Get poin from data attribute
        const suggestedPoin = selectedOption.getAttribute('data-poin');
        
        poinInput.value = suggestedPoin || ''; // Set the value, clear if no poin data
    });

    document.getElementById('jenis_reward').addEventListener('change', function() {
        const jenisReward = this.value;
        const poinInput = document.getElementById('poin_required');
        let suggestedPoin = ''; // Default empty

        // Define suggested points based on reward type
        switch (jenisReward) {
            case 'minuman':
                suggestedPoin = '150'; // Example: Minuman suggests 100 points
                break;
            case 'makanan':
                suggestedPoin = '300'; // Example: makanan suggests 50 points
                break;
            // Add more cases for other types
            default:
                suggestedPoin = ''; // Clear if no type selected or unknown type
        }

        poinInput.value = suggestedPoin;
    });
</script> 