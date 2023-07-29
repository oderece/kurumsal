<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM blog");
$sorgu->execute();

?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Blog Ayarları</li>
        </ol>
<a class="btn btn-primary" href="blogekle.php">Blog Ekle</a><br><br>

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Blog Resim</th>
                            <th>Blog Başlık</th>
                            <th>Blog Açıklama</th>
                            <th>Blog Tarih</th>
                            <th>Blog Buton</th>
                            <th>Düzenle</th>
                            <th>Sil</th>


                        </tr>
                        </thead>

                        <tbody>

                        <?php while ($sonuc = $sorgu->fetch()) { ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><img src="../img/<?= $sonuc["resim"] ?>" width="150px"/></td>
                                <td><?= $sonuc["baslik"] ?></td>
                                <td><?= $sonuc["aciklama"] ?></td>
                                <td><?= $sonuc["tarih"] ?></td>
                                <td><?= $sonuc["buton"] ?></td>
                                
                                
                                <td><a class="btn btn" href="blogguncelle.php?id=<?= $sonuc["id"] ?>"><span
                                                class="fa fa-edit fa-2x"></span></a></td>

                                <td>
                                    <a class="dropdown-item" href="blogsil.php?sayfa=blog&id=<?= $sonuc["id"] ?>" data-toggle="modal"
                                       data-target="#sil<?= $sonuc["id"] ?>"><span class="fa fa-trash fa-2x"></span></a></td>

                            </tr>
                            <?php
                        } //while bitimi
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <?php
    include('inc/footer.php');
    ?>




