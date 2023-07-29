<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM kullanicilar Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor


if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $kadi = $_POST['kadi'];// Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $parola = md5('56' . $_POST['parola'] . '23');
    $parolatekrar = md5('56' . $_POST['parolatekrar'] . '23');


    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.

    if ($kadi <> "" && $parola <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        $satir = [
            'id' => $_GET['id'],
            'kadi' => $kadi,
            'parola' => $parola,


        ];


        if ($parola == $parolatekrar && $parola != '' && $kadi != '') {

            $sql = "UPDATE kullanicilar SET kadi=:kadi,parola=:parola WHERE id=:id;";
            $durum = $baglanti->prepare($sql)->execute($satir);

            if ($durum) {
                echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "kullanicilar.php"});

            </script>';
                // Eğer güncelleme sorgusu çalıştıysa urunler.php sayfasına yönlendiriyoruz.
            }
        } else {
            echo '<script>swal("Hata","Hatalı, Lütfen Bilgilerinizi doğru girdiğinizden emin olunuz.","error");</script>'; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
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
            <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
        </ol>


        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input required type="text" value="<?= $sonuc["kadi"] ?>" class="form-control" name="kadi"
                               placeholder="Üst başlık">
                    </div>

                    <div class="form-group">
                        <label>Yeni Parola</label>
                        <input required type="password" class="form-control" name="parola"
                               placeholder="Yeni Parola">
                    </div>
                    <div class="form-group">
                        <label>Parola Tekrar</label>
                        <input required type="password" class="form-control" name="parolatekrar"
                               placeholder="Parola Tekrar">
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>


                </form>


            </div>
        </div>



