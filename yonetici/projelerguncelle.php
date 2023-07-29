<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM projeler Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor



        if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
             $alt = $_POST['alt']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
             $hata = '';



             if ($_FILES["pr"]["name"] != "") {
                $pr = strtolower($_FILES['pr']['name']);
                if (file_exists('images/' . $pr)) {
                    $hata = "$pr diye bir dosya var";
                } else {
                    $boyut = $_FILES['pr']['size'];
                    if ($boyut > (1024 * 1024 * 2)) {
                        $hata = 'Dosya boyutu 2MB den büyük olamaz.';
                    } else {
                        $dosya_tipi = $_FILES['pr']['type'];
                        $dosya_uzanti = explode('.', $pr);
                        $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                        if (!in_array($dosya_tipi, ['image/png', 'image/jpeg', 'image/svg+xml']) || !in_array($dosya_uzanti, ['png', 'jpg', 'svg'])) {
                            //if (($dosya_tipi != 'image/png' || $dosya_uzanti != 'png' )&&( $dosya_tipi != 'image/jpeg' || $dosya_uzanti != 'jpg')) {
                            $hata = 'Hata, dosya türü JPEG veya PNG veya SVG olmalı.';
                        } else {
                            $dosya = $_FILES["pr"]["tmp_name"];
                            copy($dosya, "../img/" . $pr);
                            unlink('../img/' . $sonuc["pr"]); //eski dosya siliniyor.
                        }
                    }
                }
            } else {
                //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki pri değiştirmiyoruz
                $pr = $sonuc["pr"];
            }

            if ($alt <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                //Değişecek veriler
                $satir = [
                  'id' => $_GET['id'],
                  'alt' => $alt,
                  'pr' => $pr
              ];
                // Veri güncelleme sorgumuzu yazıyoruz.
              $sql = "UPDATE projeler SET pr=:pr, alt=:alt WHERE id=:id;";     
              $durum = $baglanti->prepare($sql)->execute($satir);

              if ($durum)
              {
               echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "projeler.php"});

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
                    <li class="breadcrumb-item active">Servisleri Düzenle</li>
                </ol>

      
                
                       
                      
                          <div class="card mb-3">

                            <div class="card-body">

                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <!--form elemanı olarak file kullanıyoruz -->
                                      <input type="file" name="pr"/>
                                      <img width="150px" src="../img/<?php echo $sonuc['pr']; ?>" alt="">
                                  </div>
                                  <div class="form-group">
                                    <label>Alt Etiketi</label>
                                    <input required type="text" value="<?= $sonuc["alt"] ?>" class="form-control" name="alt"
                                    placeholder="Alt Etiketi">
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