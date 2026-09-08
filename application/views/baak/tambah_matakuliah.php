<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4" style="border-radius: 12px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Tambah Data Matakuliah</h6>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger small">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?= validation_errors('<div class="alert alert-danger small">', '</div>'); ?>

                <form action="<?= base_url('dashboard/proses_tambah_mk'); ?>" method="post">
                    <div class="form-group">
                        <label class="small">Kode Matakuliah</label>
                        <input type="text" name="kode_mk" class="form-control" placeholder="Masukkan kode matakuliah" value="<?= set_value('kode_mk'); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="small">Nama Matakuliah</label>
                        <input type="text" name="nama_mk" class="form-control" placeholder="Masukkan nama matakuliah" value="<?= set_value('nama_mk'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">SKS</label>
                        <input type="number" name="sks" class="form-control" placeholder="Masukkan jumlah SKS" value="<?= set_value('sks'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="small">Semester</label>
                        <input type="number" name="sem" class="form-control" placeholder="Masukkan semester" value="<?= set_value('sem'); ?>" required>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan Data Dosen
                    </button>
                    <a href="<?= base_url('dashboard/data_mataku'); ?>" class="btn btn-secondary btn-block">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
