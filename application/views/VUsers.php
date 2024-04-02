<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
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
    <a class="nav-link" href="<?= base_url('Action/users');?>">
        <span>Users</span>
    </a>
</nav>
<div class="card mb-4 custom-card">
  <div class="card-body"

  <div class="card custom-card">
    <div class="card-header">
       <h5>DATA USER</h5> 
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
                                <h5 class="modal-title" id="exampleModalLabel">Data Detail Penjualan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="<?php echo site_url('Action/addUsers'); ?>" method="post"
                                onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !');">
                                    <label for="id" class="form-label" hidden>ID User</label>
                                    <input type="hidden" class="form-control" id="id" name="id">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
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
                                <th scope="col">NO</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($DataUsers)) {
                                $no = 1;
                                foreach ($DataUsers as $ReadDS) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $ReadDS->username; ?></td>
                                        <td><?php echo $ReadDS->email; ?></td>
                                        <td><?php echo $ReadDS->role; ?></td>
                                        <td>
                                        <button type="button" class="btn btn-success my-1" data-toggle="modal"
                                            data-target="#exampleModal_<?php echo $ReadDS->id; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?php echo site_url('Action/deleteUsers/')?>" class="btn btn-warning"
                                        onclick="return confirmDelete('<?php echo $ReadDS->id; ?>')">
                                            <i class="fas fa-trash-alt"></i> 
                                        </a>
    
                                            <div class="modal fade" id="exampleModal_<?php echo $ReadDS->id; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Users</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="updateForm_<?php echo $ReadDS->id; ?>"
                                                                action="<?php echo site_url('Action/updateUsers'); ?>"
                                                                onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di edit !');"
                                                                method="post">
                                                                <label for="id" class="form-label" hidden>ID User</label>
                                                                <input type="hidden" class="form-control" id="id" name="id"
                                                                    value="<?php echo $ReadDS->id; ?>" required>
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Username</label>
                                                                    <input type="text" class="form-control" id="username"
                                                                        name="username"
                                                                        value="<?= $ReadDS->username; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="text" class="form-control" id="email"
                                                                        name="email" value="<?= $ReadDS->email; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="hidden" class="form-control" id="password"
                                                                        name="password" value="<?= $ReadDS->password; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="role" class="form-label">Role</label>
                                                                    <select class="form-control" id="role" name="role"
                                                                        value="<?= $ReadDS->ProdukID; ?>" required>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="petugas">Petugas</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function confirmDelete(id) {
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
                    // Redirect to the delete URL with the correct id
                    window.location.href = "<?php echo site_url('Action/deleteUsers/')?>/" +
                    id;
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
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

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
