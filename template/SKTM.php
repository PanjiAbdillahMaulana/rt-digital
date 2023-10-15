<!DOCTYPE html>
<html lang="en">
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

        .ttd{
            width: 150px
        }
    </style>
</head>
<body>
    <div class="kopsurat">
        <div class="nomor-surat">
            PEMERINTAH KABUPATEN ODNI <br>
            KECAMATAN KONOHA <br>
            DESA API <br>
        </div>
        <div class="alamat-rt">
            Jalan Ninjaku No.1 , RT 01 / RW 01
            Telp. 0812-3456-7890 
        </div>
    </div>

    <div class="ket-surat">
        <h4>SURAT KETERANGAN TIDAK MAMPU</h4>
        <p>Nomor :......../......../......../................</p>
    </div>
    
    <div class="isi-surat">
        <div class="pembukaan-surat">
            <p>
                Yang bertanda tangan di bawah ini Ketua RT 01 Desa Api Kecamatan Konoha Kabupaten Odni dengan ini menerangkan dengan sebenarnya bahwa :
            </p>
        </div>
        
        <div class="data-penduduk-surat">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="keterangan-data">Nama</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Tempat, Tanggal Lahir</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Jenis Kelamin</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Keewarganegaraan</td>
                        <td>: Indonesia</td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Agama</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Pekerjaan</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td class="keterangan-data">Alamat</td>
                        <td>: </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="penutup-surat">
            <p>
                Orang yang di atas benar-benar penduduk kami dan tergolong dari keluarga kurang mampu.
            </p>
            <p class="penutup">
                Demikian Surat Keterangan ini kami buat dengan sebenarnya, dan dapat dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="tanda-tangan-surat">
            <div class="tanda-tangan">
                <p>Desa Api, <?php echo $now; ?> </p>
                <p>Ketua RT.01</p>
                <img src="../assets/img/ttd.png" alt="" class="ttd">
                <p>Ilham NurTaza</p>
                <p>0812-3456-7890</p>
            </div>
        </div>
    </div>

</body>
</html>
