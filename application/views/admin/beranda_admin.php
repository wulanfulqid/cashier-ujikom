<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Beranda</title>
    <!-- Add your other head elements (stylesheets, scripts, etc.) here -->
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .custom-navbar {
            background-color: #5E7053;
            padding: 5px; /* Sesuaikan dengan kebutuhan padding */
            margin-bottom: 20px;
            margin-right: 20px;
            margin-left: 20px;
        }

        .custom-navbar a {
            margin-right: 15px;
            color: #ffffff;
        }

        .carousel-inner img {
            height: 500px; /* Sesuaikan tinggi dengan kebutuhan Anda */
        }

        .total-section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .total-section h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .total-section p {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <a class="nav-link" href="<?= base_url('Welcome'); ?>">
            <span>Admin Dashboard</span>
        </a>
    </nav>

    <!-- Container Fluid -->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        </div>

		<div class="row mb-3">
        <!-- Jumlah Pelanggan Card Example -->
        <div class="col-xl-4 mb-4">
        <a href="<?php echo site_url('Welcome/pelanggan'); ?>">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-2x text-info"></i>
                    <div class="text-left ml-3">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pelanggan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPelanggan; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Produk Card Example -->
        <div class="col-xl-4 mb-4">
        <a href="<?php echo site_url('Welcome/produk'); ?>">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    <div class="text-left ml-3">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahProduk; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Detail Penjualan Card Example -->
        <div class="col-xl-4 mb-4">
        <a href="<?php echo site_url('Welcome/detailPenjualan'); ?>">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-chart-area fa-2x text-warning"></i>
                    <div class="text-left ml-3">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahDetailPenjualan; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
        
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-indicators">
        <!-- Isi carousel-indicators sesuai kebutuhan Anda -->
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="http://localhost/pro.12rpl1/Cozcraft/assets/img/produk/kursiyun.png" class="d-block w-100" alt="...">
        </div>
	</div>
</div>
</div>
</div>
</div>
</body>

</html>
