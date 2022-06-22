<?php
    if (!session_id()) session_start();
    require '../helper/alert-helper.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <title>Perancangan & Perogramman Web</title>
    <!-- JULY FITRIANI -->

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="../users/index.php">TokoSidia</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNavDarkDropdown">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <?php if ($_SESSION['role'] == "seller") : ?>
                                    <li><a class="dropdown-item" href="../seller/index.php">Kelola Toko</a></li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item" href="../users/setting.php?id=<?= $_SESSION['id_user']; ?>">Settings</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../users/logout.php">Log Out</a></li>
                            </ul>
                        </li>

                    <?php else : ?>
                        <li class="nav-item">
                            <a href="../users/login.php" class="nav-link text-center mx-lg-1">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="../users/register.php" class="nav-link btn btn-primary btn-sm mx-lg-1">Sign Up</a>
                        </li>

                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav>