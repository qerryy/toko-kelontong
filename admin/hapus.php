<?php 

require '../helper/alert-helper.php';
require 'function.php';

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
	echo setAlert('Halaman tidak dapat diakses!', 'index.php');
	exit;
}


if ($_GET['idtoko']) {
  $id = $_GET["idtoko"];

  $toko = mysqli_query($conn, "SELECT id_user FROM toko WHERE id=$id");
	$toko = mysqli_fetch_assoc($toko);

  if ( hapus($toko['id_user']) > 0 ) {
    echo setAlert('User berhasil dihapus!', 'index.php');
    exit;
  }
}

if ($_GET['iduser']) {
  $id = $_GET["iduser"];

  if ( hapus($id) > 0 ) {
    echo setAlert('User berhasil dihapus!', 'index.php');
    exit;
  }
}


echo setAlert('User gagal dihapus!', 'index.php');
exit;