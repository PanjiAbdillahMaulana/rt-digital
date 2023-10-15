<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

require 'function/function.php';
$user_id = $_SESSION["id"];
$data_user = query("SELECT * FROM warga WHERE id=$user_id")[0];

if( isset($_POST["permintaan"]) ) {

    if( permintaanSurat($_POST) > 0){
        echo "<script>
            alert('Permintaan terkirim, menunggu respon admin');window.location.href = 'cetak-SKTM.php';
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RT.01/RW.01 | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style=" background-color: #1abc9c;">
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="cetak-SKTM.php">
                    <i class="bi bi-book"></i>
                    <span>Cetak SKTM</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="cetak-surat-domisili.php">
                    <i class="bi bi-pass-fill"></i>
                    <span>Cetak Surat Domisili</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="riwayat-surat.php">
                    <i class="bi bi-pass-fill"></i>
                    <span>Riwayat Surat</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pengaturan.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
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
                        <h1 class="h1 mb-0 text-gray-800">Cetak <span style="color: #019147;">SKTM</span></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row d-flex justify-content-center">
                    <div class="container-sm">
                            <h1 class="text-center">Data</h1>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $_SESSION["id"];?>">
                                <input type="hidden" name="jenis_surat" value="09">
                                <!-- 09 adalah surat keterangan di penomoran surat resmi -->
                                <input type="hidden" name="nama_surat" value="SKTM">
                                <div class="mb-3 px-5">
                                    <label for="NIK" class="form-label">NIK</label>
                                    <input type="text" class="form-control disabled" id="NIK" value="<?= $data_user["NIK"]; ?>" disabled aria-describedby="niklHelp" name="NIK" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <div id="niklHelp" class="form-text">We'll never share your NIK with anyone else.</div>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control disabled" disabled value="<?= $data_user["nama"]; ?>" id="nama" name="nama" required>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="agama">Agama</label>
                                    <select class="form-select" disabled aria-label="Disabled select example" id="agama" name="agama" required>
                                        <option selected><?= $data_user["agama"]; ?></option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control disabled" disabled value="<?= $data_user["tempat_lahir"]; ?>" id="tempat_lahir" name="tempat_lahir" required>
                                </div>

                                <div class="mb-3 mt-4 px-5">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" disabled value="<?= $data_user["tanggal_lahir"]; ?>" name="tanggal_lahir" required>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="golongan_darah">Golongan Darah</label>
                                    <select class="form-select disabled" disabled aria-label="disabled select example" id="golongan_darah" name="golongan_darah" required>
                                        <option selected><?= $data_user["golongan_darah"]; ?></option>
                                        <option value="Kristen">AB</option>
                                        <option value="Kristen">B</option>
                                        <option value="Kristen">O</option>
                                    </select>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select disabled" disabled aria-label="disabled select example" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option selected><?= $data_user["jenis_kelamin"]; ?></option>
                                        <option value="Kristen">Perempuan</option>
                                    </select>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="pendidikan">Pendidikan</label>
                                    <select class="form-select disabled" disabled aria-label="disabled select example" id="pendidikan" name="pendidikan" required>
                                        <option selected><?= $data_user["pendidikan"]; ?></option>
                                        <option value="Kristen">Belum lulus SD</option>
                                        <option value="Kristen">SD</option>
                                        <option value="Kristen">SMP</option>
                                        <option value="Kristen">SMA</option>
                                        <option value="Kristen">S1</option>
                                        <option value="Kristen">S2</option>
                                        <option value="Kristen">S3</option>
                                    </select>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control disabled" id="pekerjaan" name="pekerjaan" disabled value="<?= $data_user["pekerjaan"]; ?>" required>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="status_pernikahan">Status Pernikahan</label>
                                    <select class="form-select disabled" disabled aria-label="disabled select example" id="status_pernikahan" name="status_pernikahan" required>
                                        <option selected><?= $data_user["status_pernikahan"]; ?></option>
                                        <option value="Kristen">Sudah Menikah</option>
                                        <option value="Kristen">Janda/Duda</option>
                                    </select>
                                </div>

                                <div class="mb-3 px-5">
                                    <label for="alasan">Alasan Membutuhkan Surat Domisili:</label>
                                    <textarea class="form-control" id="alasan" name="alasan" rows="5" maxlength="510" required></textarea>
                                </div>

                                <button type="submit" name="permintaan" class="btn btn-primary">Minta SKTM</button>
                            </form>
                        </div>
                    </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>