<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM musteri Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $yorum = $_POST['yorum']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $yazar = $_POST['yazar'];
    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.
    
    if ($yorum <> "" && $yazar <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        $satir = [
            'id' => $_GET['id'],
            
            'yorum' => $yorum,
            'yazar' => $yazar
          
        ];


        // Veri güncelleme sorgumuzu yazıyoruz.
        $sql = "UPDATE musteri SET yazar=:yazar , yorum=:yorum WHERE id=:id";
        $durum = $baglanti->prepare($sql)->execute($satir);

        if ($durum) {
            echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "musteri.php"});

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
            <li class="breadcrumb-item active">Müşteri Yorumları Düzenle</li>
        </ol>


        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="" enctype="multipart/form-data">
                   
                    <div class="form-group">
                        <label>Yazar</label>
                        <input required type="text" value="<?= $sonuc["yazar"] ?>" class="form-control" name="yazar">
                    </div>

                    <div class="form-group">
                        <label>Yorum</label>
                        <input required type="text" value="<?= $sonuc["yorum"] ?>" class="form-control" name="yorum">
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