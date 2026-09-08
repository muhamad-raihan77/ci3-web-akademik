<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Mahasiswa</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/proses_edit_mhs'); ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="npm" value="<?= $mhs->npm; ?>">
                    <input type="hidden" name="foto_lama" value="<?= $mhs->foto; ?>">

                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" name="npm" class="form-control" value="<?= $mhs->npm; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" value="<?= $mhs->nama; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Saat Ini</label><br>
                        <img src="<?= base_url('assets/foto/') . $mhs->foto; ?>" width="100" class="img-thumbnail mb-2">
                        <input type="file" name="foto" class="form-control-file">
                        <small class="text-info">*Kosongkan jika tidak ingin ganti foto</small>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success btn-block">Simpan Perubahan</button>
                    <a href="<?= base_url('dashboard/data_mahasiswa'); ?>" class="btn btn-secondary btn-block">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
