<!-- Sidebar -->
<ul style="background-color: #7E6E4B;" class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a style="background-color: #5E7053;" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/'); ?>img/ikon/CozyCrafted2.png" style="width: 40px; height: 80px;">
            </div>
            <div class="sidebar-brand-text mx-3">Cozy Crafted</div>
    </a>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('Welcome/index'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Manajemen Aplikasi
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/penjualan'); ?>">
        <i class="fas fa-shopping-bag"></i>
            <span>Penjualan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/pelanggan'); ?>">
        <i class="fas fa-users"></i>
            <span>Pelanggan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/detailPenjualan'); ?>">
        <i class="fas fa-book"></i>
            <span>Detail Penjualan</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Welcome/produk'); ?>">
        <i class="fas fa-cube"></i>
            <span>Produk</span>
        </a>
    </li>
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