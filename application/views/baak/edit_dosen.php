<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Dosen</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('dashboard/proses_edit_dosen'); ?>" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIDN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="NIDN" value="<?= $dosen->NIDN; ?>" readonly>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="Nama" value="<?= $dosen->Nama; ?>" required>
                    <?= form_error('Nama', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('dashboard/data_dosen'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
