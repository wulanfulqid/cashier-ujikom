<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah kategori</title>
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
    <a class="nav-link" href="<?= base_url('Action/kategori');?>">
        <span>Kategori</span>
    </a>
</nav>
  <div class="card custom-card">
    <div class="card-header">
        <h5>DATA KATEGORI</h5>
        <div><br>
            <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#exampleModal">
                <i class="bi bi-plus-circle"></i> + Tambah
            </button>
        </div>
    
<div class="card">
            <div class="card-body">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="<?php echo site_url('Action/addKategori'); ?>" method="post"
                                    onsubmit="(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                                    <!-- <label for="KategoriID" class="form-label" hidden>ID Kategori</label> -->
                                    <input type="hidden" class="form-control" id="KategoriID" name="KategoriID"
                                        placeholder="Masukkan ID Kategori">
                                    <div class="mb-3">
                                        <label for="NamaKategori" class="form-label">Kategori</label>
                                        <input type="text" class="form-control" id="NamaKategori" name="NamaKategori" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="TanggalKategori" class="form-label">Tanggal Kategori</label>
                                        <input type="date" class="form-control" id="TanggalKategori" name="TanggalKategori" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                                <div id="pesan" class="alert" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- tabel -->
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="exampleDataTable">
                    <thead style="background-color: #5E7053;" class="text-white">
                                <tr>
                                <!-- <th scope="col">ID Kategori</th> -->

                                <th scope="col">NO</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tanggal Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($DataKategori)) {
                                $no = 1;
                                foreach ($DataKategori as $ReadDS) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <!-- <td><?php echo $ReadDS->KategoriID; ?></td> -->
                                        <td><?php echo $ReadDS->NamaKategori; ?></td>
                                        <td><?php echo $ReadDS->TanggalKategori; ?></td>
                                        <td>
                                        <button type="button" class="btn btn-success my-1" data-toggle="modal"
                                            data-target="#exampleModal_<?php echo $ReadDS->KategoriID; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?php echo site_url('Action/deleteKategori/')?>" class="btn btn-warning"
                                        onclick="return confirmDelete('<?php echo $ReadDS->KategoriID; ?>')">
                                            <i class="fas fa-trash-alt"></i> 
                                        </a>
    
                                            <div class="modal fade" id="exampleModal_<?php echo $ReadDS->KategoriID; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="updateForm_<?php echo $ReadDS->KategoriID; ?>" 
                                                            onsubmit="(); (this, 'Data berhasil di edit !');"
                                                                action="<?php echo site_url('Action/updateKategori'); ?>"
                                                                method="post">
                                                                <!-- <label for="KategoriID" class="form-label" hidden>ID Kategori</label> -->
                                                                <input type="hidden" class="form-control" id="KategoriID" name="KategoriID" value="<?php echo $ReadDS->KategoriID; ?>">
                                                                <div class="mb-3">
                                                                    <label for="NamaKategori" class="form-label">Kategori</label>
                                                                    <input type="text" class="form-control" id="NamaKategori" name="NamaKategori" value="<?php echo $ReadDS->NamaKategori; ?>"required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="TanggalKategori" class="form-label">Tanggal Kategori</label>
                                                                    <input type="date" class="form-control" id="TanggalKategori" name="TanggalKategori" value="<?php echo $ReadDS->TanggalKategori; ?>" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
</div>

<!-- judul (card) -->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(KategoriID) {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda ingin menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, data akan dihapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Berhasil !",
                text: 'Data berhasil dihapus!',
                icon: "success",
                showLoaderOnConfirm: true,
            }).then(() => {
                // Redirect to the delete URL with the correct id
                window.location.href = "<?php echo site_url('Action/deleteKategori/')?>/" + KategoriID;
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
            $('kategori').DataTable();
        });
    </script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

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
