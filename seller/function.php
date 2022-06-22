<?php 

$conn = mysqli_connect("localhost", "root", "", "db_tokosidia");

$barang_toko = 'barang_toko';
$tabel_barang = 'barang';
$tabel_toko = 'toko';
$tabel_user = 'user';

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;
	global $tabel_barang;

	if (empty($data['nama_barang']) || empty($data['jumlah']) || empty($data['harga'])) {
		echo setAlert('Data harus diisi semua!', 'tambah.php');
		exit;
	}
	
	$nama = htmlspecialchars($data["nama_barang"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	$harga = htmlspecialchars($data["harga"]);

	$query = "INSERT INTO ". $tabel_barang ." VALUES (NULL, '$nama', $jumlah, $harga)";

	if (mysqli_query($conn, $query)) {
		$id_barang = mysqli_insert_id($conn);
		$id_toko = getTokoId($_SESSION['id_user']);

		linkBarangTokoID($id_barang, $id_toko);
		return mysqli_affected_rows($conn);

	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
	}
}


function hapus($id){
	global $conn;
	global $tabel_barang;

	$query = "DELETE FROM ". $tabel_barang ." WHERE id = $id";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubah($data){
	global $conn;
	global $tabel_barang;

	$id = $data['id_barang'];
	$nama = htmlspecialchars($data["nama_barang"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	$harga = htmlspecialchars($data["harga"]);

	if (empty($nama) || empty($jumlah) || empty($harga)) {
		echo setAlert('Data harus diisi semua!', 'edit.php?id='.$id);
		exit;
	}

	$query = "UPDATE ". $tabel_barang ." SET
				nama = '$nama',
				jumlah = $jumlah,
				harga = $harga
				WHERE id=$id";

	mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function register($data) {
	global $conn;
	global $tabel_user;
	
	$nama_toko = $data["nama_toko"];
	$username = htmlspecialchars($data["username"]);
	$password = password_hash($data['password'], PASSWORD_DEFAULT);

	if (empty($username) || empty($password) || empty($nama_toko) || empty($data['deskripsi'])) {
		echo setAlert('Data tidak boleh kosong!', 'register.php');
		exit;
	}

	if (isMatch($username) > 0) {
		echo setAlert('Username sudah diambil! Gunakan Username lain.', 'register.php');
		exit;
	}

	if (isTokoMatch($nama_toko) > 0) {
		echo setAlert('Nama Toko sudah ada!', 'register.php');
		exit;
	}

	$query = "INSERT INTO ". $tabel_user ." (username, password, role) VALUES ('$username', '$password', 'seller')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function registerToko($data) {
	global $conn;
	global $tabel_toko;
	
	$nama_toko = htmlspecialchars($data["nama_toko"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);

	$id_user = getUserId($data["username"]);

	$query = "INSERT INTO ". $tabel_toko ." (id_user, nama_toko, deskripsi) VALUES ($id_user, '$nama_toko', '$deskripsi')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function isMatch($username) {
	global $conn;
	global $tabel_user;
	
	$query = "SELECT username FROM ". $tabel_user ." WHERE username = '$username'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function isTokoMatch($nama_toko) {
	global $conn;
	global $tabel_toko;
	
	$query = "SELECT nama_toko FROM ". $tabel_toko ." WHERE nama_toko = '$nama_toko'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function getUserId($username) {
	global $conn;
	global $tabel_user;
	
	$query = "SELECT id FROM ". $tabel_user ." WHERE username = '$username'";
	$result = mysqli_query($conn, $query);
	
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row["id"];
	}
}


function getTokoId($id_user) {
	global $conn;
	global $tabel_toko;
	
	$query = "SELECT id FROM ". $tabel_toko ." WHERE id_user = $id_user";
	$result = mysqli_query($conn, $query);
	
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row["id"];
	}
}

function getToko($id_user) {
	global $conn;
	global $tabel_toko;
	
	$query = "SELECT * FROM ". $tabel_toko ." WHERE id_user = $id_user";
	$result = mysqli_query($conn, $query);
	
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
}


function linkBarangTokoID($barangID, $tokoID) {
	global $conn;
	global $barang_toko;
	
	$query = "INSERT INTO ". $barang_toko ." VALUES ($barangID, $tokoID)";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
}