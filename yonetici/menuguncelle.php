<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM menuler Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $menu1 = $_POST['menu1']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $menu2 = $_POST['menu2'];
    $menu3 = $_POST['menu3'];
    $menu4 = $_POST['menu4'];
    $menu5 = $_POST['menu5'];
    $menu6 = $_POST['menu6'];
    $menu7 = $_POST['menu7'];
    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.
    
    if ($menu1 <> "" && $menu2 <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        $satir = [
            'id' => $_GET['id'],
            
            'menu1' => $menu1,
            'menu2' => $menu2,
            'menu3' => $menu3,
            'menu4' => $menu4,
            'menu5' => $menu5,
            'menu6' => $menu6,
            'menu7' => $menu7
          
        ];


        // Veri güncelleme sorgumuzu yazıyoruz.
        $sql = "UPDATE menuler SET menu1=:menu1 , menu2=:menu2 , menu3=:menu3 , menu4=:menu4 , menu5=:menu5 , menu6=:menu6 , menu7=:menu7 WHERE id=:id";
        $durum = $baglanti->prepare($sql)->execute($satir);

        if ($durum) {
            echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "menuler.php"});

</script>';
            // Eğer güncelleme sorgusu çalıştıysa urunler.php sayfasına yönlendiriyoruz.
        } else {
            echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
    if ($hata != "") {
        echo '<script>swal("Hata","' . $hata . '","error");</script>';
    }
}
?>
<script src="vendor/CKEditor5/ckeditor.js"></script>
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Site Ayarları Düzenle</li>
        </ol>


        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="" enctype="multipart/form-data">
                   
                    <div class="form-group">
                        <label>Menü 1</label>
                        <input required type="text" value="<?= $sonuc["menu1"] ?>" class="form-control" name="menu1">
                    </div>

                    <div class="form-group">
                        <label>Menü 2</label>
                        <input required type="text" value="<?= $sonuc["menu2"] ?>" class="form-control" name="menu2">
                    </div>

                    <div class="form-group">
                        <label>Menü 3</label>
                        <input required type="text" value="<?= $sonuc["menu3"] ?>" class="form-control" name="menu3">
                    </div>

                    <div class="form-group">
                        <label>Menü 4</label>
                        <input required type="text" value="<?= $sonuc["menu4"] ?>" class="form-control" name="menu4">
                    </div>

                    <div class="form-group">
                        <label>Menü 5</label>
                        <input required type="text" value="<?= $sonuc["menu5"] ?>" class="form-control" name="menu5">
                    </div>

                    <div class="form-group">
                        <label>Menü 6</label>
                        <input required type="text" value="<?= $sonuc["menu6"] ?>" class="form-control" name="menu6">
                    </div>

                    <div class="form-group">
                        <label>Menü 7</label>
                        <input required type="text" value="<?= $sonuc["menu7"] ?>" class="form-control" name="menu7">
                    </div>
                   

                    

                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>

                </form>


            </div>
        </div>


        <!-- /.container-fluid -->
        <script src="js/aktifcustom.js"></script>
        <link rel="stylesheet" type="text/css" href="css/switch.css">