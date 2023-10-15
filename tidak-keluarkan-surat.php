<?php 
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require 'function/function.php';
$data = $_GET["id"];

if ( tolakPermintaan($data) > 0){
    echo "
            <script>
            alert('Surat telah ditolak');
            document.location.href = 'permintaan-SKTM.php';
            </script>
        ";
}else{
    echo "
            <script>
            alert('surat gagal di ditolak, coba lagi');
            document.location.href = 'permintaan-SKTM.php';
            </script>
        ";
}
?>