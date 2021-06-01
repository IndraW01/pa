<?php

include "prosesPelanggan.php";

// Pagination
// $jumlahDataPerHalaman = 2;
$jumlahData = count(lihat("SELECT * FROM tb_pelanggan"));
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// if (isset($_GET['halaman'])) {
//   $halamanAktif = $_GET['halaman'];
// } else {
//   $halamanAktif = 1;
// }
// // halaman 2 awal datanya 3
// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// $pelanggan = lihat("SELECT * FROM tb_pelanggan LIMIT $awalData, $jumlahDataPerHalaman");
$pelanggan = lihat("SELECT * FROM tb_pelanggan");

// searching

// if (isset($_POST['cari'])) {
//   $keyword = $_POST['keyword'];
//   $pelanggan = lihat("SELECT * FROM tb_pelanggan WHERE nama_pelanggan LIKE '%$keyword%'");
//   $jumlahData = count($pelanggan);

//   if (count($pelanggan) === 0) {
//     $cariPelanggan = false;
//   }
// }

?>

<section class="content">
  <div class="row">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pelanggan</h3>
      </div>
      <div class="box-body">
        <a href="?page=pelanggan&aksi=tambah" class="btn btn-primary" style="margin-bottom: 10px;" style="float: left;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
        <a href="?page=pelanggan" class="btn btn-success" style="margin-bottom: 10px;" style="float: left;"><i class="glyphicon glyphicon-refresh"></i></a>

        <form action="" method="POST" style="float: right;">
          <div class="form-group">
            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="cari username">
            <button type="submit" class="btn btn-warning" name="cari" style="margin-top: -3px;" id="cari"><i class="fas fa-search"></i></button>
            <img src="images/Spinner-1s-200px.gif" alt="loader" class="loader">
          </div>
        </form>

        <div id="container">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pelanggan</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telpon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (isset($cariPelanggan)) : ?>
                <tr>
                  <td colspan="6" style="text-align: center;">Data Tidak ada</td>
                </tr>
              <?php else : ?>
                <?php $no = $awalData + 1 ?>
                <?php foreach ($pelanggan as $plg) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $plg['kode_pelanggan']; ?></td>
                    <td><?= $plg['nama_pelanggan']; ?></td>
                    <td><?= $plg['alamat']; ?></td>
                    <td><?= $plg['telpon']; ?></td>
                    <td>
                      <a href="?page=pelanggan&aksi=ubah&id=<?= $plg['kode_pelanggan']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Ubah</a>
                      <a onclick="return confirm('Apakah yakin ingin menghapus?')" href="?page=pelanggan&aksi=hapus&id=<?= $plg['kode_pelanggan']; ?>" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                    </td>
                  </tr>
                <?php endforeach ?>

              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <h4 style="float: left;" id="jumlah">Jumah Data Pelanggan: <?= $jumlahData; ?></h4>
        <!-- pagination -->
        <!-- <div id="pembungkus">
          <?php if (!isset($_POST['cari'])) : ?>
            <h4 style="float: left;" id="jumlah">Jumah Data Pelanggan: <?= $jumlahData; ?></h4>
            <ul class="pagination" style="float: right;">
              <?php if ($halamanAktif > 1) : ?>
                <li class="page"><a href="?page=pelanggan&halaman=<?= $halamanAktif - 1; ?>">&laquo;</a></li>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($halamanAktif == $i) : ?>
                  <li class="active page"><a href="?page=pelanggan&halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php else : ?>
                  <li class="page"><a href="?page=pelanggan&halaman=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endif; ?>
              <?php endfor; ?>

              <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page"><a href="?page=pelanggan&halaman=<?= $halamanAktif + 1; ?>">&raquo;</a></li>
              <?php endif; ?>

            <?php else : ?>
              <h4 style="float: left;">Jumah Data Pelanggan: <?= $jumlahData; ?></h4>
            <?php endif; ?>
            </ul>
        </div> -->
      </div>
    </div>
  </div>
</section>