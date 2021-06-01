<?php

include "prosesTransaksi.php";

$transaksi = lihat("SELECT * FROM tb_transaksi, tb_user WHERE tb_transaksi.id_user=tb_user.id_user");
// var_dump($transaksi);
// die;

?>
<section class="content">
  <div class="row">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Transaksi</h3>
      </div>
      <div class="box-body">
        <a href="?page=transaksi&aksi=tambah" class="btn btn-primary" style="margin-bottom: 10px;" style="float: left;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Data Pengeluaran</a>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>Tanggal Transaksi</th>
              <th>Keterangan</th>
              <th>Catatan</th>
              <th>Admin/Kasir</th>
              <th>Pemasukan</th>
              <th>Pengeluaran</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($transaksi as $trf) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $trf['tanggal_transaksi']; ?></td>
                <td><?= $trf['keterangan']; ?></td>
                <td><?= $trf['catatan']; ?></td>
                <td><?= $trf['nama_user']; ?></td>
                <td><?php echo number_format($trf['pemasukan']); ?></td>
                <td><?php echo number_format($trf['pengeluaran']); ?></td>

              </tr>
              <?php
              $masuk = 0;
              $pemasukan = $pemasukan + $trf['pemasukan'];
              $masuk += $pemasukan;

              $keluar = 0;
              $pengeluaran = $pengeluaran + $trf['pengeluaran'];
              $keluar += $pengeluaran;
              ?>
            <?php endforeach; ?>

          </tbody>
          <tr>
            <th colspan="5">Total Pemasukan dan pengeluaran</th>
            <td><?= $masuk; ?></td>
            <td><?= $keluar; ?></td>
          </tr>
          <tr>
            <th colspan="5">Total Pemasukan Laundry</th>
            <td><?= $masuk - $keluar; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</section>