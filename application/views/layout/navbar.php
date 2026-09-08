<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                Halo, <?= $this->session->userdata('name'); ?> | 
				<a href="<?= base_url('auth/logout'); ?>"> Logout</a>
            </span>
        </li>
      
    </ul>
</nav>
