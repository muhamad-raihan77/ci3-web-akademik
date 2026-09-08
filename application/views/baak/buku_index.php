<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Buku</h1>
    <div>
        <a href="<?= base_url('dashboard/export_excel_buku'); ?>" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-file-excel fa-sm text-white-50"></i> Export Excel
        </a>
        <a href="<?= base_url('dashboard/export_pdf_buku'); ?>" class="btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-file-pdf fa-sm text-white-50"></i> Export PDF
        </a>
        <a href="<?= base_url('dashboard/tambah_buku'); ?>" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Buku</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($buku as $b): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $b->kode_buku; ?></td>
                        <td><?= $b->judul; ?></td>
                        <td><?= $b->penulis; ?></td>
                        <td><?= $b->penerbit; ?></td>
                        <td>
                            <a href="<?= base_url('dashboard/edit_buku/' . $b->kode_buku); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="<?= base_url('dashboard/hapus_buku/' . $b->kode_buku); ?>" 
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
