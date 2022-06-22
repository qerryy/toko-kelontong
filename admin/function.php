<?php 

$conn = mysqli_connect("localhost", "root", "", "db_tokosidia");

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
	global $tabel_user;

	$query = "DELETE FROM $tabel_user WHERE id = $id";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}