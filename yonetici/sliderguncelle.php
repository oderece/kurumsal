<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM slider Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor



        if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
             $sliderbaslik = $_POST['sliderbaslik']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
             $slideraciklama = $_POST['slideraciklama'];
             $sliderlink = $_POST['sliderlink'];
             $sliderbuton = $_POST['sliderbuton'];
             $hata = '';



             if ($_FILES["sliderfoto"]["name"] != "") {
                $sliderfoto = strtolower($_FILES['sliderfoto']['name']);
                if (file_exists('images/' . $sliderfoto)) {
                    $hata = "$sliderfoto diye bir dosya var";
                } else {
                    $boyut = $_FILES['sliderfoto']['size'];
                    if ($boyut > (1024 * 1024 * 2)) {
                        $hata = 'Dosya boyutu 2MB den büyük olamaz.';
                    } else {
                        $dosya_tipi = $_FILES['sliderfoto']['type'];
                        $dosya_uzanti = explode('.', $sliderfoto);
                        $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                        if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                            //if (($dosya_tipi != 'image/png' || $dosya_uzanti != 'png' )&&( $dosya_tipi != 'image/jpeg' || $dosya_uzanti != 'jpg')) {
                            $hata = 'Hata, dosya türü JPEG veya PNG olmalı.';
                        } else {
                            $dosya = $_FILES["sliderfoto"]["tmp_name"];
                            copy($dosya, "../img/" . $sliderfoto);
                            unlink('../img/' . $sonuc["sliderfoto"]); //eski dosya siliniyor.
                        }
                    }
                }
            } else {
                //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki resimi değiştirmiyoruz
                $sliderfoto = $sonuc["sliderfoto"];
            }

            if ($sliderbaslik <> "" && $slideraciklama <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                //Değişecek veriler
                $satir = [
                  'id' => $_GET['id'],
                  'sliderbaslik' => $sliderbaslik,
                  'slideraciklama' => $slideraciklama,
                  'sliderfoto' => $sliderfoto,
                  'sliderbuton' => $sliderbuton,
                  'sliderlink' => $sliderlink
              ];
                // Veri güncelleme sorgumuzu yazıyoruz.
              $sql = "UPDATE slider SET sliderfoto=:sliderfoto, sliderbaslik=:sliderbaslik,sliderlink=:sliderlink, slideraciklama=:slideraciklama, sliderbuton=:sliderbuton WHERE id=:id;";     
              $durum = $baglanti->prepare($sql)->execute($satir);

              if ($durum)
              {
               echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "slider.php"});

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
                    <li class="breadcrumb-item active">Slider Düzenle</li>
                </ol>

      
                
                       
                      
                          <div class="card mb-3">

                            <div class="card-body">

                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <!--form elemanı olarak file kullanıyoruz -->
                                      <input type="file" name="sliderfoto"/>
                                      <img width="150px" src="../img/<?php echo $sonuc['sliderfoto']; ?>" alt="">
                                  </div>
                                  <div class="form-group">
                                    <label>Slider Başlık</label>
                                    <input required type="text" value="<?= $sonuc["sliderbaslik"] ?>" class="form-control" name="sliderbaslik"
                                    placeholder="Slider Başlık">
                                </div>

                                <div class="form-group">
                                    <label>Slider Açıklama</label>
                                    <input required type="text" value="<?= $sonuc["slideraciklama"] ?>" class="form-control" name="slideraciklama"
                                    placeholder="Slider Açıklama">
                                </div>

                                <div class="form-group">
                                    <label>Slider Buton</label>
                                    <input required type="text" value="<?= $sonuc["sliderbuton"] ?>" class="form-control" name="sliderbuton"
                                    placeholder="Slider Buton">
                                </div>
                                <div class="form-group">
                                    <label>Slider Buton Link</label>
                                    <input required type="text" value="<?= $sonuc["sliderlink"] ?>" class="form-control" name="sliderlink"
                                    placeholder="Slider Link">
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