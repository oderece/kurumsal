<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
include('../inc/ayar.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM hakkimizda Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor



        if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
             $hak1 = $_POST['hak1']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
             $hak2 = $_POST['hak2'];
             $hata = '';



             if ($_FILES["hakres"]["name"] != "") {
                $hakres = strtolower($_FILES['hakres']['name']);
                if (file_exists('img/' . $hakres)) {
                    $hata = "$hakres diye bir dosya var";
                } else {
                    $boyut = $_FILES['hakres']['size'];
                    if ($boyut > (1024 * 1024 * 2)) {
                        $hata = 'Dosya boyutu 2MB den büyük olamaz.';
                    } else {
                        $dosya_tipi = $_FILES['hakres']['type'];
                        $dosya_uzanti = explode('.', $hakres);
                        $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                        if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                            //if (($dosya_tipi != 'image/png' || $dosya_uzanti != 'png' )&&( $dosya_tipi != 'image/jpeg' || $dosya_uzanti != 'jpg')) {
                            $hata = 'Hata, dosya türü JPEG veya PNG olmalı.';
                        } else {
                            $dosya = $_FILES["hakres"]["tmp_name"];
                            copy($dosya, "../img/" . $hakres);
                            unlink('../img/' . $sonuc["hakres"]); //eski dosya siliniyor.
                        }
                    }
                }
            } else {
                //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki resimi değiştirmiyoruz
                $hakres = $sonuc["hakres"];
            }

            if ($hak1 <> "" && $hak2 <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                //Değişecek veriler
                $satir = [
                  'id' => $_GET['id'],
                  'hak1' => $hak1,
                  'hak2' => $hak2,
                  'hakres' => $hakres
              ];
                // Veri güncelleme sorgumuzu yazıyoruz.
              $sql = "UPDATE hakkimizda SET hakres=:hakres, hak1=:hak1, hak2=:hak2 WHERE id=:id;";     
              $durum = $baglanti->prepare($sql)->execute($satir);

              if ($durum)
              {
               echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "hakkimizda.php"});

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
                    <li class="breadcrumb-item active">Hakkımızda Düzenle</li>
                </ol>

      
                
                       
                      
                          <div class="card mb-3">

                            <div class="card-body">

                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <!--form elemanı olarak file kullanıyoruz -->
                                      <input type="file" name="hakres"/>
                                      <img width="150px" src="../img/<?php echo $sonuc['hakres']; ?>" alt="">
                                  </div>
                                  <div class="form-group">
                                    <label>Hakkımızda Sol</label>
                                    <input required type="text" value="<?= $sonuc["hak1"] ?>" class="form-control" name="hak1"
                                    placeholder="Hakkımızda Sol">
                                </div>

                                <div class="form-group">
                                    <label>Hakkımızda Sağ</label>
                                    <input required type="text" value="<?= $sonuc["hak2"] ?>" class="form-control" name="hak2"
                                    placeholder="Hakkımızda Sağ">
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