<?php
	require_once '../template/header.php';
	require 'function.php';

	$id_user = $_GET["id"];

	$user = mysqli_query($conn, "SELECT * FROM user WHERE id=$id_user");
	$user = mysqli_fetch_assoc($user);

	if ( isset($_POST["submit"]) ) {
		if ( updateUser($_POST) > 0 ) {
      if ($_SESSION['role'] == "seller") {
        updateToko($_POST);
      }
			
			$newUser = getUserById($id_user);
			createSession($newUser);

      echo setAlert('Akun berhasil diubah!', "setting.php?id=$id_user");
      exit;
		}

		echo setAlert('Akun gagal diubah!', "setting.php?id=$id_user");
		exit;
	}

	if (!isset($_SESSION['username']) || $_SESSION['id_user'] != $id_user) {
		echo setAlert('Halaman tidak dapat diakses!', '../users/index.php');
		exit;
	}

  if ($_SESSION['role'] == "seller") {
    $toko = mysqli_query($conn, "SELECT * FROM toko WHERE id_user=$id_user");
    $toko = mysqli_fetch_assoc($toko);
  }
?>

<div class="container">
	<div class="row justify-content-center mb-5">

		<div class="col col-lg-8">
			<a href="index.php" class="btn btn-secondary btn-sm mb-3">&larr; Homepage</a>

			<div class="card">
				<div class="card-body">

					<h5 class="card-title mb-3">Settings</h5>
					<form action="" method="post">
						<input type="hidden" name="id_user" value="<?= $user['id'] ?>">

						<div class="col mb-3">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" required>
						</div>

						<div class="col mb-3">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="New Password">
						</div>

            <?php if ($_SESSION['role'] == "seller") : ?>
              <div class="col mb-3">
                <label for="nama_toko">Nama Toko</label>
                <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="<?=$toko['nama_toko'];?>" required>
              </div>

              <div class="col mb-4">
                <label for="deskripsi">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required><?= $toko['deskripsi']; ?></textarea>
              </div>
            <?php endif; ?>


						<div class="mb-3 text-center">
							<button name="submit" type="submit" class="btn btn-success btn-sm w-100">Update</button>
						</div>

					</form>

				</div>
			</div>

		</div>

	</div>
</div>

<?php include '../template/footer.php'; ?>