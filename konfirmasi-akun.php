<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require 'function/function.php';
$data = $_GET["id"];

if ( aktivasi($data) > 0){
    echo "
            <script>
            alert('Akun berhasil di aktivasi, Penduduk bertambah 1');
            document.location.href = 'aktivasi-admin.php';
            </script>
        ";
}else{
    echo "
            <script>
            alert('akun gagal di aktivasi, coba lagi');
            document.location.href = 'aktivasi-admin.php';
            </script>
        ";
}
?>