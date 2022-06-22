<?php
    require_once '../template/header.php';
    require 'function.php';

    if (isset($_POST["submit"])) {
        login($_POST);
    }

    if (isset($_SESSION['username'])) {
        echo setAlert('Anda sudah login', 'index.php');
        exit;
	}
?>

<div class="container">
    <div class="row justify-content-center mb-5">
	
        <div class="col col-md-8 col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">LOGIN</h5>
                   	<form action="" method="post">

                        <div class="mb-4 row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>

                        <div class="mb-5 row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
					   
                   		<div class="mb-3 text-center">
                   			<button name="submit" type="submit" class="btn btn-primary btn-sm w-100">LOGIN</button>
                   		</div>

                   	</form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>