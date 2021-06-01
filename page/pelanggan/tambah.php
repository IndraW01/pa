<?php

include "prosesPelanggan.php";

$pelanggan = lihat("SELECT * FROM tb_pelanggan ORDER BY kode_pelanggan DESC")[0];
$kodePelanggan = $pelanggan['kode_pelanggan'];

// ambil huruf terakhir di kode pelanggan
$plg = substr($kodePelanggan, 4, 4);
$data = (int) $plg + 1;

// buat kondisi mengurutkan huruf terakhir
if (strlen($data) == 1) {
  $format = "PLG-000" . $data;
} elseif (strlen($data) == 2) {
  $format = "PLG-00" . $data;
} elseif (strlen($data) == 3) {
  $format = "PLG-0" . $data;
} else {
  $format = "PLG-" . $data;
}

// jika tombol tambah ditekan kirim data post ke fungsi tambah
if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href='?page=pelanggan';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href='?page=pelanggan';
          </script>";
  }
}
?>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Pelanggan</h3>
      </div>
      <form role="form" action="" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label for="kode">Kode Pelanggan</label>
            <input type="text" class="form-control" value="<?= $format; ?>" name="kode" id="kode" readonly>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" required></textarea>
          </div>
          <div class="form-group">
            <label for="telpon">No Telpon</label>
            <input type="text" class="form-control" name="telpon" id="telpon" required>
          </div>

        </div>
        <div class="box-footer">
          <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
          <a href="?page=pelanggan" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>