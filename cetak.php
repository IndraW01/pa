<?php

require_once __DIR__ . '/vendor/autoload.php';
include "page/laundry/prosesLaundry.php";

$id = $_GET['id'];
$cetak = lihat("SELECT * FROM tb_laundry, tb_user, tb_pelanggan, tb_paket WHERE tb_laundry.id_user=tb_user.id_user and tb_laundry.id_pelanggan=tb_pelanggan.kode_pelanggan and tb_laundry.id_paket=tb_paket.id_paket and id_laundry = $id")[0];

date_default_timezone_set('Asia/Jakarta');
$jam = date('H:i:s');

$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk Laundry</title>
  <link rel="stylesheet" href="css/cetak.css">
</head>
<body>
  <div class="container">
    <header>
      <h2 class="jalan">Jalan Balikpapan - Handil II Rt 19 Kelurahan Kuala Samboja</h2>
      <hr>
    </header>
    <main>
      <p>Tanggal Transaksi : ' . $cetak['tanggal_selesai'] . '</p>
      <p>Admin/Kasir : ' . $cetak['nama_user'] . '</p>
      <p>Jam Cetak : ' . $jam . '</p>
      <hr>
      <p>Nama Pelanggan : ' . $cetak['nama_pelanggan'] . '</p>
      <p>Paket Laundry : ' . $cetak['nama_paket'] . '</p>
      <p>Harga Paket/KG : ' . $cetak['harga_paket'] . '</p>
      <p>Jumah Kiloan : ' . $cetak['jumlah_kiloan'] . '</p>
      <p>Total Harga : ' . $cetak['nominal'] . '</p>
      <hr>
      <p>Terima Kasih Telah Memakai Jasa Laundry Kami</p>
    </main>
  </div>
</body>

</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('struk-laundry.pdf', 'I');
