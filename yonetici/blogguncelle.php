<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM blog Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor



        if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
             $baslik = $_POST['baslik']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
             $aciklama = $_POST['aciklama'];
             $tarih = $_POST['tarih'];
             $buton = $_POST['buton'];
             $hata = '';



             if ($_FILES["resim"]["name"] != "") {
                $resim = strtolower($_FILES['resim']['name']);
                if (file_exists('img/' . $resim)) {
                    $hata = "$resim diye bir dosya var";
                } else {
                    $boyut = $_FILES['resim']['size'];
                    if ($boyut > (1024 * 1024 * 2)) {
                        $hata = 'Dosya boyutu 2MB den büyük olamaz.';
                    } else {
                        $dosya_tipi = $_FILES['resim']['type'];
                        $dosya_uzanti = explode('.', $resim);
                        $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                        if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                            //if (($dosya_tipi != 'image/png' || $dosya_uzanti != 'png' )&&( $dosya_tipi != 'image/jpeg' || $dosya_uzanti != 'jpg')) {
                            $hata = 'Hata, dosya türü JPEG veya PNG olmalı.';
                        } else {
                            $dosya = $_FILES["resim"]["tmp_name"];
                            copy($dosya, "../img/" . $resim);
                            unlink('../img/' . $sonuc["resim"]); //eski dosya siliniyor.
                        }
                    }
                }
            } else {
                //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki resimi değiştirmiyoruz
                $resim = $sonuc["resim"];
            }

            if ($baslik <> "" && $aciklama <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                //Değişecek veriler
                $satir = [
                  'id' => $_GET['id'],
                  'baslik' => $baslik,
                  'aciklama' => $aciklama,
                  'resim' => $resim,
                  'buton' => $buton,
                  'tarih' => $tarih
              ];
                // Veri güncelleme sorgumuzu yazıyoruz.
              $sql = "UPDATE blog SET resim=:resim, baslik=:baslik, aciklama=:aciklama, tarih=:tarih, buton=:buton WHERE id=:id;";     
              $durum = $baglanti->prepare($sql)->execute($satir);

              if ($durum)
              {
               echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "blog.php"});

               </script>';
           } else {
                    echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
                }
            } else {
                echo 'Hata oluştu: ' . $hata; // dosya hatası ve form elemanlarının boş olma durumunua göre hata döndürüyoruz.
            }
            if ($hata != "") {
                echo '<script>swal("Hata","' . $hata . '","error");</script>';
            }
        }



        ?>
        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Blog Düzenle</li>
                </ol>

      
                
                       
                      
                          <div class="card mb-3">

                            <div class="card-body">

                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <!--form elemanı olarak file kullanıyoruz -->
                                      <input type="file" name="resim"/>
                                      <img width="150px" src="../img/<?php echo $sonuc['resim']; ?>" alt="">
                                  </div>
                                  <div class="form-group">
                                    <label>Başlık</label>
                                    <input required type="text" value="<?= $sonuc["baslik"] ?>" class="form-control" name="baslik">
                                </div>

                                <div class="form-group">
                                    <label>Açıklama</label>
                                    <input required type="text" value="<?= $sonuc["aciklama"] ?>" class="form-control" name="aciklama">
                                </div>

                                <div class="form-group">
                                    <label>Tarih</label>
                                    <input required type="date" value="<?= $sonuc["tarih"] ?>" class="form-control" name="tarih">
                                </div>

                                <div class="form-group">
                                    <label>Buton</label>
                                    <input required type="text" value="<?= $sonuc["buton"] ?>" class="form-control" name="buton">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>

                            </form>


                        </div>
                    </div>
                


       

        <!-- DataTables Example -->

       


        <!-- /.container-fluid -->


        
        
        <link rel="stylesheet" type="text/css" href="css/switch.css">