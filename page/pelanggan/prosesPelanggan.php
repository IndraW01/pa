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

  $kode_pelanggan = htmlspecialchars($data['kode']);
  $nama_pelanggan = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $telpon = htmlspecialchars($data['telpon']);

  $query = "INSERT INTO tb_pelanggan (kode_pelanggan, nama_pelanggan, alamat, telpon)
            VALUES ('$kode_pelanggan', '$nama_pelanggan', '$alamat', '$telpon')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM tb_pelanggan WHERE kode_pelanggan = '$id'");
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  global $conn;

  $kode_pelanggan = htmlspecialchars($data['kode']);
  $nama_pelanggan = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $telpon = htmlspecialchars($data['telpon']);

  $query = "UPDATE tb_pelanggan SET
            nama_pelanggan = '$nama_pelanggan',
            alamat = '$alamat',
            telpon = '$telpon'
            WHERE kode_pelanggan = '$kode_pelanggan'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
