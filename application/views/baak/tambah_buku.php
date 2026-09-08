<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4" style="border-radius: 12px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Tambah Data Buku</h6>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger small">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?= validation_errors('<div class="alert alert-danger small">', '</div>'); ?>

                <form action="<?= base_url('dashboard/proses_tambah_buku'); ?>" method="post">
                    <div class="form-group">
                        <label class="small">Kode Buku</label>
                        <input type="text" name="kode_buku" class="form-control" placeholder="Masukkan kode buku (maks 6 karakter)" maxlength="6" value="<?= set_value('kode_buku'); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="small">Judul</label>
                        <textarea name="judul" class="form-control" rows="3" placeholder="Masukkan judul buku" required><?= set_value('judul'); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="small">Penulis</label>
                        <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis" maxlength="25" value="<?= set_value('penulis'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" placeholder="Masukkan nama penerbit" maxlength="50" value="<?= set_value('penerbit'); ?>" required>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan Data Buku
                    </button>
                    <a href="<?= base_url('dashboard/data_buku'); ?>" class="btn btn-secondary btn-block">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
