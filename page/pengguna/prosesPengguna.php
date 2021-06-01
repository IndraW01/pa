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

  $username = htmlspecialchars($data['username']);
  $nama = htmlspecialchars($data['nama']);
  $password = htmlspecialchars($data['password']);
  $level = htmlspecialchars($data['level']);

  // cek apakah username sama
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
  if (mysqli_num_rows($result)) {
    echo "<script>
            alert('Username Sudah Ada');
          </script>";
    return false;
  }

  // cek apakah level disi
  if ($level == '--Pilih Level Anda--') {
    echo "<script>
            alert('Level wajib diisi');
          </script>";
    return false;
  }

  // cek apakah Foto berhasil diupload
  $foto = upload();
  if (!$foto) {
    return false;
  }

  $query = "INSERT INTO tb_user (username, nama_user, password, level, foto)
            VALUES ('$username', '$nama', '$password', '$level', '$foto')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $nama = $_FILES['foto']['name'];
  $tmpName = $_FILES['foto']['tmp_name'];
  $error = $_FILES['foto']['error'];
  $size = $_FILES['foto']['size'];

  // cek apakah ada gamabar yang diupload
  if ($error === 4) {
    echo "<script>
            alert('Foto wajib diisi');
          </script>";
    return false;
  }

  // cek apakah yang diupload gambar
  $ekstensiFileValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = pathinfo($nama, PATHINFO_EXTENSION);
  $ekstensiGambar = strtolower($ekstensiGambar);

  if (!in_array($ekstensiGambar, $ekstensiFileValid)) {
    echo "<script>
            alert('Ektensi File anda salah');
          </script>";
    return false;
  }

  // cek ukuran gambar
  if ($size > 1000000) {
    echo "<script>
            alert('Ukuran File anda Maks 1MB');
          </script>";
    return false;
  }

  // lolos pengecekan
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.' . $ekstensiGambar;

  move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
  return $namaFileBaru;
}

function hapus($id)
{
  global $conn;

  // $row = mysqli_fetch_assoc($result);
  // unlink("images/" . $row['foto']);
  $root = $_SERVER['DOCUMENT_ROOT'];
  $namaFolder = $root . "/pa/images/";
  $ambilFoto = mysqli_query($conn, "SELECT foto FROM tb_user WHERE id_user = $id");
  while ($foto = mysqli_fetch_assoc($ambilFoto)) {
    $foto_lama = $namaFolder . $foto['foto'];
    unlink($foto_lama);
  }
  mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = $id");
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  global $conn;

  $id = $data['id'];
  $username = htmlspecialchars($data['username']);
  $nama = htmlspecialchars($data['nama']);
  $password = htmlspecialchars($data['password']);
  $level = htmlspecialchars($data['level']);
  $fotoLama = $data['fotoLama'];


  // cek apakah level disi
  if ($level == '--Pilih Level Anda--') {
    echo "<script>
            alert('Level wajib diisi');
          </script>";
    return false;
  }

  // cek apakah foto diubah
  if ($_FILES['foto']['error'] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = upload();
  }

  $query = "UPDATE tb_user SET
            username = '$username',
            nama_user = '$nama',
            password = '$password',
            level = '$level',
            foto = '$foto'
            WHERE id_user = $id";

  $root = $_SERVER['DOCUMENT_ROOT'];
  $namaFolder = $root . "/pa/images/";
  $ambilFoto = mysqli_query($conn, "SELECT foto FROM tb_user WHERE id_user = $id");
  while ($foto = mysqli_fetch_assoc($ambilFoto)) {
    $foto_lama = $namaFolder . $foto['foto'];
    unlink($foto_lama);
  }

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
