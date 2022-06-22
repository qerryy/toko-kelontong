<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Perancangan & Perogramman Web</title>
    <!-- JULY FITRIANI -->

</head>
<body>
  <?php
    require './helper/alert-helper.php';
    require './users/function.php';
  
    $query = "SELECT toko.id, toko.nama_toko, toko.deskripsi, user.username as owner FROM toko 
              JOIN user ON toko.id_user=user.id ORDER BY toko.id DESC";
    $listToko = query($query);
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container">
      <a class="navbar-brand" href="./users/index.php">TokoSidia</a>

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
                  <li><a class="dropdown-item" href="./seller/index.php">Kelola Toko</a></li>
                  <li><hr class="dropdown-divider"></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="./users/logout.php">Log Out</a></li>
              </ul>
            </li>

          <?php else : ?>
            <li class="nav-item">
              <a href="./users/login.php" class="nav-link text-center mx-lg-1">Login</a>
            </li>
            <li class="nav-item">
              <a href="./users/register.php" class="nav-link btn btn-primary btn-sm mx-lg-1">Sign Up</a>
            </li>
            
          <?php endif; ?>
          
        </ul>
      </div>

    </div>
  </nav>


  <div class="container">
    <div class="row g-3 justify-content-center mb-5">

      <?php if (count($listToko) > 0): ?>
        <?php foreach ($listToko as $toko): ?>
          <div class="col col-md-6 col-lg-3 mb-4">

            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title border-bottom pb-2">
                  <i class="bi bi-shop text-danger"></i>
                  <?= $toko['nama_toko']; ?>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    @<?= $toko['owner'] ;?>
                </h6>
                <p class="card-text text-truncate"><?= $toko['deskripsi']; ?></p>
                <a href="./users/toko.php?id=<?= $toko['id']; ?>" class="btn btn-outline-success btn-sm">Lihat Toko</a>
              </div>
            </div>

          </div>
        <?php endforeach ?>
      <?php else : ?>
        <div class="col col-md-6 mb-4">
            <div class="border p-4">
                <h4 class="text-center">Tidak ada toko yang dapat ditampilkan.</h4>
            </div>
        </div>
      <?php endif ?>

    </div>
  </div>

  <script src="./src/js/bootstrap.bundle.min.js"></script>

</body>
</html>