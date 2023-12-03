<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

require 'function/function.php';
$data_id = $_GET["id"];
$akun = query("SELECT * FROM warga WHERE id=$data_id")[0];

    if( isset($_POST["update_akun"]) ) {

        if( update_akun($_POST) > 0){
            echo "<script>
                alert('Data akun berhasil di perbaharui!');window.location.href = 'list-penduduk.php'
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
    <a class="btn btn-outline-primary" href="list-penduduk.php">Kembali ke Dashboard Admin</a>
    <div class="container-sm">
        <h1 class="text-center">Update Penduduk RT.01/RW.01</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data_id;?>">
            <div class="mb-3 px-5">
              <label for="NIK" class="form-label">NIK</label>
              <input type="text" class="form-control" id="NIK" aria-describedby="niklHelp" name="NIK" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= $akun["NIK"]; ?>" disabled>
              <div id="niklHelp" class="form-text">We'll never share your NIK with anyone else.</div>
            </div>

            <div class="mb-3 px-5">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?= $akun["nama"]; ?>">
            </div>

            <div class="mb-3 px-5">
                <label for="agama">Agama</label>
                <select class="form-select" aria-label="Default select example" id="agama" name="agama" required>
                    <option value="Islam" <?= ($akun["agama"] == "Islam") ? "selected" : "" ?>>Islam</option>
                    <option value="Kristen" <?= ($akun["agama"] == "Kristen") ? "selected" : "" ?>>Kristen</option>
                    <option value="Katolik" <?= ($akun["agama"] == "Katolik") ? "selected" : "" ?>>Katolik</option>
                    <option value="Hindu" <?= ($akun["agama"] == "Hindu") ? "selected" : "" ?>>Hindu</option>
                    <option value="Buddha" <?= ($akun["agama"] == "Buddha") ? "selected" : "" ?>>Buddha</option>
                    <option value="Konghucu" <?= ($akun["agama"] == "Konghucu") ? "selected" : "" ?>>Konghucu</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="<?= $akun["tempat_lahir"]; ?>">
            </div>

            <div class="mb-3 mt-4 px-5">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="<?= $akun["tanggal_lahir"]; ?>">
            </div>

            <div class="mb-3 px-5">
                <label for="golongan_darah">Golongan Darah</label>
                <select class="form-select" aria-label="Default select example" id="golongan_darah" name="golongan_darah" required >
                    <option value="A" <?= ($akun["golongan_darah"] == "A") ? "selected" : "" ?>>A</option>
                    <option value="AB" <?= ($akun["golongan_darah"] == "AB") ? "selected" : "" ?>>AB</option>
                    <option value="B" <?= ($akun["golongan_darah"] == "B") ? "selected" : "" ?>>B</option>
                    <option value="O" <?= ($akun["golongan_darah"] == "O") ? "selected" : "" ?>>O</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-select" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-Laki" <?= ($akun["jenis_kelamin"] == "Laki-Laki") ? "selected" : "" ?>>Laki-Laki</option>
                    <option value="Perempuan" <?= ($akun["jenis_kelamin"] == "Perempuan") ? "selected" : "" ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="pendidikan">Pendidikan Teakhir</label>
                <select class="form-select" aria-label="Default select example" id="pendidikan" name="pendidikan" required>
                    <option value="Tidak Bersekolah" <?= ($akun["pendidikan"] == "Tidak Bersekolah") ? "selected" : "" ?>>Tidak Bersekolah</option>
                    <option value="Belum lulus SD" <?= ($akun["pendidikan"] == "Belum lulus SD") ? "selected" : "" ?>>Belum lulus SD</option>
                    <option value="SD" <?= ($akun["pendidikan"] == "SD") ? "selected" : "" ?>>SD</option>
                    <option value="SMP" <?= ($akun["pendidikan"] == "SMP") ? "selected" : "" ?>>SMP</option>
                    <option value="SMA" <?= ($akun["pendidikan"] == "SMA") ? "selected" : "" ?>>SMA</option>
                    <option value="S1" <?= ($akun["pendidikan"] == "S1") ? "selected" : "" ?>>S1</option>
                    <option value="S2" <?= ($akun["pendidikan"] == "S2") ? "selected" : "" ?>>S2</option>
                    <option value="S3" <?= ($akun["pendidikan"] == "S3") ? "selected" : "" ?>>S3</option>
                </select>
            </div>

            <div class="mb-3 px-5">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"  required value="<?= $akun["pekerjaan"]; ?>">
            </div>

            <div class="mb-3 px-5">
                <label for="status_pernikahan">Status Pernikahan</label>
                <select class="form-select" aria-label="Default select example" id="status_pernikahan" name="status_pernikahan" required >
                    <option value="Belum Menikah" <?= ($akun["status_pernikahan"] == "Belum Menikah") ? "selected" : "" ?>>Belum Menikah</option>
                    <option value="Sudah Menikah" <?= ($akun["status_pernikahan"] == "Sudah Menikah") ? "selected" : "" ?>>Sudah Menikah</option>
                    <option value="Janda/Duda" <?= ($akun["status_pernikahan"] == "Janda/Duda") ? "selected" : "" ?>>Janda/Duda</option>
                </select>
            </div>
            <button type="submit" name="update_akun" class="btn btn-primary">Update</button>
        </form>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>