<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... (nilai hash)" crossorigin="anonymous" />
    <title>Document</title>
    <style>
    
    .custom-card {
        margin: 20px;
        margin-bottom: 70px;
    }

    .custom-table {
        margin-top: 20px;
        padding: 20px; /* Tambahkan padding agar tidak menempel ke sisi kiri kanan card */
    }

    .custom-table table {
        width: 100%; /* Set width 100% agar tabel memenuhi lebar custom-table */
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
    <a class="nav-link" href="<?= base_url('Welcome/produk');?>">
        <span>Produk</span>
    </a>
</nav>

<div class="card custom-card">
    <div class="card-header">
        <h5>FORM DATA BARANG</h5>
        <div><br>
            <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="bi bi-plus-circle"></i> + Tambah
            </button>
        </div>
<div class="card">
    <div class="container-fluid mt-4 custom-table">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="<?php echo site_url('Welcome/addDataProduk'); ?>" method="post"
                        onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                        <!-- <label for="ProdukID" class="form-label" hidden>ID Produk</label> -->
                        <input type="hidden" class="form-control" id="ProdukID" name="ProdukID"
                            placeholder="Masukkan ID Produk">
                        <div class="mb-3">
                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                                placeholder="Masukkan Nama Produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="KategoriID" class="form-label">Pilih Kategori</label>
                            <select class="form-control" id="KategoriID" name="KategoriID" required>
                                <option value="default">Pilih Kategori</option>
                                <?php foreach ($DataKategori as $kategori) : ?>
                                    <option value="<?= $kategori->KategoriID ?>"><?= $kategori->NamaKategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="Harga" name="Harga"
                                placeholder="Masukkan Harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="Stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="Stok" name="Stok"
                                placeholder="Masukkan Stok" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="pesan" class="alert" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>


<!-- tabel -->
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="exampleDataTable">
        <thead style="background-color: #5E7053;" class="text-white">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($DataProduk)) {
                $no = 1;
                foreach ($DataProduk as $ReadDS) {
                    $KategoriID = $ReadDS->KategoriID;
                    $NamaKategori = '';

                    foreach ($DataKategori as $kategoriOption) {
                        if ($kategoriOption->KategoriID == $KategoriID) {
                            $NamaKategori = $kategoriOption->NamaKategori;
                            break;
                        }
                    }

                    // Check if stock is zero and apply red background
                    $rowColor = ($ReadDS->Stok == 0) ? 'style="background-color: #ffcccc;"' : '';
                    ?>

                    <tr <?= $rowColor ?>>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $ReadDS->NamaProduk; ?></td>
                        <td><?php echo $NamaKategori; ?></td>
                        <!-- Menggunakan number_format untuk format rupiah -->
                        <td><?php echo "Rp. " . number_format($ReadDS->Harga, 2, ',', '.'); ?></td>
                        <td><?php echo $ReadDS->Stok; ?></td>
                        <td>
                            <button type="button" class="btn btn-success my-1" data-toggle="modal"
                                data-target="#exampleModal_<?php echo $ReadDS->ProdukID; ?>">
                                <i class="fas fa-edit"></i>
                            </button>

                            <a href="<?php echo site_url('Welcome/deleteDataProduk/') ?>" class="btn btn-warning"
                                onclick="return confirmDelete('<?php echo $ReadDS->ProdukID; ?>')">
                                <i class="fas fa-trash-alt"></i>
                            </a>


                        <div class="modal fade" id="exampleModal_<?php echo $ReadDS->ProdukID; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!-- Konten modal -->
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= site_url('Welcome/updateDataProduk')?>"
                                            onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di edit !');"
                                            method="post">
                                            <!-- <label for="ProdukID" class="form-label" hidden>ID Produk</label> -->
                                            <input type="hidden" class="form-control" id="ProdukID" name="ProdukID" value="<?= $ReadDS->ProdukID; ?>">
                                            <div class="mb-3">
                                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                                            placeholder="Masukkan Nama Produk" value="<?= $ReadDS->NamaProduk; ?>"required>
                                            </div>
                                            <label for="KategoriID" class="form-label">Pilih Kategori</label>
                                            <select class="form-control" id="KategoriID" name="KategoriID" required>
                                                <option value="default">Pilih Kategori</option>
                                                <?php foreach ($DataKategori as $kategori) : ?>
                                                    <?php $selected = ($kategori->KategoriID == $ReadDS->KategoriID) ? 'selected' : ''; ?>
                                                    <option value="<?= $kategori->KategoriID ?>" <?= $selected ?>><?= $kategori->NamaKategori ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="mb-3">
                                            <label for="Harga" class="form-label">Harga</label>
                                            <input type="text" class="form-control" id="Harga" name="Harga"
                                            placeholder="Masukkan Harga" value="<?= $ReadDS->Harga; ?>"required>
                                            </div>
                                            <div class="mb-3">
                                            <label for="Stok" class="form-label">Stok</label>
                                            <input type="text" class="form-control" id="Stok" name="Stok"
                                            placeholder="Masukkan Stok" value="<?= $ReadDS->Stok; ?>"required>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                        <!-- Akhir formulir -->
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir konten modal -->

                        </div>
                        <!-- Akhir Modal Edit -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function confirmDelete(ProdukID) {
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
                    // Redirect to the delete URL with the correct ProdukID
                    window.location.href = "<?php echo site_url('Welcome/deleteDataProduk/')?>/" +
                    ProdukID;
                }
            });
        }
    });
    return false;
}


function succesModal(msg) {
            Swal.fire({
                title: "Berhasil !",
                text: msg,
                icon: "success",
                showLoaderOnConfirm: true,
            }).then((result) => {
                // Reload the page after the Swal modal is closed
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
                    location.reload();
                }
            });
        }
    
        $(document).ready(function () {
            $('#detailPenjualanTable').DataTable();
        });

function handleFormSubmit(form, msg) {
    var formData = $(form).serialize();
    console.log(formData);

    $.ajax({
        type: "POST",
        url: $(form).attr("action"),
        data: formData,
        success: function(response) {
            console.log(response);
            // Assuming your server returns a JSON object with a "success" property
            // if (response.success) {
            succesModal(msg);
            // } else {
            //     // Handle the case when the form submission is not successful
            //     // You can display an error message or take other actions
            //     alert("Form submission failed. Please try again.");
            // }
        },
        error: function() {
            // Handle the case when the AJAX request fails
            alert("An error occurred. Please try again later.");
        }
    });

    // Return false to prevent the default form submission
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
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>


</body>
</html>


