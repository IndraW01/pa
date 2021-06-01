<?php

include "prosesPengguna.php";

$id = $_GET['id'];
$pengguna = lihat("SELECT * FROM tb_user WHERE id_user = $id")[0];

if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diubah');
            window.location.href='?page=pengguna';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal diubah');
            window.location.href='?page=pengguna';
          </script>";
  }
}

?>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ubah Data Pengguna</h3>
      </div>

      <form role="form" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $pengguna['id_user']; ?>">
        <input type="hidden" name="fotoLama" value="<?= $pengguna['foto']; ?>">
        <div class="box-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= $pengguna['username']; ?>">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $pengguna['nama_user']; ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?= $pengguna['password']; ?>">
          </div>
          <div class="form-group">
            <label for="level">Pilih Level Anda</label>
            <select name="level" id="level" class="form-control">
              <option value="--Pilih Level Anda--">--Pilih Level Anda--</option>
              <?php if ($pengguna['level'] == 'Admin') : ?>
                <option value="Admin" selected>Admin</option>
                <option value="Kasir">Kasir</option>
              <?php elseif ($pengguna['level'] == 'Kasir') : ?>
                <option value="Admin">Admin</option>
                <option value="Kasir" selected>Kasir</option>
              <?php endif; ?>

            </select>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <img src="images/<?= $pengguna['foto']; ?>" width="100" height="100" style="display: block;">
            <input type="file" name="foto">
          </div>


        </div>
        <div class="box-footer">
          <button type="submit" name="ubah" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Ubah</button>
          <a href="?page=pengguna" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>