<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require 'function/function.php';
$data = $_GET["id"];


if ( keluarkanSurat($data) > 0){
    echo "
            <script>
            alert('Surat telah diterbitkan');
            document.location.href = 'permintaan-SKTM.php';
            </script>
        ";
}else{
    echo "
            <script>
            alert('surat gagal di terbitkan, coba lagi');
            document.location.href = 'permintaan-SKTM.php';
            </script>
        ";
}
?>