<?php

include "page/laundry/prosesLaundry.php";

$pengguna = count(lihat("SELECT * FROM tb_user"));
$pelanggan  = count(lihat("SELECT * FROM tb_pelanggan"));
$laundry = count(lihat("SELECT * FROM tb_laundry"));
$transaksi = count(lihat("SELECT * FROM tb_transaksi"));


?>

<section class="content-header">
  <h1>
    Dashboard
    <small>Data Laundry</small>
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $pengguna; ?></h3>

          <p>Data Pengguna</p>
        </div>
        <div class="icon">
          <i class="ion-person"></i>
        </div>
        <a href="?page=pengguna" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pelanggan; ?></h3>

          <p>Data Pelanggan</p>
        </div>
        <div class="icon">
          <i class="ion-person-stalker"></i>
        </div>
        <a href="?page=pelanggan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $laundry; ?></h3>

          <p>Data Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion-cash"></i>
        </div>
        <a href="?page=laundry" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $transaksi; ?></h3>

          <p>Data Pemasukan</p>
        </div>
        <div class="icon">
          <i class="ion-cash"></i>
        </div>
        <a href="?page=transaksi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>