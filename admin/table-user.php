<?php
  $query = "SELECT * FROM user WHERE NOT role='admin'";
  $listUser = query($query);
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-3">Daftar User</h5>

    <table class="table table-striped">
      <thead>
          <tr>
            <th>#</th>
            <th>USERNAME</th>
            <th>ROLE</th>
            <th>AKSI</th>
          </tr>
      </thead>
      <tbody>
          <?php if (count($listUser) > 0): ?>
              <?php foreach ($listUser as $key => $user): ?>
              <tr class="align-middle">
                  <td><?= ($key + 1) ?></td>
                  <td><?= $user['username'] ?></td>
                  <td><?= $user['role'] ?></td>
                  <td>
                      <a
                          href="hapus.php?iduser=<?= $user['id'] ?>"
                          class="btn btn-outline-danger btn-sm m-1"
                          onclick="return confirm('Menghapus User juga akan menghapus toko yang berkaitan! Hapus?');">
                          Hapus
                      </a>
                  </td>
              </tr>
              <?php endforeach ?>
          <?php else :?>
              <tr>
                  <td colspan="6" class="text-center">Tidak ada User yang bisa ditampilkan.</td>
              </tr>
          <?php endif ?>
      </tbody>
    </table>

  </div>
</div>