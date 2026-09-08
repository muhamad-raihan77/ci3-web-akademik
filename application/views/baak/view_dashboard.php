<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Akademik</h6>
        Selamat datang, <b><?= $this->session->userdata('name'); ?></b>. Melalui panel ini Anda dapat mengelola data master akademik seperti Mahasiswa, Dosen, dan Nilai.
    </div>
    
</div>


<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mahasiswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">120 Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="<?= base_url('baak/mahasiswa'); ?>" class="btn btn-sm btn-primary mt-3">Kelola Mahasiswa</a>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Dosen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">45 Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-success mt-3">Lihat Data</a>
            </div>
        </div>
    </div>
</div>


