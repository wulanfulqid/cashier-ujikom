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

    .filter-form 
    {
        margin-top: 20px; /* Memindahkan form filter ke bawah tombol Export PDF */
        margin-left: 50px; /* Menambahkan margin ke kiri */
        display: flex;
        align-items: center;
    }

    .filter-form label {
        margin-right: 10px;
    }

    .btn-export {
        margin-top: 10px; /* Add margin to the top of the Export PDF button */
    }
    </style>
</head>
<body>

<div class="card mb-4 custom-card">
    <div class="card-header">
        Menu Master
    </div>

    <nav class="navbar bg-body-tertiary justify-content-between">
        <div class="container-fluid">
            <h5 class="card-title">DATA DETAIL PENJUALAN</h5>
        </div>
</nav>


  <div class="card-body">
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="<?php echo site_url('Welcome/addDetailPenjualan'); ?>" method="post"
                    onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                        <label for="DetailID" class="form-label" hidden>ID Penjualan</label>
                        <input type="hidden" class="form-control" id="DetailID" name="DetailID"
                            placeholder="Masukkan ID Detail Penjualan">
							<div class="mb-3">
                                <!-- <label for="PenjualanID" class="form-label">Penjualan</label> -->
                                <select class="form-control" id="PenjualanID" name="PenjualanID" required>
                                    <?php foreach ($DataPenjualan as $penjualan) { ?>
                                        <option value="<?php echo $penjualan->PenjualanID; ?>"><?php echo $penjualan->PenjualanID; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
							<div class="mb-3">
                                <label for="ProdukID" class="form-label">Produk</label>
                                <select class="form-control" id="ProdukID" name="ProdukID" required>
                                    <?php foreach ($DataProduk as $produk) { ?>
                                        <option value="<?php echo $produk->ProdukID; ?>"><?php echo $produk->ProdukID; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <div class="mb-3">
                            <label for="JumlahProduk" class="form-label">Jumlah Produk</label>
                            <input type="text" class="form-control" id="JumlahProduk" name="JumlahProduk"
                                placeholder="Masukkan Jumlah Produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="Subtotal" class="form-label">Subtotal</label>
                            <input type="text" class="form-control" id="Subtotal" name="Subtotal"
                                placeholder="Masukkan Subtotal" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="pesan" class="alert" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead style="background-color: #5E7053;" class="text-white">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Penjualan</th>
                <th scope="col">Nama Produk</th>
                <th hidden scope="col">Detail ID</th>
                <th scope="col">Jumlah Produk</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($DetailPenjualan)) {
                $no = 1;
                foreach ($DetailPenjualan as $ReadDS) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $ReadDS->PenjualanID; ?></td>
                        <td>
                            <?php 
                            $productName = '';
                            foreach ($DataProduk as $produk) {
                                if ($produk->ProdukID == $ReadDS->ProdukID) {
                                    $productName = $produk->NamaProduk;
                                    break;
                                }
                            }
                            echo $productName;
                            ?>
                        </td>
                        <td hidden><?php echo $ReadDS->DetailID; ?></td>
                        <td><?php echo $ReadDS->JumlahProduk; ?></td>
                        <td><?php echo "Rp. " . number_format($ReadDS->Subtotal, 2, ',', '.'); ?></td>
                        <td>
                            <a class="btn btn-danger" href="<?php echo site_url('Action/exportStruk/' . $ReadDS->DetailID); ?>" name="bexport">
                                <i class="fa fa-file"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
    </div>
</div>
</div>

</nav>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>
