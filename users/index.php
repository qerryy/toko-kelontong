<?php
    require_once '../template/header.php';
    require 'function.php';
    
    $query = "SELECT toko.id, toko.nama_toko, toko.deskripsi, user.username as owner FROM toko 
            JOIN user ON toko.id_user=user.id ORDER BY toko.id DESC";
                
    $listToko = query($query);
?>

<div class="container">
    <div class="row g-3 justify-content-center mb-5">

        <?php if (count($listToko) > 0): ?>
            <?php foreach ($listToko as $toko): ?>
                <div class="col col-md-6 col-lg-3 mb-4">

                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title border-bottom pb-2">
                                <i class="bi bi-shop text-danger"></i>
                                <?= $toko['nama_toko'] ;?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                @<?= $toko['owner'] ;?>
                            </h6>
                            <p class="card-text text-truncate"><?= $toko['deskripsi'] ;?></p>
                            <a href="./toko.php?id=<?= $toko['id']; ?>" class="btn btn-outline-success btn-sm">Lihat Toko</a>
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

<?php require_once '../template/footer.php'; ?>