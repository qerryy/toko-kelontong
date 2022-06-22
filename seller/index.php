<?php
    require_once '../template/header.php';
    require 'function.php';

    if (!isset($_SESSION['username']) || $_SESSION['role'] != "seller") {
        echo setAlert('Halaman tidak dapat diakses!', '../users/index.php');
        exit;
	}

    $userID = $_SESSION['id_user'];
    $query = "SELECT barang.id as barangID, barang.nama, barang.jumlah, barang.harga,
                toko.id_user as userID
                FROM `barang_toko`
                JOIN barang ON barang.id=barang_toko.id_barang
                JOIN toko on toko.id=barang_toko.id_toko
                WHERE toko.id_user=$userID ORDER BY barangID DESC";

    $listBarang = query($query);
    $toko = getToko($_SESSION['id_user']);
?>

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">

            <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
                <a href="tambah.php" class="btn btn-primary mb-2">Tambah Barang</a>
                <h3>
                    <a href="../users/toko.php?id=<?= $toko['id'];?>" class="text-decoration-none text-dark">
                        <i class="bi bi-shop text-danger"></i>
                        <?= $toko['nama_toko']; ?>
                    </a>
                </h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Daftar Barang</h5>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>JUMLAH</th>
                                <th>HARGA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($listBarang) > 0): ?>
                                <?php foreach ($listBarang as $key => $barang): ?>
                                <tr class="align-middle">
                                    <td><?= ($key + 1) ?></td>
                                    <td><?= $barang['nama'] ?></td>
                                    <td>
                                        <?= $barang['jumlah'] ?>
                                    </td>
                                    <td>
                                        <?= $barang['harga'] ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?= $barang['barangID'] ?>" class="btn btn-outline-success btn-sm m-1">
                                            Edit
                                        </a>
                                        <a
                                            href="hapus.php?barangid=<?= $barang['barangID'] ?>&userid=<?=$barang['userID']?>"
                                            class="btn btn-outline-danger btn-sm m-1"
                                            onclick="return confirm('Yakin untuk menghapus?');">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else :?>
                                <tr>
                                    <td colspan="6" class="text-center">Anda Belum menambahkan apapun.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>