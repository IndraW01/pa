<?php

include "prosesPengguna.php";

// Pagination
$jumlahDataPerHalaman = 2;
$jumlahData = count(lihat("SELECT * FROM tb_user"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
if (isset($_GET['halaman'])) {
  $halamanAktif = $_GET['halaman'];
} else {
  $halamanAktif = 1;
}
// halaman 1 awal datanya 0
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$pengguna = lihat("SELECT * FROM tb_user LIMIT $awalData, $jumlahDataPerHalaman");

// searching
if (isset($_POST['cari'])) {
  $keyword = $_POST['keyword'];
  $pengguna = lihat("SELECT * FROM tb_user WHERE 
                      username LIKE '%$keyword%' OR
                      nama_user LIKE '%$keyword%'");
}

?>

<section class="content">
  <div class="row">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pengguna</h3>
      </div>
      <div class="box-body">
        <a href="?page=pengguna&aksi=tambah" class="btn btn-primary" style="margin-bottom: 10px;" style="float: left;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
        <a href="?page=pengguna" class="btn btn-success" style="margin-bottom: 10px;" style="float: left;"><i class="glyphicon glyphicon-refresh"></i></a>

        <form action="" method="POST" style="float: right;">
          <div class="form-group">
            <input type="text" class="form-control" name="keyword" style="width: 70%; display:inline;">
            <button type="submit" class="btn btn-warning" name="cari" style="margin-top: -3px;"><i class="fas fa-search"></i></button>
          </div>
        </form>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Password</th>
              <th>Level</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $awalData + 1 ?>
            <?php foreach ($pengguna as $pgn) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $pgn['username']; ?></td>
                <td><?= $pgn['nama_user']; ?></td>
                <td><?= $pgn['password']; ?></td>
                <td><?= $pgn['level']; ?></td>
                <td>
                  <img src="images/<?= $pgn['foto']; ?>" width="70px">
                </td>
                <td>
                  <a href="?page=pengguna&aksi=ubah&id=<?= $pgn['id_user']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Ubah</a>
                  <a onclick="return confirm('Apakah yakin ingin menghapus?')" href="?page=pengguna&aksi=hapus&id=<?= $pgn['id_user']; ?>" class="btn btn-warning"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <h4 style="float: left;">Jumah Data Pengguna: <?= $jumlahData; ?></h4>
        <!-- pagination -->
        <?php if (!isset($_POST['cari'])) : ?>

          <ul class="pagination" style="float: right;">
            <?php if ($halamanAktif > 1) : ?>
              <li><a href="?page=pengguna&halaman=<?= $halamanAktif - 1; ?>">&laquo;</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <?php if ($halamanAktif == $i) : ?>
                <li class="active"><a href="?page=pengguna&halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php else : ?>
                <li><a href="?page=pengguna&halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
              <li><a href="?page=pengguna&halaman=<?= $halamanAktif + 1; ?>">&raquo;</a></li>
            <?php endif; ?>

          <?php endif; ?>
          </ul>
      </div>
    </div>
  </div>
</section>