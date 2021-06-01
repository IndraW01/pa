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

  $tanggal_transaksi = htmlspecialchars($data['tanggal_transaksi']);
  $keterangan = htmlspecialchars($data['keterangan']);
  $catatan = htmlspecialchars($data['catatan']);
  $user = htmlspecialchars($data['user']);
  $pengeluaran = htmlspecialchars($data['pengeluaran']);

  $query = "INSERT INTO tb_transaksi (id_user, tanggal_transaksi, pengeluaran, catatan, keterangan)
            VALUES ('$user', '$tanggal_transaksi', '$pengeluaran', '$catatan', '$keterangan')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
