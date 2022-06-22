<?php
  require_once '../template/header.php';
  require 'function.php';

  if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    echo setAlert('Halaman tidak dapat diakses!', '../users/index.php');
    exit;
  }
?>

<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-12">

      <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
        <h3>Dashboard</h3>
      </div>

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="toko-tab" data-bs-toggle="tab" data-bs-target="#toko" type="button" role="tab" aria-controls="toko" aria-selected="true">Toko</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">User</button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="toko" role="tabpanel" aria-labelledby="toko-tab">
          <?php include_once 'table-toko.php' ?>
        </div>
        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
          <?php include_once 'table-user.php' ?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php require_once '../template/footer.php'; ?>