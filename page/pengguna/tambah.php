<?php

include "prosesPengguna.php";

if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href='?page=pengguna';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href='?page=pengguna';
          </script>";
  }
}

?>


<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Pengguna</h3>
      </div>
      <form role="form" action="" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="form-group">
            <label for="level">Pilih Level Anda</label>
            <select name="level" id="level" class="form-control">
              <option value="--Pilih Level Anda--">--Pilih Level Anda--</option>
              <option value="Admin">Admin</option>
              <option value="Kasir">Kasir</option>
            </select>
          </div>
          <div class="form-group">
            <label for="foto">Masukkan Gambar</label>
            <input type="file" id="foto" name="foto">
          </div>


        </div>
        <div class="box-footer">
          <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
          <a href="?page=pengguna" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>