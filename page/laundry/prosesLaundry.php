<?php

include "koneksi.php";

function lihat($query)
{
  global $conn;

  $data = [];
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  return $data;
}

function tambah($data)
{
  global $conn;
  global $id_user;

  $id_pelanggan = htmlspecialchars($data['pelanggan']);
  $terima = htmlspecialchars($data['tgl_terima']);
  $selesai = htmlspecialchars($data['tgl_selesai']);
  $kiloan = htmlspecialchars($data['jml_kiloan']);
  $nominal = htmlspecialchars($data['total']);
  $status = htmlspecialchars($data['status']);
  $catatan = htmlspecialchars($data['catatan']);
  $paket = htmlspecialchars($data['paket']);


  // cek apakah pelanggan sudah dipilih
  if ($id_pelanggan === 'pilih') {
    echo "<script>
            alert('Pilih Pelanggan Dahulu');
          </script>";
    return false;
  }

  // jika pembayaran lunas
  if ($status === 'Lunas') {
    $query = "INSERT INTO tb_transaksi(id_user, tanggal_transaksi, pemasukan, catatan, keterangan)
          VALUES 
          ('$id_user', '$terima', '$nominal', '$catatan', 'pemasukan')

  ";
    mysqli_query($conn, $query);
  }

  $query = "INSERT INTO tb_laundry (id_pelanggan, id_user, id_paket, tanggal_terima, tanggal_selesai, jumlah_kiloan, nominal, status, catatan)
            VALUES 
            ('$id_pelanggan', '$id_user', '$paket', '$terima', '$selesai', '$kiloan', '$nominal', '$status', '$catatan')
  
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM tb_laundry WHERE id_laundry = $id");
  return mysqli_affected_rows($conn);
}
