<?php 
session_start();
if ( isset($_SESSION["id"])) {
    header("Location: dashboard.php");
    exit;
}
require 'function/function.php';

    if( isset($_POST["register"]) ) {

        if( registrasi($_POST) > 0){
            echo "<script>
                alert('user baru berhasil ditambahkan! silahkan login');window.location.href = 'login.php';
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - RT.01/RW.01</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <a class="btn btn-outline-primary" href="index.php">Kembali ke Home</a>
    <div class="container-sm">
        <h1 class="text-center">Registrasi Penduduk RT.01/RW.01</h1>
        <form action="" method="post">
            <div class="mb-3 px-5">
              <label for="NIK" class="form-label">NIK</label>
              <input type="text" class="form-control" id="NIK" aria-describedby="niklHelp" name="NIK" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
              <div id="niklHelp" class="form-text">We'll never share your NIK with anyone else.</div>
            </div>

            <div class="mb-3 px-5">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3 px-5">
                <label for="agama">Agama</label>
                <select class="form-select" aria-label="Default select example" id="agama" name="agama" required>
                    <option selected>Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>

            <div class="mb-3 mt-4 px-5">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <div class="mb-3 px-5">
                <label for="golongan_darah">Golongan Darah</label>
                <select class="form-select" aria-label="Default select example" id="golongan_darah" name="golongan_darah" required>
                    <option selected>A</option>
                    <option value="AB">AB</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option selected>Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="pendidikan">Pendidikan Teakhir</label>
                <select class="form-select" aria-label="Default select example" id="pendidikan" name="pendidikan" required>
                    <option selected>Tidak Bersekolah</option>
                    <option value="Belum lulus SD">Belum lulus SD</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"  required>
            </div>

            <div class="mb-3 px-5">
                <label for="status_pernikahan">Status Pernikahan</label>
                <select class="form-select" aria-label="Default select example" id="status_pernikahan" name="status_pernikahan" required name="status_pernikahan">
                    <option selected>Belum Menikah</option>
                    <option value="Sudah Menikah">Sudah Menikah</option>
                    <option value="Janda/Duda">Janda/Duda</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 px-5">
                <label for="re_password" class="form-label">Ketik Ulang Password</label>
                <input type="password" class="form-control" id="re_password" name="re_password" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>

            <div class="asking-link">
                <p>Sudah terdaftar? <a href="login.php">Masuk sekarang</a></p>
            </div>
        </form>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>