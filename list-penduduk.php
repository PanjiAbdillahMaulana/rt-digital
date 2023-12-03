<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

require 'function/function.php';
$datas = query("SELECT * FROM `warga` WHERE status_akun = 'aktif' AND is_admin = 0");

// Mengambil data jumlah penduduk
$jumlah_penduduk = query("SELECT COUNT(*) FROM warga WHERE status_akun = 'aktif'");
$data_jumlah_penduduk = $jumlah_penduduk[0]["COUNT(*)"];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RT.01/RW.01 | Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sb-admin-2.css">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style=" background-color: #2c3e50;">
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <li class="nav-item ">
                <a class="nav-link" href="aktivasi-admin.php">
                    <i class="bi bi-person-circle"></i>
                    <span>Permintaan Aktivasi</span>
                </a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="permintaan-SKTM.php">
                    <i class="bi bi-book"></i>
                    <span>Permintaan Surat</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="list-penduduk.php">
                    <i class="bi bi-people"></i>
                    <span>Penduduk</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="function/logout.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                                <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-bars"></i></button>
                    </div>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h1 mb-0 text-gray-800">Daftar Penduduk dengan Akun Aktif</h1>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <p class="h5 mb-0 text-gray-800">Total Penduduk di RT.01/RW.01 : <span class="font-weight-bold"><?= $data_jumlah_penduduk ?> Orang</span></p>
                    </div>

                        <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold" style="color: #019147;">Data Penduduk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Tempat/tanggal lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1;
                                        foreach($datas as $data) : ?>
                                            <tr>
                                                <td><?= $counter++; ?></td>
                                                <td><?= $data["NIK"] ?></td>
                                                <td><?= $data["nama"] ?></td>
                                                <td><?= $data["jenis_kelamin"] ?></td>                                               
                                                <td><?= $data["agama"] ?></td>
                                                <td><?= $data["tempat_lahir"]?> / <?= $data["tanggal_lahir"] ?></td>
                                                <td>
                                                    <a href="update-akun.php?id=<?= $data["id"]; ?>">Edit</a>
                                                     ||   
                                                    <a href="#" onclick="konfirmasiHapus(<?= $data['id'] ?>)">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                    <!-- DataTales Example -->
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; rt-digital 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "keluar" untuk keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-warning" href="function/logout.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Modal-->
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin menghapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Hapus" untuk menghapus Akun</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="tidak-konfirmasi-akun.php?id=<?= $data["id"]; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Hapus konfirm -->
    <script>
        function konfirmasiHapus(id) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus akun?");

            if (konfirmasi) {
            window.location.href = "tidak-konfirmasi-akun.php?id=" + id;
            } else {
            // Pengguna membatalkan hapus akun
            // Anda dapat menambahkan tindakan lain atau biarkan kosong jika tidak ada tindakan tambahan
            }
        }
    </script>
</body>

</html>