<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4" style="border-radius: 12px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Edit Data Matakuliah</h6>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger small">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('dashboard/proses_edit_mk'); ?>" method="post">
                    <input type="hidden" name="kode_mk" value="<?= $mk->kode_mk; ?>">

                    <div class="form-group">
                        <label class="small">Kode Matakuliah</label>
                        <input type="text" class="form-control" value="<?= $mk->kode_mk; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="small">Nama Matakuliah</label>
                        <input type="text" name="nama_mk" class="form-control" value="<?= $mk->nama_mk; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">SKS</label>
                        <input type="number" name="sks" class="form-control" value="<?= $mk->sks; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">Semester</label>
                        <input type="number" name="sem" class="form-control" value="<?= $mk->sem; ?>" required>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('dashboard/data_mataku'); ?>" class="btn btn-secondary btn-block">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
