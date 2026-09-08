<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4" style="border-radius: 12px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-plus"></i> Tambah Data Dosen</h6>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger small">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('dashboard/proses_tambah_mhs'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="small">NPM (Nomor Pokok Mahasiswa)</label>
                        <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Mahasiswa" required>
                    </div>

                    <div class="form-group">
                        <label class="small">Upload Foto</label>
                        <input type="file" name="foto" class="form-control-file border p-1" style="border-radius: 5px;" required>
                        <small class="text-muted">Format: jpg, jpeg, png (Maks. 2MB)</small>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan Data Mahasiswa
                    </button>
                    <a href="<?= base_url('dashboard/data_mahasiswa'); ?>" class="btn btn-secondary btn-block">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
