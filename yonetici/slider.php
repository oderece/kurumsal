<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM slider");
$sorgu->execute();

?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ana Sayfa</li>
        </ol>


        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Slider Foto</th>
                            <th>Slider Başlık</th>
                            <th>Slider Açıklama</th>
                            <th>Slider Buton</th>
                            <th>Slider Link</th>
                            <th>Düzenle</th>


                        </tr>
                        </thead>

                        <tbody>

                        <?php while ($sonuc = $sorgu->fetch()) { ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><img src="../img/<?= $sonuc["sliderfoto"] ?>" width="150px"/></td>
                                <td><?= $sonuc["sliderbaslik"] ?></td>
                                <td><?= $sonuc["slideraciklama"] ?></td>
                                <td><?= $sonuc["sliderbuton"] ?></td>

                                <td><?= $sonuc["sliderlink"] ?></td>
                                
                                <td><a class="btn btn" href="sliderguncelle.php?id=<?= $sonuc["id"] ?>"><span
                                                class="fa fa-edit fa-2x"></span></a></td>

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




