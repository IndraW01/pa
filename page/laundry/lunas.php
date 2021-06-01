<?php

include "koneksi.php";
include "prosesLaundry.php";
$id = $_GET['id'];

$laundry = lihat("SELECT * FROM tb_laundry WHERE id_laundry = $id")[0];
// var_dump($laundry);
// die;

$tanggal = $laundry['tanggal_terima'];
$nominal = $laundry['nominal'];
$catatan = $laundry['catatan'];

$id_user = $laundry['id_user'];

$query = "INSERT INTO tb_transaksi(id_user, tanggal_transaksi, pemasukan, catatan, keterangan)
          VALUES 
          ('$id_user', '$tanggal', '$nominal', '$catatan', 'pemasukan')

  ";

$row = mysqli_query($conn, $query);
if ($row) {
  $query = "UPDATE tb_laundry SET
          status = 'Lunas' WHERE id_laundry = '$id'
      ";

  $row = mysqli_query($conn, $query);
  if ($row) {
    echo "<script>
          alert('Data Berhasil dilunaskan');
          window.location.href ='?page=laundry';
        </script>
  ";
  } else {
    echo "<script>
          alert('Data Gagal dilunaskan')
          window.location.href ='?page=laundry';
        </script>
  ";
  }
}
