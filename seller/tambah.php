<?php 
	require_once '../template/header.php';
	require 'function.php';

	if (isset($_POST["submit"])) {
		if (tambah($_POST) > 0) {
			echo setAlert('Barang berhasil ditambahkan', 'index.php');
			exit;
		}

		echo setAlert('Barang gagal ditambahkan', 'tambah.php');
		exit;
	}

	if (!isset($_SESSION['username']) || $_SESSION['role'] != "seller") {
		echo setAlert('Halaman tidak dapat diakses', '../users/index.php');
		exit;
	}
?>

<div class="container">
	<div class="row justify-content-center mb-5">

		<div class="col col-lg-8">
			<a href="index.php" class="btn btn-secondary btn-sm mb-3">&larr; Kembali</a>

			<div class="card">
				<div class="card-body">

					<h5 class="card-title mb-3 text-uppercase">+Barang</h5>
					<form action="" method="post">
		
						<div class="col mb-3">
							<label for="nama_barang">Nama Barang</label>
							<input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
						</div>

						<div class="row mb-3">
							<div class="col mb-3">
								<label for="jumlah">Jumlah</label>
								<div class="input-group">
									<span class="input-group-text" id="jumlah-odd">#</span>
									<input type="number" name="jumlah" id="jumlah" class="form-control" aria-describedby="jumlah-odd" required>
								</div>
							</div>

							<div class="col mb-3">
								<label for="harga">Harga</label>
								<div class="input-group">
									<span class="input-group-text" id="harga-odd">Rp</span>
									<input type="number" name="harga" id="harga" class="form-control" aria-describedby="harga-odd" placeholder="0" required>
								</div>
							</div>
						</div>

						<div class="mb-3 text-center">
							<button name="submit" type="submit" class="btn btn-success btn-sm w-100">Tambah Barang</button>
						</div>
					</form>
					
				</div>
			</div>

		</div>

	</div>
</div>

<?php include '../template/footer.php'; ?>