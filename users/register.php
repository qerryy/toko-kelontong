<?php
    require_once '../template/header.php';
    require 'function.php';

    if (isset($_POST["submit"])) {
        if (register($_POST) > 0) {
            echo setAlert('Berhasil Register, Silahkan Login', 'login.php');
            exit;
        }

        echo setAlert('Gagal Register!', 'register.php');
        exit;
    }

    if (isset($_SESSION['username'])) {
        echo setAlert('Anda sudah login!', 'index.php');
        exit;
	}
?>

<div class="container">
    <div class="row justify-content-center mb-5">

        <div class="col col-lg-6">

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">REGISTER</h5>
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

                   		<div class="mb-3 row text-center">
                           <div class="col">
                                <button name="submit" type="submit" class="btn btn-primary btn-sm w-100">REGISTER</button>
                           </div>
                   		</div>

                   		<div class="mb-3 row text-center">
                           <div class="col">
                                <a href="../seller/register.php" class="text-secondary btn btn-sm border border-2 w-100">Daftar sebagai penjual</a>
                           </div>
                   		</div>

                   	</form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>