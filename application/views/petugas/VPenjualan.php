<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <link rel="icon" href="assets/img/chasier-image.png" type="image/x-icon">
    <link href="path/to/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-++GahA8Smki4iFbYp0t8h1Z6HPQMGsW11MyeKzTeOT0Mq6sM2xqtx+dGMG1vXa0RdUU5MdJxY6gB65FScg06uQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-OLQ/ceCCD8JZlH2r98v6d4tprZfV0gF3UqUp4lfF/Z9TwIazlL0AtO8Cz3sxsC7+OuNm3biVQp4cjTBFP3hT6Q==" crossorigin="anonymous" />
	<style>
	.modal-content {
        width: 200%;
        max-width: none;
        margin-left: -15%; /* Adjust the left margin to center the modal */
        transform: translateX(-15%);
    }
    .custom-card {
        margin: 20px;
        margin-bottom: 70px;
    }

    .custom-table {
        margin-top: 20px;
        padding: 20px;
    }

    .custom-table table {
        width: 100%;
    }

    /* New styles for the Keranjang table */
    #keranjangTable {
        margin-top: 20px;
        width: 100%;
        overflow-x: auto; /* Add horizontal scroll if needed */
    }

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
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <a class="nav-link" href="<?= base_url('Welcome');?>">
        <span>Dashboard</span>
    </a>/
    <a class="nav-link" href="<?= base_url('Welcome/penjualan');?>">
        <span>Penjualan</span>
    </a>
</nav>

    <div class="card custom-card">
        <div class="card-header text-center">
            <h3>Data Transaksi</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#productListModal">
						<i class="fas fa-shopping-cart"></i>
                        Lihat Daftar Produk
                    </button>
                </div>
            </div>

            <!-- Modal for Product List -->
            <div class="modal fade" id="productListModal" tabindex="-1" role="dialog" aria-labelledby="productListModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" modal-centered>
                        <div class="modal-header">
                            <h5 class="modal-title" id="productListModalLabel">Daftar Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped mx-auto" id="exampleDataTable">
                                <thead style="background-color: #5E7053;" class="text-white">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Tambah ke Keranjang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($DataProduk)) {
                                        $no = 1;
                                        foreach ($DataProduk as $produk) {
                                            if ($produk->Stok > 0) { // Check if the product is in stock
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $no; ?></th>
                                                    <td><?php echo $produk->NamaProduk; ?></td>
                                                    <!-- Perbaikan format rupiah -->
                                                    <td><?php echo "Rp. " . number_format($produk->Harga, 2, ',', '.'); ?></td>
                                                    <td>
                                                        <form action="<?php echo site_url('welcome/tambah_ke_penjualan'); ?>" method="post">
                                                            <input type="hidden" name="ProdukID" value="<?php echo $produk->ProdukID; ?>">
                                                            <input type="hidden" name="NamaProduk" value="<?php echo $produk->NamaProduk; ?>">
                                                            <input type="hidden" name="Harga" value="<?php echo $produk->Harga; ?>">
                                                            <label for="Stok">Jumlah:</label>
                                                            <input type="number" name="Stok" value="0" min="1" max="<?php echo $produk->Stok; ?>">
                                                            <button type="submit" class="btn btn-outline-warning">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keranjang table moved below Daftar Produk button and modal -->
			<div class="row">
    <div class="col-md-11 mx-auto">
        <table id="keranjangTable" class="table table-bordered table-striped mx-auto">
            <thead  style="background-color: #5E7053;" class="text-white">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalBelanja = 0;

                foreach ($DataPenjualan as $penjualan) {
                    $ProdukID = $penjualan->ProdukID;

                    $NamaProduk = '';
                    $Harga = 0;
                    $Quantity = 0; // Tambahkan baris ini

                    foreach ($DataProduk as $produk) {
                        if ($produk->ProdukID == $ProdukID) {
                            $NamaProduk = $produk->NamaProduk;
                            $Harga = $produk->Harga;
                            break;
                        }
                    }

                    $subtotalPerProduk = $penjualan->quantity * $Harga;

                    echo '<tr>';
                    echo '<td>' . $no . '</td>';
                    echo '<td>' . $NamaProduk . '</td>';
                    echo '<td>' . $penjualan->quantity . '</td>';
                    // Perbaikan format rupiah
                    echo '<td>' . "Rp. " . number_format($Harga, 2, ',', '.') . '</td>';
                    echo '<td>' . "Rp. " . number_format($subtotalPerProduk, 2, ',', '.') . '</td>';
                    echo '</td>';
                    echo '</tr>';

                    $totalBelanja += $subtotalPerProduk;

                    $no++;
                }
                ?>
            </tbody>
            <tfoot>
                <?php if ($no > 1) : // Cek apakah ada produk di keranjang ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Belanja</strong></td>
                        <td><?php echo "Rp. " . number_format($totalBelanja, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPelanggan">
                                Lanjutkan
                            </button>
                        </td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center"><strong>Harap pilih produk terlebih dahulu</strong></td>
                    </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>
</div>
</div>

        <div class="modal fade" id="modalPelanggan" tabindex="-1" role="dialog" aria-labelledby="modalPelangganLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPelangganLabel">Data Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi form pelanggan di sini -->
                        <form action="<?php echo site_url('action/simpan_pelanggan'); ?>" method="post">
                            <label for="PelangganID" class="form-label" hidden>ID Pelanggan</label>
                            <input type="hidden" class="form-control" id="PelangganID" name="PelangganID" placeholder="Masukkan ID Pelanggan">
                            <div class="mb-3">
                                <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" placeholder="Masukkan Nama Pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan Alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" placeholder="Masukkan Nomor Telepon" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete(NamaProduk) {
            Swal.fire({
                title: "Apakah anda yakin ?",
                text: "Anda ingin menghapus data ini ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, data akan di hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil !",
                        text: 'Data berhasil di hapus !',
                        icon: "success",
                        showLoaderOnConfirm: true,
                    }).then((result) => {
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
                            // Redirect to the delete URL with the correct NamaProduk
                            window.location.href = "<?php echo site_url('Action/remove_from_penjualan/')?>/" + NamaProduk;
                        }
                    });
                }
            });
            return false;
        }
    </script>
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
</body>

</html>
