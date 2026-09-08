<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-university"></i></div>
        <div class="sidebar-brand-text mx-3">Akademik</div>
    </a>
    <hr class="sidebar-divider my-0">
    <?php if($this->session->userdata('role_id') == 1):?>
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/pengguna'); ?>">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Data Pengguna</span>
        </a>
    </li>
   
    <?php endif; ?>
    
    <?php if($this->session->userdata('role_id') == 2): ?>
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/data_mahasiswa'); ?>">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Data Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/data_mataku'); ?>">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Data matakuliah</span>
        </a>
    </li>

<li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/data_dosen'); ?>">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Data Dosen</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/data_buku'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Buku</span>
        </a>
    </li>

    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('chatbot'); ?>">
            <i class="fas fa-fw fa-robot"></i>
            <span>Chatbot</span>
        </a>
    </li>
</ul>
