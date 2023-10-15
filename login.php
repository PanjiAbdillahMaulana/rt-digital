<?php 
session_start();
if ( isset($_SESSION["id"])) {
    header("Location: dashboard.php");
    exit;
}
require 'function/function.php';

if ( isset($_POST["login"])) {
    $NIK = $_POST["NIK"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM warga WHERE NIK = '$NIK'");
    $sudah_aktif = query("SELECT status_akun FROM warga WHERE NIK = '$NIK'")[0];
    $is_admin = query("SELECT is_admin FROM warga WHERE NIK = '$NIK'")[0];

    //cek NIK
    if ( mysqli_num_rows($result) === 1 ){
      // cek akunnya
      if ($sudah_aktif["status_akun"] == "aktif"){
        //cek passwordnya
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            // set sesion
            $_SESSION["id"] = $row["id"];
            if ($is_admin["is_admin"] == 1){
              header("Location: dashboard-admin.php");
              exit;
            }
            header("Location: dashboard.php");
            exit;
        }
      }echo "<script>
      alert('Akun belum aktif');;
      </script>";
  }
    $eror = true;
    if( $eror = true){
      echo "<script>
          alert('NIK atau Password salah, coba lagi');;
          </script>";
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - RT.01/RW.01</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <a class="btn btn-outline-primary" href="index.php">Kembali ke Home</a>
    <div class="container-sm">
        <h1 class="text-center">Masuk</h1>
        <form action="" method="post">
            <div class="mb-3 px-5">
                <label for="NIK" class="form-label">NIK</label>
                <input type="text" class="form-control" id="NIK" name="NIK" required>
            </div>

            <div class="mb-3 px-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Masuk</button>

            <div class="asking-link">
              <p>Belum terdaftar? <a href="register.php">register sekarang</a></p>
              
            </div>
        </form>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>