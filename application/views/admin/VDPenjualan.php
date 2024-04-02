<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
    <!-- Link stylesheets dan scripts jika diperlukan -->
    <link href="your-styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Styles for your existing code */
        .custom-card {
            margin: 20px;
            margin-bottom: 70px;
            position: relative; /* Add this to use as a reference for absolute positioning */
        }

        .custom-table {
            margin-top: 20px;
            padding: 20px;
        }

        .custom-table table {
            width: 100%;
        }

        .filter-export-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px; /* Adjust margin to increase the distance */
            margin-right: 750px; /* Adjust margin to the right */
            margin-left: 40px; /* Adjust margin to the left */
        }

        .filter-form {
            display: flex;
            align-items: center;
            margin-right: 20px; /* Add margin to the right of the filter form */
        }

        .btn-export {
            margin-left: 20px; /* Add margin to the left of the Export PDF button */
        }

		.highest-quantity {
			margin-top: 1px;
			margin-bottom: 40px; /* Sesuaikan jarak bottom sesuai kebutuhan */
			padding: 10px;
			color: #155724;
			background-color: #d4edda;
			border-color: #c3e6cb;
			border-radius: 0.25rem;
			width: fit-content;
			margin-right: auto;
			margin-left: 5px;
		}

        .custom-navbar {
            background-color: #5E7053;
            padding: 5px;
            margin-bottom: 20px;
            margin-right: 20px;
            margin-left: 20px;
        }

        .custom-navbar a {
            margin-right: 15px;
            color: #ffffff;
        }

        .filter-form label {
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .filter-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <a class="nav-link" href="<?= base_url('Welcome');?>">
            <span>Dashboard</span>
        </a>/
        <a class="nav-link" href="<?= base_url('Welcome/detailpenjualan');?>">
            <span>Detail Penjualan</span>
        </a>
    </nav>

    <!-- Filter card -->
    <div class="card mb-4 custom-card filter-card">
        <div class="card-header"><br>
            <div class="container-fluid">
                <h5 class="card-title">LAPORAN BERDASARKAN TANGGAL</h5>
            </div>
        </div>

        <div class="card-body">
            <!-- Filter form and Export PDF button section -->
            <div class="filter-export-section">
                <!-- Filter form -->
                <form class="filter-form" action="<?= site_url('Action/filter_detail_penjualan'); ?>" method="post">
                    <label for="startDate">Start:</label>
                    <input type="date" id="startDate" name="startDate" required>
                    <br> <!-- Add line break here for spacing -->
                    <label for="endDate">End:</label>
                    <input type="date" id="endDate" name="endDate" required>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                </form>
                <!-- Export PDF button -->
                <a class="btn btn-danger btn-export" href="<?php echo site_url('Action/export_pdf_detailpenjualan'); ?>" name="bexport">
                    <i class="fa fa-file"></i> Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Tabel card -->
    <div class="card mb-4 custom-card">
        <div class="card-header">
        </div>

        <nav class="navbar bg-body-tertiary justify-content-between">
            <div class="container-fluid">
                <h5 class="card-title">DATA DETAIL PENJUALAN</h5>
            </div>
        </nav>

        <div class="card-body">
            <div class="table-responsive custom-table">
                <table class="table table-bordered table-striped" id="exampleDataTable">
                    <!-- Table Header -->
                    <thead style="background-color: #5E7053;" class="text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Penjualan</th>
                            <!-- <th scope="col">Nama Pelanggan</th> -->
                            <th scope="col">Nama Produk</th>
                            <th hidden scope="col">Detail ID</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
					<?php
                        if (!empty($DetailPenjualan)) {
                            $no = 1;
                            $totalExpenses = 0;
                            $monthlySales = array();
                            $maxProductSales = array();

                            foreach ($DetailPenjualan as $ReadDS) {
                                $saleYearMonth = date('Y-m', strtotime($ReadDS->PenjualanID));

                                if (!isset($monthlySales[$saleYearMonth])) {
                                    $monthlySales[$saleYearMonth] = 0;
                                }

                                $monthlySales[$saleYearMonth] += $ReadDS->Subtotal;

                                $productName = '';
                                foreach ($DataProduk as $produk) {
                                    if ($produk->ProdukID == $ReadDS->ProdukID) {
                                        $productName = $produk->NamaProduk;
                                        break;
                                    }
                                }

                                // $customerName = '';
                                // foreach ($DataPelanggan as $pelanggan) {
                                //     if ($pelanggan->PelangganID == $ReadDS->PelangganID) {
                                //         $customerName = $pelanggan->NamaPelanggan;
                                //         break;
                                //     }
                                // }

                                // Inisialisasi total penjualan produk jika belum ada
                                if (!isset($maxProductSales[$productName])) {
                                    $maxProductSales[$productName] = 0;
                                }

                                // Tambahkan jumlah produk ke total penjualan produk
                                $maxProductSales[$productName] += $ReadDS->JumlahProduk;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $ReadDS->PenjualanID; ?></td>
                                    <!-- <td><?php echo $customerName; ?></td> Menambah kolom NamaPelanggan -->
                                    <td><?php echo $productName; ?></td>
                                    <td hidden><?php echo $ReadDS->DetailID; ?></td>
                                    <td><?php echo $ReadDS->JumlahProduk; ?></td>
                                    <td><?php echo "Rp. " . number_format($ReadDS->Subtotal, 2, ',', '.'); ?></td>
                                </tr>
                                <?php
                                $totalExpenses += $ReadDS->Subtotal;
                                $no++;
                            }
                        }
						// Temukan produk dengan penjualan terbanyak
						$maxProductName = '';
						$maxQuantity = 0;
						foreach ($maxProductSales as $productName => $quantity) {
							if ($quantity > $maxQuantity) {
								$maxQuantity = $quantity;
								$maxProductName = $productName;
							}
						}

						// Tampilkan hasil
						if ($maxQuantity > 0) {
							echo '<div class="highest-quantity"><strong>Produk Paling Banyak Terjual:</strong> ' . $maxProductName . ' (' . $maxQuantity . ' units)</div>';
						}
						?>
                    </tbody>
                </table>
            </div>

            <!-- Display total daily expenses -->
            <div class="total-expenses">
                <strong>Total Penjualan :</strong> Rp. <?php echo number_format($totalExpenses, 2, ',', '.'); ?>
            </div>

            <!-- Display total sales per month -->
            <div class="total-expenses mt-4">
                <strong>Total Penjualan Per Bulan:</strong>
                <ul>
                    <?php
                    foreach ($monthlySales as $month => $monthlyTotal) {
                        echo '<li>' . date('F Y', strtotime($month)) . ': Rp. ' . number_format($monthlyTotal, 2, ',', '.') . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Your existing scripts -->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/ruang-admin.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#exampleDataTable').DataTable();
        });
    </script>
    <!-- Script Bootstrap dan lainnya -->
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
</body>
</html>
