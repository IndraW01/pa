<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/<?= $foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info" style="margin-top: 0px;">
        <p>Selamat <?= $salam; ?>, </p>
        <p><?= $nama; ?></p>
      </div>
    </div>

    <ul class="sidebar-menu" style="margin-top: 10px;">
      <li class="header">MENU</li>
      <li><a href="?page="><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <?php if ($_SESSION['Admin']) : ?>
        <li><a href="?page=pengguna"><i class="fa fa-user"></i> Pengguna</a></li>
      <?php endif; ?>
      <li><a href="?page=pelanggan"><i class="fa fa-users"></i> Pelanggan</a></li>
      <li><a href="?page=laundry"><i class="fas fa-money-check-alt"></i>&nbsp; Transaksi Laundry</a></li>
      <li><a href="?page=transaksi"><i class="fa fa-money"></i> Transaksi Pemasukan</a></li>
      <li><a href="?page=about"><i class="fas fa-address-card"></i>&nbsp; About US</a></li>
    </ul>
  </section>
</aside>