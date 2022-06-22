<?php 

require '../helper/alert-helper.php';
require 'function.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != "seller") {
	echo setAlert('Halaman tidak dapat diakses!', 'index.php');
	exit;
}

$barangid = $_GET["barangid"];
$userid = $_GET["userid"];

if ($userid == $_SESSION['id_user']) {
	if ( hapus($barangid) > 0 ) {
		echo setAlert('Barang berhasil dihapus!', 'index.php');
		exit;
	}

	echo setAlert('Barang gagal dihapus!', 'index.php');
	exit;

}

echo setAlert('Anda tidak memiliki hak akses!', 'index.php');
exit;