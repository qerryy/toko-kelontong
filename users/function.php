<?php 

$conn = mysqli_connect("localhost", "root", "", "db_tokosidia");

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


function hapus($id){
	global $conn;
	global $tabel;

	$query = "DELETE FROM $tabel WHERE id = $id";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function updateUser($data){
	global $conn;
	global $tabel_user;

	$id = $data["id_user"];
	$username = htmlspecialchars($data["username"]);
	$password = password_hash($data["password"], PASSWORD_DEFAULT);

	if (empty($username)) {
		echo setAlert('Username tidak boleh kosong.', 'setting.php?id='.$id);
		exit;
	}

	if (empty($data["password"])) {
		$query = "UPDATE $tabel_user SET username='$username' WHERE id=$id";
		mysqli_query($conn, $query) or die(mysqli_error($conn));

		return mysqli_affected_rows($conn);
	}

	$query = "UPDATE $tabel_user SET username = '$username', password = $password WHERE id=$id";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function updateToko($data) {
	global $conn;
	global $tabel_toko;

	$id = $data['id_user'];
	$nama_toko = htmlspecialchars($data["nama_toko"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);

	if (empty($nama_toko) && empty($deskripsi)) {
		echo setAlert('Akun berhasil diubah!', "setting.php?id=$id");
		exit;
	}

	if (!empty($nama_toko) && empty($deskripsi)) {
		$query = "UPDATE $tabel_toko SET nama_toko = '$nama_toko' WHERE id_user=$id";

		mysqli_query($conn, $query) or die(mysqli_error($conn));

		echo setAlert('Akun berhasil diubah!', "setting.php?id=$id");
		exit;
	}

	if (empty($nama_toko) && !empty($deskripsi)) {
		$query = "UPDATE $tabel_toko SET deskripsi = '$deskripsi' WHERE id_user=$id";

		mysqli_query($conn, $query) or die(mysqli_error($conn));

		echo setAlert('Akun berhasil diubah!', "setting.php?id=$id");
		exit;
	}

	$query = "UPDATE $tabel_toko SET nama_toko = '$nama_toko', deskripsi = '$deskripsi' WHERE id_user=$id";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	echo setAlert('Akun berhasil diubah!', "setting.php?id=$id");
	exit;
}


function login($data){
	global $conn;
	global $tabel_user;

	$username = $data["username"];
	$password = $data['password'];

	if (empty($username) || empty($password)) {
		echo setAlert('Data tidak boleh kosong.', 'login.php');
		exit;
	}

	$query = "SELECT * FROM $tabel_user WHERE username = '$username'";
	$result = mysqli_query($conn, $query);
	
	if (!mysqli_num_rows($result) > 0) {
		echo setAlert('Gagal Login!', 'login.php');
		exit;
	}

	$row = mysqli_fetch_assoc($result);
	if (!password_verify($password, $row["password"])) {
		echo setAlert('Username atau Password Salah!', 'login.php');
		exit;
	}
	
	createSession($row);
	if ($row["role"] == "seller") {
		echo setAlert('Berhasil Login', '../seller/index.php');
		exit;
	}

	if ($row["role"] == "admin") {
		echo setAlert('Berhasil Login', '../admin/index.php');
		exit;
	}

	echo setAlert('Berhasil Login', 'index.php');
	exit;
}

function createSession($user){
	$_SESSION['id_user'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['role'] = $user['role'];
}


function register($data) {
	global $conn;
	global $tabel_user;
	
	$username = htmlspecialchars($data["username"]);
	$password = password_hash($data["password"], PASSWORD_DEFAULT);

	if (empty($username) || empty($password)) {
		echo setAlert('Data harus diisi semua!', 'register.php');
		exit;
	}

	if (isMatch($username) > 0) {
		echo setAlert('Username sudah diambil! Gunakan Username lain.', 'register.php');
		exit;
	}

	$query = "INSERT INTO $tabel_user (username, password) VALUES ('$username', '$password')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function isMatch($username) {
	global $conn;
	global $tabel_user;
	
	$query = "SELECT username FROM $tabel_user WHERE username = '$username'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function getUserById($id) {
	global $conn;
	global $tabel_user;
	
	$query = "SELECT * FROM $tabel_user WHERE id = $id";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_fetch_assoc($result);
}

function getTokoById($id) {
	global $conn;
	global $tabel_toko;
	global $tabel_user;

	$query = "SELECT * FROM $tabel_toko JOIN $tabel_user ON toko.id_user=user.id WHERE toko.id=$id";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_fetch_assoc($result);
}