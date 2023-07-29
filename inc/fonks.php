<?php
$sorgu = $baglanti->prepare("SELECT * FROM slider");
$sorgu->execute();
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

$sorgu = $baglanti->prepare("SELECT * FROM ayarlar");
$sorgu->execute();
$sonuc2 = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

$sorgu = $baglanti->prepare("SELECT * FROM menuler");
$sorgu->execute();
$sonuc3 = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor

$sorgu = $baglanti->prepare("SELECT * FROM hakkimizda");
$sorgu->execute();
$sonuc4 = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor
?>