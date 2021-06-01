<?php

include "prosesLaundry.php";

// Pagination
$jumlahDataPerHalaman = 3;
$jumlahData = count(lihat("SELECT * FROM tb_laundry"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
if (isset($_GET['halaman'])) {
  $halamanAktif = $_GET['halaman'];
} else {
  $halamanAktif = 1;
}
// halaman 1 awal datanya 0
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// $laundry = lihat("SELECT * FROM tb_laundry, tb_user, tb_pelanggan, tb_paket WHERE tb_laundry.id_user=tb_user.id_user and tb_laundry.id_pelanggan=tb_pelanggan.kode_pelanggan and tb_laundry.id_paket=tb_paket.id_paket LIMIT $awalData, $jumlahDataPerHalaman");
$laundry = lihat("SELECT * FROM tb_laundry
                  JOIN tb_user ON (tb_user.id_user = tb_laundry.id_user)
                  JOIN tb_pelanggan ON (tb_pelanggan.kode_pelanggan = tb_laundry.id_pelanggan)
                  JOIN tb_paket ON (tb_paket.id_paket = tb_laundry.id_paket)
                  LIMIT $awalData, $jumlahDataPerHalaman");

// var_dump($laundry);
// die;

if (isset($_POST['cari'])) {
  $keyword = $_POST['keyword'];
  $laundry = lihat("SELECT * FROM tb_laundry, tb_user, tb_pelanggan WHERE  tb_laundry.id_user=tb_user.id_user and tb_laundry.id_pelanggan=tb_pelanggan.kode_pelanggan and tb_laundry.id_paket=tb_paket.id_paket and nama_pelanggan LIKE '%$keyword%'");
}

?>


<section class="content">
  <div class="row">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Transaksi Laundry</h3>
      </div>
      <div class="box-body">
        <a href="?page=laundry&aksi=tambah" class="btn btn-primary" style="margin-bottom: 10px;" style="float: left;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
        <a href="?page=laundry" class="btn btn-success" style="margin-bottom: 10px;" style="float: left;"><i class="glyphicon glyphicon-refresh"></i></a>

        <form action="" method="POST" style="float: right;">
          <div class="form-group">
            <input type="text" class="form-control" name="keyword" style="width: 70%; display:inline;">
            <button type="submit" class="btn btn-warning" name="cari" style="margin-top: -3px;"><i class="fas fa-search"></i></button>
          </div>
        </form>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr class="laundry">
              <th>No</th>
              <th>Pelanggan</th>
              <th>Tanggal Terima</th>
              <th>Tanggal Selesai</th>
              <th>Paket Laundry</th>
              <th>Harga Perkilo</th>
              <th>Kiloan</th>
              <th>Nominal</th>
              <th>Catatan</th>
              <th>Status</th>
              <th>Admin/Kasir</th>
              <th>Aksi</th>
              <th>Cetak</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $awalData + 1; ?>
            <?php foreach ($laundry as $dry) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $dry['nama_pelanggan']; ?></td>
                <td><?= $dry['tanggal_terima']; ?></td>
                <td><?= $dry['tanggal_selesai']; ?></td>
                <td><?= $dry['nama_paket']; ?></td>
                <td><?= $dry['harga_paket']; ?></td>
                <td><?= $dry['jumlah_kiloan']; ?></td>
                <td><?= $dry['nominal']; ?></td>
                <td><?= $dry['catatan']; ?></td>
                <td><?= $dry['status']; ?></td>
                <td><?= $dry['nama_user']; ?></td>
                <td style="text-align: center;">

                  <?php if ($dry['status'] === "Belum Lunas") : ?>
                    <a href="?page=laundry&aksi=lunas&id=<?= $dry['id_laundry']; ?>" class="btn btn-warning"><i class="fa fa-money"></i> Lunaskan</a>
                    <a onclick="return confirm('Apakah yakin ingin menghapus?')" href="?page=laundry&aksi=hapus&id=<?= $dry['id_laundry']; ?>" class="btn btn-danger disabled"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                  <?php else : ?>
                    <a href="?page=laundry&aksi=lunas&id=<?= $dry['id_laundry']; ?>" class="btn btn-warning disabled"><i class="fa fa-money"></i>&nbsp; Lunaskan</a>
                    <a onclick="return confirm('Apakah yakin ingin menghapus?')" href="?page=laundry&aksi=hapus&id=<?= $dry['id_laundry']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                  <?php endif; ?>

                </td>
                <td style="text-align: center;">

                  <?php if ($dry['status'] === "Belum Lunas") : ?>
                    <a href="cetak.php" class="btn btn-success disabled">Cetak</a>
                  <?php else : ?>
                    <a href="cetak.php?id=<?= $dry['id_laundry']; ?>" class="btn btn-success" target="_blank"><i class="fas fa-print"></i>&nbsp;Cetak</a>
                  <?php endif; ?>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <h4 style="float: left;">Jumah Data Transaksi: <?= $jumlahData; ?></h4>
        <!-- pagination -->
        <?php if (!isset($_POST['cari'])) : ?>

          <ul class="pagination" style="float: right;">
            <?php if ($halamanAktif > 1) : ?>
              <li><a href="?page=laundry&halaman=<?= $halamanAktif - 1; ?>">&laquo;</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <?php if ($halamanAktif == $i) : ?>
                <li class="active"><a href="?page=laundry&halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php else : ?>
                <li><a href="?page=laundry&halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
              <li><a href="?page=laundry&halaman=<?= $halamanAktif + 1; ?>">&raquo;</a></li>
            <?php endif; ?>

          <?php endif; ?>
          </ul>
      </div>
    </div>
  </div>
</section>