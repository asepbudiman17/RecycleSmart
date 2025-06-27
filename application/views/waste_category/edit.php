<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Kategori Sampah</h4>
                </div>
                <div class="card-body">
                    <?php echo form_open('waste_category/edit/'.$category->id); ?>
                        <div class="form-group mb-3">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : ''; ?>" 
                                   id="name" name="name" value="<?php echo set_value('name', $category->name); ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control <?php echo form_error('description') ? 'is-invalid' : ''; ?>" 
                                      id="description" name="description" rows="4"><?php echo set_value('description', $category->description); ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo form_error('description'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="<?php echo site_url('waste_category'); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div> 