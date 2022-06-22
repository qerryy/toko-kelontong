<?php
    require_once '../template/header.php';
    require 'function.php';

    if (isset($_POST["submit"])) {
        if (register($_POST) > 0) {
            if (registerToko($_POST) > 0) {
                echo setAlert('Toko berhasil dibuat! Silahkan Login.', '../users/login.php');
                exit;
            }

            echo setAlert('Gagal Membuat Toko!', 'register.php');
            exit;
        }

        echo setAlert('Gagal Membuat Akun!', 'register.php');
        exit;
    }

    if (isset($_SESSION['username']) && $_SESSION['role'] == "seller") {
        echo setAlert('Anda sudah terdaftar', 'index.php');
        exit;
	}
?>

<div class="container">
    <div class="row justify-content-center mb-5">

        <div class="col col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">DAFTARKAN TOKO ANDA</h5>
                   	<form action="" method="post">

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>

                        <div class="mb-5 row">
                            <div class="col">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="mb-5 row">
                            <div class="col">
                                <label for="nama_toko" class="col form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="deskripsi" class="col form-label">Deskripsi Singkat</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                   		<div class="mb-3 row text-center">
                           <div class="col">
                                <button name="submit" type="submit" class="btn btn-primary btn-sm w-100">Daftar</button>
                           </div>
                   		</div>

                   	</form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>