<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
    <div>
        <a href="<?= base_url('dashboard/tambah_mhs'); ?>" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Mahasiswa
        </a>
        <a href="<?= site_url('dashboard/export_excel'); ?>" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-file-excel fa-sm"></i> Excel
        </a>
        <a href="<?= site_url('dashboard/export_pdf'); ?>" class="btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-file-pdf fa-sm"></i> Pdf
        </a>
    </div>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($mahasiswa as $mhs) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="<?= base_url('assets/foto/').$mhs->foto; ?>" width="50" class="img-thumbnail">
                        </td>
                        <td><?= $mhs->npm; ?></td>
                        <td><?= $mhs->nama; ?></td>
                        <td>
							<a href="<?= base_url('dashboard/edit_mhs/' . $mhs->npm); ?>" class="btn btn-sm btn-warning">
								<i class="fas fa-edit"></i>
							</a>
							
							<a href="<?= site_url(['dashboard','export_excel_single', $mhs->npm])?>" class="btn btn-sm btn-success">
								<i class="fas fa-file-excel"></i>
							</a>

							<a href="<?= site_url('dashboard/print_mahasiswa/' . $mhs->npm); ?>" class="btn btn-sm btn-info">
								<i class="fas fa-file-pdf"></i>
							</a>

							<a href="<?php echo site_url('dashboard/qrcode/'. $mhs->npm); ?>" class="btn 
							btn-info btn-circle btn-sm" target="_blank" >
							<i class="fas fa-qrcode"></i> 
							</a>

							<a href="<?= base_url('dashboard/hapus_mhs/'.$mhs->npm); ?>" 
							   class="btn btn-sm btn-danger" 
							   onclick="return confirm('Yakin ingin menghapus data ini?')">
								<i class="fas fa-trash"></i>
							</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
