<?php

$page = $_GET['page'];
$aksi = $_GET['aksi'];

if ($page == 'pelanggan') {
  if ($aksi == '') {
    include 'page/pelanggan/pelanggan.php';
  } elseif ($aksi == 'tambah') {
    include 'page/pelanggan/tambah.php';
  } elseif ($aksi == 'ubah') {
    include 'page/pelanggan/ubah.php';
  } elseif ($aksi == 'hapus') {
    include 'page/pelanggan/hapus.php';
  }
}

if ($_SESSION['Admin']) {
  if ($page == 'pengguna') {
    if ($aksi == '') {
      include 'page/pengguna/pengguna.php';
    } elseif ($aksi == 'tambah') {
      include 'page/pengguna/tambah.php';
    } elseif ($aksi == 'ubah') {
      include 'page/pengguna/ubah.php';
    } elseif ($aksi == 'hapus') {
      include 'page/pengguna/hapus.php';
    }
  }
}

if ($page == 'laundry') {
  if ($aksi == '') {
    include 'page/laundry/laundry.php';
  } elseif ($aksi == 'tambah') {
    include 'page/laundry/tambah.php';
  } elseif ($aksi == 'hapus') {
    include 'page/laundry/hapus.php';
  } elseif ($aksi == 'lunas') {
    include 'page/laundry/lunas.php';
  }
}

if ($page == 'transaksi') {
  if ($aksi == '') {
    include 'page/transaksi/transaksi.php';
  } elseif ($aksi == 'tambah') {
    include "page/transaksi/tambah.php";
  }
}

if ($page == '') {
  include 'home.php';
}
if ($page == 'about') {
  include "about.php";
}

if ($_SESSION['Kasir']) {
  if ($page == 'pengguna') {
    include "home.php";
  }
}
