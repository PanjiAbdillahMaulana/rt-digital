<?php
session_start();
if ( !isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

require 'function/function.php';
$id_permintaan = $_GET['id'];
$surat_keluar = query("SELECT * FROM surat_keluar WHERE id_permintaan=$id_permintaan");
$id_surat_keluar = $surat_keluar[0]['id'];
$data_user = query("SELECT 
                        surat_keluar.id, warga.NIK, warga.nama, warga.agama, warga.tempat_lahir, warga.tanggal_lahir, warga.golongan_darah, warga.jenis_kelamin, warga.pendidikan, warga.pekerjaan,  warga.status_pernikahan, warga.status_akun, permintaan_surat.alasan, permintaan_surat.jenis_surat, permintaan_surat.nama_surat, permintaan_surat.status, surat_keluar.istansi, surat_keluar.tanggal
                    FROM 
                        surat_keluar
                    INNER JOIN 
                        warga ON surat_keluar.id_warga = warga.id
                    INNER JOIN 
                        permintaan_surat ON surat_keluar.id_permintaan = permintaan_surat.id
                    WHERE surat_keluar.id = $id_surat_keluar
")[0];

// membuat tanggal menjadi format d-m-Y
$tanggal_awal = $data_user["tanggal"];
$tanggal_dmy = date("d-m-Y", strtotime($tanggal_awal));

// membuat waktu terkini
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = date('d-m-Y');


require 'vendor/autoload.php'; // Sesuaikan dengan lokasi dompdf di proyek Anda

use Dompdf\Options;
use Dompdf\Dompdf;

// Konfigurasi dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

// Inisialisasi dompdf
$dompdf = new Dompdf($options);


// Load halaman HTML
$html = '<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKTM</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .kopsurat {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding: 10px 0;
        }

        .nomor-surat {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .alamat-rt {
            font-size: 16px;
        }

        .ket-surat{
            text-align: center;
            margin-bottom: 20px;
        }

        .ket-surat h4{
            text-decoration: underline;
        }

        .isi-surat{
            padding: 20px 50px 20px 50px;
            font-size: 18px;
        }
        .pembukaan-surat p{
            text-align: justify;
        }

        .pembukaan-surat p:first-of-type {
            text-indent: 2em;
        }

        .data-penduduk-surat{
            padding: 20px 0px 20px 40px;
        }

        .data-penduduk-surat p{
            line-height: 4;
        }

        .titik{
            padding-left: 8em;
        }
        
        .keterangan-data{
            width: 12em;
        }
        .penutup-surat{
            text-align: justify;
        }

        .penutup-surat .penutup{
            padding-top: 20px;
        }

        .penutup-surat p {
            text-indent: 2em;
        }
        
        .tanda-tangan-surat{
            margin-top: 100px;
            padding-left: 520px;
        }
    </style>
</head>
<body>
    <div class="kopsurat">
        <div class="nomor-surat">
            PEMERINTAH KOTA JAMBI <br>
            KECAMATAN JELUTUNG <br>
            KELURAHAN KEBUN HANDIL <br>
        </div>
        <div class="alamat-rt">
            Jalan BANGKA No.1 , RT 01 / RW 01
            Telp. 0812-3456-7890 
        </div>
    </div>

    <div class="ket-surat">
        <h4>SURAT KETERANGAN DOMISILI</h4>
        <p>Nomor :'.$data_user["jenis_surat"].'.'.$data_user["id"].'/'.$data_user["istansi"].'/'.$tanggal_dmy.'</p>
    </div>
    
    <div class="isi-surat">
        <div class="pembukaan-surat">
            <p>
                Yang bertanda tangan di bawah ini Ketua RT 01 Kelurahan Kebun Handil Kecamatan Jelutung Kota Jambi dengan ini menerangkan dengan sebenarnya bahwa :
            </p>
        </div>
        
        <div class="data-penduduk-surat">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="keterangan-data">Nama</td>
                        <td>: '.$data_user["nama"].' </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Tempat, Tanggal Lahir</td>
                        <td>: '.$data_user["tempat_lahir"].' / '.$data_user["tanggal_lahir"].'</td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Jenis Kelamin</td>
                        <td>: '.$data_user["jenis_kelamin"].' </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Keewarganegaraan</td>
                        <td>: Indonesia</td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Agama</td>
                        <td>: '.$data_user["agama"].'</td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Pekerjaan</td>
                        <td>: '.$data_user["pekerjaan"].' </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="penutup-surat">
            <p>
                Orang yang di atas benar-benar penduduk kami dan Berdomisili di Jalan Bangka No.1 , RT 01 / RW 01 Kelurahan Kebun Handil
                Kecamatan Jelutung Kota Jambi.
            </p>
            <p class="penutup">
                Demikian Surat Keterangan ini kami buat dengan sebenarnya, dan dapat dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="tanda-tangan-surat">
            <div class="tanda-tangan">
                <p>Kelurahan Kebun Handil, '.$tanggal_dmy.' </p>
                <p>Ketua RT.01</p>
                <img src="/assets/img/ttd.png" alt="">
                <p>Ilham NurTaza</p>
                <p>0812-3456-7890</p>
            </div>
        </div>
    </div>

</body>
</html>'; 

// Ubah HTML menjadi PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait'); // Sesuaikan ukuran kertas dan orientasi

// Render PDF (untuk menyimpan atau menampilkan)
$dompdf->render();
$dompdf->stream('Surat.php', array("Attachment"=>0)); // Tampilkan PDF di browser

?>

