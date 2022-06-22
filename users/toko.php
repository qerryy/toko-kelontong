<?php
  require_once '../template/header.php';
  require 'function.php';

  $id_toko = $_GET['id'];

  $toko = getTokoById($id_toko);
  $query = "SELECT barang.id as barangID, barang.nama, barang.jumlah, barang.harga
            FROM `barang_toko`
            JOIN barang ON barang.id=barang_toko.id_barang
            WHERE barang_toko.id_toko=$id_toko ORDER BY barangID DESC";

  $listBarang = query($query);

  if (!isset($_SESSION['username'])) {
		echo setAlert('Anda belum login.', 'login.php');
		exit;
	}
?>

<div class="container">
  <div class="row justify-content-around mb-5">

    <div class="col">
      <a href="index.php" class="btn btn-secondary btn-sm mb-3">&larr; Homepage</a>

      <div class="card mb-3">
        <img src="https://source.unsplash.com/900x200/?store,shop" class="card-img-top" alt="Thumbnail">

        <div class="card-body">
          <h4 class="card-title border-bottom pb-2">
            <i class="bi bi-shop text-danger"></i>
            <?= $toko['nama_toko']; ?>
          </h4>

          <p class="card-text">
            <?= $toko['deskripsi']; ?>
          </p>
        </div>

        <div class="card-footer">
          <p class="card-text">
            <small class="text-muted">
              @<?= $toko['username']; ?>
            </small>
          </p>
        </div>
        
      </div>

      <ol class="list-group list-group-numbered mb-5">
        
        <?php if (count($listBarang) > 0): ?>
          <?php foreach ($listBarang as $key => $barang): ?>

            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold"><?= $barang['nama']; ?></div>
                <?= $barang['harga']; ?>
              </div>
              <span class="badge bg-primary rounded-pill">Stok: <?= $barang['jumlah']; ?></span>
            </li>

          <?php endforeach ?>

        <?php else :?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-normal">Tidak ada jualan</div>
              </div>
            </li>

        <?php endif ?>
      </ol>

    </div>

  </div>
</div>

<?php require_once '../template/footer.php'; ?>