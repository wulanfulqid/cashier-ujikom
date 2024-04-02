<!-- Sidebar -->
<ul style="background-color: #5E7053;" class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a style="background-color: #5E7053;" class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/'); ?>img/ikon/CozyCrafted2.png" style="width: 40px; height: 80px;">
        </div>
        <div class="sidebar-brand-text mx-3">Cozy Crafted</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('Welcome/index'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
            Access
    </div>
    <div class="nav-item">
        <a class="nav-link <?php echo ($this->uri->segment(2) == 'Users') ? 'active' : ''; ?>"
            href="<?php echo site_url('Action/users') ?>">
                <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/produk'); ?>">
        <i class="fas fa-cube"></i>
            <span>Produk</span>
        </a>
    </li>
    <div class="nav-item">
        <a class="nav-link <?php echo ($this->uri->segment(2) == 'kategori') ? 'active' : ''; ?>"
            href="<?php echo site_url('Action/kategori') ?>">
                <i class="fas fa-fw fa-list"></i>
                    <span>Kategori</span>
        </a>
    </div>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Manajemen Aplikasi
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/pelanggan'); ?>">
        <i class="fas fa-users"></i>
            <span>Pelanggan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="fas fa-list-alt"></i>
            <span>Informasi Penjualan</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Menu</h6>
                <a class="collapse-item" href="<?= base_url('Welcome/penjualan'); ?>">Penjualan</a>
                <a class="collapse-item" href="<?= base_url('Welcome/detailPenjualan'); ?>">Detail Penjualan</a>
            </div>
        </div>
    </li>
    <div>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>

    <!-- Opsi Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Login/logout'); ?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
<!-- Sidebar -->