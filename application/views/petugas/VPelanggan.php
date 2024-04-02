<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
    <link href="your-styles.css" rel="stylesheet"> <!-- If you have an external CSS file, link it here -->
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
    <a class="nav-link" href="<?= base_url('Welcome/pelanggan');?>">
        <span>Pelanggan</span>
    </a>
</nav>
    <div class="card custom-card">
    <div class="card-header">
        <h5>DATA PELANGGAN</h5>
        <div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="<?php echo site_url('Welcome/addDataPelanggan'); ?>" method="post"
                        onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                        <!-- <label for="PelangganID" class="form-label" hidden>ID Pelanggan</label> -->
                        <input type="hidden" class="form-control" id="PelangganID" name="PelangganID"
                            placeholder="Masukkan ID Pelanggan">
                        <div class="mb-3">
                            <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan"
                                placeholder="Masukkan Nama Pelanggan" required>
                        </div>
                        <div class="mb-3">
                            <label for="TanggalPenjualan" class="form-label">Tanggan Pembelian</label>
                            <select class="form-control" id="TanggalPenjualan" name="TanggalPenjualan" required>
                                <option value="default">Pilih Kategori</option>
                                <?php foreach ($DataKategori as $kategori) : ?>
                                    <option value="<?= $kategori->TanggalPenjualan ?>"><?= $kategori->NamaKategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="Alamat" name="Alamat"
                                placeholder="Masukkan Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon"
                                placeholder="Masukkan Nomor Telepon" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="pesan" class="alert" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- tabel -->
	<div class="modal-body">
                            <table class="table table-bordered table-striped mx-auto" id="exampleDataTable">
                                <thead style="background-color: #5E7053;" class="text-white">
                <tr>
                    <th scope="col">No</th>
                    <!-- <th scope="col">ID Pelanggan</th> -->
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($DataPelanggan)) {
                    $no = 1;
                    foreach ($DataPelanggan as $ReadDS) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <!-- <td><?php echo $ReadDS->PelangganID; ?></td> -->
                            <td><?php echo $ReadDS->NamaPelanggan; ?></td>
                            <td><?php echo $ReadDS->Alamat; ?></td>
                            <td><?php echo $ReadDS->NomorTelepon; ?></td>
                            <td>
                                <button type="button" class="btn btn-success my-1" data-toggle="modal"
                                    data-target="#exampleModal_<?php echo $ReadDS->PelangganID; ?>">
                                    <i class="fas fa-edit"></i> 
                                </button>
                                <a href="#" class="btn btn-warning"
                                    onclick="return confirmDelete('<?php echo $ReadDS->PelangganID; ?>')">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>

                                <div class="modal fade" id="exampleModal_<?php echo $ReadDS->PelangganID; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelanggan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="updateForm" action="<?= site_url('Welcome/updatePelanggan/' . $ReadDS->PelangganID) ?>"
                                                    onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di edit !');"
                                                    method="post">
                                                    <input type="hidden" class="form-control" id="PelangganID" name="PelangganID" value="<?= $ReadDS->PelangganID; ?>">
                                                    <!-- Other form inputs -->
                                                    <div class="mb-3">
                                                        <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                                                        <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" placeholder="Masukkan Nama Pelanggan" value="<?= $ReadDS->NamaPelanggan; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Alamat" class="form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan Alamat" value="<?= $ReadDS->Alamat; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                                                        <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" placeholder="Masukkan Nomor Telepon" value="<?= $ReadDS->NomorTelepon; ?>" required>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(PelangganID) {
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
                        window.location.href = "<?php echo site_url('Welcome/deleteDataPelanggan/')?>/" + PelangganID;
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
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
                location.reload();
            }
        });
    }

    function handleFormSubmit(form, msg) {
        var formData = $(form).serialize();

        $.ajax({
            type: "POST",
            url: $(form).attr("action"),
            data: formData,
            success: function(response) {
                succesModal(msg);
            },
            error: function() {
                alert("An error occurred. Please try again later.");
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?= base_url('assets/js/demo/datatables-demo.js')?>"></script>

</body>
</html>
