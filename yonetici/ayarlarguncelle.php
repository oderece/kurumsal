<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM ayarlar Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $siteadi = $_POST['siteadi']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $copy = $_POST['copy'];
    $tel = $_POST['tel'];
    $sitelogo = $_POST['sitelogo'];
    $sitedesc = $_POST['sitedesc'];
    $sitekeyw = $_POST['sitekeyw'];
    $face = $_POST['face'];
    $insta = $_POST['insta'];
    $twit = $_POST['twit'];
    $eposta = $_POST['eposta'];
    $adres = $_POST['adres'];
    $harita = $_POST['harita'];
    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.
    
    if ($siteadi <> "" && $sitelogo <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        $satir = [
            'id' => $_GET['id'],
            
            'siteadi' => $siteadi,
            'copy' => $copy,
            'tel' => $tel,
            'sitelogo' => $sitelogo,
            'sitedesc' => $sitedesc,
            'sitekeyw' => $sitekeyw,
            'face' => $face,
            'insta' => $insta,
            'twit' => $twit,
            'eposta' => $eposta,
            'adres' => $adres,
            'harita' => $harita
          
        ];


        // Veri güncelleme sorgumuzu yazıyoruz.
        $sql = "UPDATE ayarlar SET siteadi=:siteadi , copy=:copy , tel=:tel , sitelogo=:sitelogo , sitedesc=:sitedesc , sitekeyw=:sitekeyw , face=:face , insta=:insta , twit=:twit , eposta=:eposta , adres=:adres , harita=:harita WHERE id=:id";
        $durum = $baglanti->prepare($sql)->execute($satir);

        if ($durum) {
            echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "ayarlar.php"});

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
                        <label>Site Adı</label>
                        <input required type="text" value="<?= $sonuc2["siteadi"] ?>" class="form-control" name="siteadi">
                    </div>

                    <div class="form-group">
                        <label>Site Logo</label>
                        <input required type="text" value="<?= $sonuc2["sitelogo"] ?>" class="form-control" name="sitelogo">
                    </div>

                    <div class="form-group">
                        <label>Site Açıklaması</label>
                        <input required type="text" value="<?= $sonuc2["sitedesc"] ?>" class="form-control" name="sitedesc">
                    </div>

                    <div class="form-group">
                        <label>Site Anahtar Kelimeler</label>
                        <input required type="text" value="<?= $sonuc2["sitekeyw"] ?>" class="form-control" name="sitekeyw">
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input required type="text" value="<?= $sonuc2["face"] ?>" class="form-control" name="face">
                    </div>

                    <div class="form-group">
                        <label>Instagram</label>
                        <input required type="text" value="<?= $sonuc2["insta"] ?>" class="form-control" name="insta">
                    </div>

                    <div class="form-group">
                        <label>Twitter</label>
                        <input required type="text" value="<?= $sonuc2["twit"] ?>" class="form-control" name="twit">
                    </div>

                    <div class="form-group">
                        <label>E-Posta</label>
                        <input required type="text" value="<?= $sonuc2["eposta"] ?>" class="form-control" name="eposta">
                    </div>

                    <div class="form-group">
                        <label>Adres</label>
                        <input required type="text" value="<?= $sonuc2["adres"] ?>" class="form-control" name="adres">
                    </div>

                    <div class="form-group">
                        <label>Harita</label>
                        <input required type="text" value="<?= $sonuc2["harita"] ?>" class="form-control" name="harita">
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input required type="text" value="<?= $sonuc2["tel"] ?>" class="form-control" name="tel">
                    </div>

                    <div class="form-group">
                        <label>Copyright Yazısı</label>
                        <input required type="text" value="<?= $sonuc2["copy"] ?>" class="form-control" name="copy">
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