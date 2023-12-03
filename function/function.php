<?php 

// $conn = mysqli_connect("localhost", "root","","rt_digital");
$user = getenv('CLOUDSQL_USER');
$pass = getenv('CLOUDSQL_PASSWORD');
$inst = getenv('CLOUDSQL_DSN');
$db = getenv('CLOUDSQL_DB');
$conn = mysqli_connect(null, $user, $pass, $db, null, $inst);


function query($query){
	global $conn;
	$resault = mysqli_query($conn,$query);
	$rows = [];
	while($row = mysqli_fetch_assoc($resault)){
		$rows[] = $row;
	}
	return $rows;
}

function registrasi($data){
	global $conn;
    $NIK = mysqli_real_escape_string($conn, $data['NIK']);
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $agama = mysqli_real_escape_string($conn, $data['agama']);
    $tempat_lahir = mysqli_real_escape_string($conn, $data['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $data['tanggal_lahir']);
    $golongan_darah = mysqli_real_escape_string($conn, $data['golongan_darah']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $data['jenis_kelamin']);
    $pendidikan = mysqli_real_escape_string($conn, $data['pendidikan']);
    $pekerjaan = mysqli_real_escape_string($conn, $data['pekerjaan']);
    $status_pernikahan = mysqli_real_escape_string($conn, $data['status_pernikahan']);
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["re_password"]);
	$status = "belum aktif";

	//cek username bisa digunakan
	$result = mysqli_query($conn, "SELECT NIK FROM warga WHERE NIK = '$NIK' ");

	if( mysqli_fetch_assoc($result)){
		echo "<script>
            	alert('nik sudah dipakai!');
        	</script>";
        return false;
	}

	//cek password
	if ($password !== $password2) {
		echo "<script>
            	alert('passord tidak sesuai!');
        	</script>";
        return false;
	}

	//enkirpsi password biar aman
	$password = password_hash($password, PASSWORD_DEFAULT);

	//
	mysqli_query($conn, "INSERT INTO warga (NIK, nama, agama, tempat_lahir, tanggal_lahir, golongan_darah, jenis_kelamin, pendidikan, pekerjaan, status_pernikahan, password, status_akun)
	VALUES ('$NIK', '$nama', '$agama', '$tempat_lahir', '$tanggal_lahir', '$golongan_darah', '$jenis_kelamin', '$pendidikan', '$pekerjaan', '$status_pernikahan', '$password', '$status')");

	return mysqli_affected_rows($conn);
}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM warga WHERE id =$id");
	return mysqli_affected_rows($conn);
}

function aktivasi($id){
	global $conn;
	mysqli_query($conn, "UPDATE warga SET status_akun = 'aktif' WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function keluarkanSurat($id){
	global $conn;
	date_default_timezone_set('Asia/Jakarta');

	mysqli_query($conn, "UPDATE permintaan_surat SET `status` = 'Disetujui' WHERE id = $id");

	// menambahkan data surat keluar
	// mengambil id warga dari tabel permintaan_surat
	$result = mysqli_query($conn, "SELECT id_warga FROM permintaan_surat WHERE id=$id");
	$row = mysqli_fetch_assoc($result);
	$id_warga = $row['id_warga'];
	// istansi 
	$istansi = "Sekr-RT";
	// tanggal
	$tanggal = date('Y-m-d');

	mysqli_query($conn, "INSERT INTO surat_keluar(`id_warga`, `id_permintaan`, `istansi`, `tanggal`)
	VALUES ('$id_warga', '$id', '$istansi', '$tanggal')");

	return mysqli_affected_rows($conn);
}

function tolakPermintaan($id){
	global $conn;
	mysqli_query($conn, "UPDATE permintaan_surat SET `status` = 'Ditolak' WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function permintaanSurat($data){
	global $conn;
	$id_warga = $data["id"];
	$alasan = $data["alasan"];
	$jenis_surat = $data["jenis_surat"];
	$nama_surat = $data["nama_surat"];
	$status = "Menunggu Persetujuan";

	mysqli_query($conn, "INSERT INTO permintaan_surat(`id_warga`, `alasan`, `status`, `jenis_surat`, `nama_surat`)
	VALUES ('$id_warga', '$alasan', '$status', '$jenis_surat', '$nama_surat')");

	return mysqli_affected_rows($conn);
}

function update_akun($data){
	global $conn;
	$id = mysqli_real_escape_string($conn, $data['id']);
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $agama = mysqli_real_escape_string($conn, $data['agama']);
    $tempat_lahir = mysqli_real_escape_string($conn, $data['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $data['tanggal_lahir']);
    $golongan_darah = mysqli_real_escape_string($conn, $data['golongan_darah']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $data['jenis_kelamin']);
    $pendidikan = mysqli_real_escape_string($conn, $data['pendidikan']);
    $pekerjaan = mysqli_real_escape_string($conn, $data['pekerjaan']);
    $status_pernikahan = mysqli_real_escape_string($conn, $data['status_pernikahan']);

	$query = "UPDATE warga 
			SET 
				nama = '$nama',
				agama = '$agama',
				tempat_lahir = '$tempat_lahir',
				tanggal_lahir = '$tanggal_lahir',
				golongan_darah = '$golongan_darah',
				jenis_kelamin = '$jenis_kelamin',
				pendidikan = '$pendidikan',
				pekerjaan = '$pekerjaan',
				status_pernikahan = '$status_pernikahan'
			WHERE id = $id;";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

?>