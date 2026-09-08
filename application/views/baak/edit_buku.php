<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4" style="border-radius: 12px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Edit Data Buku</h6>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger small">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('dashboard/proses_edit_buku'); ?>" method="post">
                    <input type="hidden" name="kode_buku" value="<?= $buku->kode_buku; ?>">

                    <div class="form-group">
                        <label class="small">Kode Buku</label>
                        <input type="text" class="form-control" value="<?= $buku->kode_buku; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="small">Judul</label>
                        <textarea name="judul" class="form-control" rows="3" required><?= $buku->judul; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="small">Penulis</label>
                        <input type="text" name="penulis" class="form-control" maxlength="25" value="<?= $buku->penulis; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" maxlength="50" value="<?= $buku->penerbit; ?>" required>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('dashboard/data_buku'); ?>" class="btn btn-secondary btn-block">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
