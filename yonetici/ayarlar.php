<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM ayarlar");
$sorgu->execute();


?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Site Ayarları</li>
        </ol>
        

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">


                <div class="table-responsive">
                    
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <?php while ($sonuc = $sorgu->fetch()) { ?>

                            <tr><th>Site Adı</th><td><?= $sonuc["siteadi"] ?></td></tr>
                            <tr><th>Site Logo</th><td><?= $sonuc["sitelogo"] ?></td></tr>
                            <tr><th>Site Açıklaması</th><td><?= $sonuc["sitedesc"] ?></td></tr>
                            <tr><th>Site Anahtar Kelimeler</th><td><?= $sonuc["sitekeyw"] ?></td></tr>
                            <tr><th>Facebook</th><td><?= $sonuc["face"] ?></td></tr>
                            <tr><th>Instagram</th><td><?= $sonuc["insta"] ?></td></tr>
                            <tr><th>Twitter</th><td><?= $sonuc["twit"] ?></td></tr>
                            <tr><th>E-Posta</th><td><?= $sonuc["eposta"] ?></td></tr>
                            <tr><th>Adres</th><td><?= $sonuc["adres"] ?></td></tr>
                            <tr><th>Harita</th>  <td><?= $sonuc["harita"] ?></td></tr>
                            <tr><th>Telefon</th><td><?= $sonuc["tel"] ?></td></tr>
                            <tr><th>Copyright Yazısı</th>  <td><?= $sonuc["copy"] ?></td></tr>

                            
                            

                        
                        </thead>

                        <tbody>  
                            
                        </tbody>
                    </table><a class="btn btn-primary" href="ayarlarguncelle.php?id=<?= $sonuc["id"] ?>">Ayarları Düzenle</a><?php
                        } //while bitimi
                        ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <?php
    include('inc/footer.php');
    ?>
