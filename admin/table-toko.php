<?php
  $query = "SELECT * FROM toko";
  $listToko = query($query);
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-3">Daftar Toko</h5>

    <table class="table table-striped">
      <thead>
          <tr>
            <th>#</th>
            <th>NAMA TOKO</th>
            <th>DESKRIPSI</th>
            <th>AKSI</th>
          </tr>
      </thead>
      <tbody>
          <?php if (count($listToko) > 0): ?>
              <?php foreach ($listToko as $key => $toko): ?>
              <tr class="align-middle">
                  <td><?= ($key + 1) ?></td>
                  <td><?= $toko['nama_toko'] ?></td>
                  <td class="text-truncate">
                      <?= $toko['deskripsi'] ?>
                  </td>
                  <td>
                      <a
                          href="hapus.php?idtoko=<?= $toko['id'] ?>"
                          class="btn btn-outline-danger btn-sm m-1"
                          onclick="return confirm('Menghapus Toko juga akan menghapus User pemilik toko! Hapus?');">
                          Hapus
                      </a>
                  </td>
              </tr>
              <?php endforeach ?>
          <?php else :?>
              <tr>
                  <td colspan="6" class="text-center">Tidak ada Toko yang bisa ditampilkan.</td>
              </tr>
          <?php endif ?>
      </tbody>
    </table>

  </div>
</div>