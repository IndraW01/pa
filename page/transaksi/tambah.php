<?php

include "prosesTransaksi.php";

if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href='?page=transaksi';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href='?page=transaksi';
          </script>";
  }
}

?>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Pengeluaran</h3>
      </div>
      <form role="form" action="" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" value="Pengeluaran" readonly>
          </div>
          <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" rows="3" name="catatan" id="catatan"></textarea>
          </div>
          <input type="hidden" class="form-control" name="user" id="user" value="<?= $id_user; ?>">
          <div class="form-group">
            <label for="nama_user">Admin/Kasir</label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" value="<?= $nama; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="pengeluaran">Pengeluaran</label>
            <input type="number" class="form-control" name="pengeluaran" id="pengeluaran">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
          <a href="?page=laundry" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>