<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "koneksi.php";

date_default_timezone_set("Asia/Jakarta");
$jam = date('H') + 1;
$jamSekarang = date($jam . ':i');
if ($jamSekarang > '05:30' && $jamSekarang < '10:00') {
  $salam = 'Pagi';
} elseif ($jamSekarang >= '10:00' && $jamSekarang < '15:00') {
  $salam = 'Siang';
} elseif ($jamSekarang < '18:00') {
  $salam = 'Sore';
} else {
  $salam = 'Malam';
}

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// cek debugging
// var_dump($_SESSION['Admin']);
// var_dump($_SESSION['Kasir']);
// var_dump($_COOKIE['id']);
// var_dump($_COOKIE['key']);

// cek siapa yang login
if ($_SESSION['Admin']) {
  $user = $_SESSION['Admin'];
} elseif ($_SESSION['Kasir']) {
  $user = $_SESSION['Kasir'];
}

$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $user");
$row = mysqli_fetch_assoc($result);

$nama = $row['nama_user'];
$level = $row['level'];
$foto = $row['foto'];
$id_user = $row['id_user'];


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAUNDRY APP</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <style>
    .laundry th {
      text-align: center !important;
    }

    .loader {
      width: 70px;
      position: absolute;
      top: 30px;
      right: 0;
      z-index: 0;
      display: none;
    }

    #keyword {
      position: absolute;
      top: 49px;
      right: 60px;
      width: 200px;
      z-index: 0;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar">
  <div class="wrapper">
    <header class="main-header">
      <a href="" class="logo">
        <span class="logo-mini"><b>A</b>PP</span>
        <span class="logo-lg"><b>Laundry</b>App</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="images/<?= $foto; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs">Hai, <?= $nama; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="images/<?= $foto; ?>" class="img-circle" alt="User Image">
                  <p>
                    Anda Login Sebagai
                    <small><?= $level; ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <?php include 'include/menu.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <?php include 'include/isi.php'; ?>
      </section>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Kelompok 1</b>
      </div>
      <strong>Copyright &copy; By Indra Wijaya.</strong>
    </footer>
  </div>


  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
  <!-- <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script> -->

</body>

</html>