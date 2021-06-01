<?php

include "prosesPelanggan.php";

$id = $_GET['id'];
$pelanggan = lihat("SELECT * FROM tb_pelanggan WHERE kode_pelanggan = '$id'")[0];

// jika tombol ubah ditekan kirim data post ke fungsi ubah
if (isset($_POST['ubah'])) {
  if (ubah($_POST) >= 0) {
    echo "<script>
            alert('Data berhasil diubah');
            window.location.href='?page=pelanggan';
          </script>";
  } else {
    echo "<script>
            alert('Data Belum diubah');
            window.location.href='?page=pelanggan';
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
      <form role="form" action="" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label for="kode">Kode Pelanggan</label>
            <input type="text" class="form-control" name="kode" id="kode" value="<?= $pelanggan['kode_pelanggan']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $pelanggan['nama_pelanggan']; ?>">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat"><?= $pelanggan['alamat']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="telpon">No Telpon</label>
            <input type="text" class="form-control" name="telpon" id="telpon" value="<?= $pelanggan['telpon']; ?>">
          </div>

        </div>
        <div class="box-footer">
          <button type="submit" name="ubah" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Ubah</button>
          <a href="?page=pelanggan" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>