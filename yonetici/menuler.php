<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM menuler");
$sorgu->execute();
?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Menü Ayarları</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Menü ID</th>
                                <th>Menü Adı</th>
                            </tr>
                        </thead>

                        <tbody>  
                            <?php while ($sonuc = $sorgu->fetch()) { ?>
                                <tr>
                                    <td><?= $sonuc["id"] ?></td>
                                    <td><?= $sonuc["menu_name"] ?></td>
                                </tr>
                            <?php } //while bitimi ?>
                        </tbody>
                    </table>
                    
                    <a class="btn btn-primary" href="menuguncelle.php?id=<?= $sonuc["id"] ?>">Menüleri Düzenle</a>
                    
                    <form action="menuekle.php" method="post">
                        Menü Adı: <input type="text" name="menu_name">
                        <input type="submit" value="Menü Ekle">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
include('inc/footer.php');
?>
