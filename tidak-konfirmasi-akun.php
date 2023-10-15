<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require 'function/function.php';
$data = $_GET["id"];

if ( hapus($data) > 0){
    echo "
            <script>
            alert('akun berhasil dihapus');
            document.location.href = 'aktivasi-admin.php';
            </script>
        ";
}else{
    echo "
            <script>
            alert('akun gagal dihapus, coba lagi');
            document.location.href = 'aktivasi-admin.php';
            </script>
        ";
}
?>