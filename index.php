<?php include('inc/ust.php');?>
    <div class="site-blocks-cover overlay bg-light" style="background-image: url('img/<?= $sonuc['sliderfoto'] ?>'); " id="anasayfa">

      <div class="container">
        <div class="row justify-content-center">

          <div class="col-12 text-center align-self-center text-intro">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <h1 class="text-white" data-aos="fade-up" data-aos-delay=""><?= $sonuc['sliderbaslik'] ?></h1>
                <p class="lead text-white" data-aos="fade-up" data-aos-delay="100"><?= $sonuc['slideraciklama'] ?></p>
                <p data-aos="fade-up" data-aos-delay="200"><a href="<?= $sonuc['sliderlink'] ?>" class="btn smoothscroll btn-primary"><?= $sonuc['sliderbuton'] ?></a></p>

              </div>
            </div>
          </div>
            
        </div>
      </div>

    </div>  

    

    <div class="site-section" id="hakkimizda">
  <div class="container">
    <div class="row ">
      <div class="col-12 mb-4 position-relative">
        <h2 class="section-title">
          <?= isset($sonuc3['menu2']) ? $sonuc3['menu2'] : '' ?>
        </h2>
      </div>
      <div class="col-lg-4">
        <p><?= isset($sonuc4['hak1']) ? $sonuc4['hak1'] : '' ?></p>
      </div>
      <div class="col-lg-4">
        <img src="img/<?= isset($sonuc4['hakres']) ? $sonuc4['hakres'] : '' ?>" class="img-fluid">
      </div>
      <div class="col-lg-4">
        <p><?= isset($sonuc4['hak2']) ? $sonuc4['hak2'] : '' ?></p>
      </div>
    </div>
  </div>
</div>



    <div class="site-section" id="servisler">
    <div class="container">
        <div class="row ">
            <div class="col-12 mb-5 position-relative">
                <h2 class="section-title text-center mb-5"><?= isset($sonuc3['menu3']) ? $sonuc3['menu3'] : '' ?></h2>
            </div>
            <?php
            $sorgu = $baglanti->prepare("SELECT * FROM servisler");
            $sorgu->execute();

            if ($sorgu->errorCode() != 0) {
                echo "SQL Error: ";
                print_r($sorgu->errorInfo());
            }

            while ($sonuc = $sorgu->fetch()) {
                ?>
                <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="">
                    <div class="service d-flex h-100">
                        <div class="svg-icon">
                            <img src="img/<?= $sonuc["resim"] ?>" alt="Image" class="img-fluid">
                        </div>
                        <div class="service-about">
                            <h3><?= $sonuc["baslik"] ?></h3>
                            <p><?= $sonuc["aciklama"] ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>



    <section class="site-section block__62272" id="projeler">
      

      <div class="container">
        <div class="row mb-5">
          <div class="col-12 position-relative">
            <h2 class="section-title text-center mb-5"><?= $sonuc3['menu4'] ?></h2>
          </div>
        </div>

        <div class="row justify-content-center mb-5" data-aos="fade">
          <div id="filters" class="filters text-center button-group col-md-7">
            <button class="btn btn-primary active" data-filter="*">Proje Resimleri</button>
          </div>
        </div>  
        <?php
          $sorgu = $baglanti->prepare("SELECT * FROM projeler");
          $sorgu->execute();

          while ($sonuc = $sorgu->fetch()) {
          ?>
        <div id="posts" class="row no-gutter">
          <div class="item web col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
            <a href="img/<?= $sonuc['pr'] ?>" class="item-wrap fancybox">
              <span class="icon-search2"></span>
              <img class="img-fluid" src="img/<?= $sonuc['pr'] ?>" alt="<?= $sonuc['alt'] ?>">
            </a>
          </div>
<?php
}
?>
    </section>


    <section class="site-section bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-5 position-relative">
            <h2 class="section-title text-center mb-5 text-white">Müşteri Yorumları</h2>
          </div>
        </div>
        <div class="owl-carousel slide-one-item">
          <?php
          $sorgu = $baglanti->prepare("SELECT * FROM musteri");
          $sorgu->execute();

          while ($sonuc = $sorgu->fetch()) {
          ?>
          <div class="slide">
            <blockquote>
              <p><?= $sonuc["yorum"] ?></p>
              <p><cite>&mdash; <?= $sonuc["yazar"] ?></cite></p>
            </blockquote>
          </div>
<?php } ?>
        </div>
      </div>
    </section>

    
    <section class="site-section bg-light" id="blog">
      <div class="container">
        <div class="row">
          
          <div class="col-12 mb-5 position-relative">
            <h2 class="section-title text-center mb-5"><?= $sonuc3['menu5'] ?></h2>
          </div>

          <?php
          $sorgu = $baglanti->prepare("SELECT * FROM blog");
          $sorgu->execute();

          while ($sonuc = $sorgu->fetch()) {
          ?>
          <div class="col-md-6 mb-5 mb-lg-0 col-lg-4">
            <div class="blog_entry">
              <a href="#"><img src="img/<?= $sonuc['resim'] ?>" class="img-fluid"></a>
              <div class="p-4 bg-white">
                <h3><a href="#"><?= $sonuc['baslik'] ?></a></h3>
                <span class="date"><?= $sonuc['tarih'] ?></span>
                <p><?= $sonuc['aciklama'] ?></p>
                <p class="more"><a href="#"><?= $sonuc['buton'] ?></a></p>
              </div>
            </div>
          </div>
<?php
}
?>
          
        </div>
      </div>
    </section>


    <section class="site-section" id="iletisim">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-5 position-relative">
            <h2 class="section-title text-center mb-5"><?= $sonuc3['menu6'] ?></h2>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-6">
            <iframe src="<?= $sonuc2['harita'] ?>" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
          <div class="col-lg-5">
            <br><br><br><br>
            <h3>Türkiye</h3>
            <ul class="list-unstyled mb-5">
              <li class="mb-3">
                <strong class="d-block mb-1">Adres</strong>
                <span><?= $sonuc2['adres'] ?></span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">Telefon</strong>
                <span><?= $sonuc2['tel'] ?></span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">E-Posta</strong>
                <a href="mailto:<?= $sonuc2['eposta'] ?>"><span><?= $sonuc2['eposta'] ?></span></a>
              </li>
            </ul>

            
          </div>
        </div>
      </div>
    </section>
<?php include('inc/alt.php');?>