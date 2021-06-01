<?php

include "koneksi.php";
session_start();


if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // cek apakah id sama dengan yang ada didatabase
  $data = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $id");
  $cek = mysqli_fetch_assoc($data);

  // cek cokie dari username
  if ($key === hash('sha256', $cek['username'])) {
    if ($cek['level'] === 'Admin') {
      $_SESSION['Admin'] = $cek['id_user'];
    } elseif ($cek['level'] === 'Kasir') {
      $_SESSION['Kasir'] = $cek['id_user'];
    }
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  // cek apakah username ada atau tidak
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
  // jika username ada
  if (mysqli_num_rows($result)) {
    // cek password
    $row = mysqli_fetch_assoc($result);
    if ($password === $row['password']) {
      // cek role
      if ($level === $row['level']) {
        if ($level === 'Admin') {
          $_SESSION['Admin'] = $row['id_user'];
          $_SESSION['login'] = true;

          if (isset($_POST['cek'])) {
            setcookie('id', $row['id_user'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
          }

          header("Location: index.php");
          exit;
        } elseif ($level === 'Kasir') {
          $_SESSION['Kasir'] = $row['id_user'];
          $_SESSION['login'] = true;

          if (isset($_POST['cek'])) {
            setcookie('id', $row['id_user'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
          }

          header("Location: index.php");
          exit;
        }
      } else {
        $login = false;
        echo "<script>
              alert('Role Anda Salah');
            </script>
      ";
      }
    } else {
      $login = false;
      echo "<script>
            alert('Password Anda Salah');
          </script>
    ";
    }
  } else {
    echo "<script>
            alert('Username Anda Salah');
          </script>
    ";
  }
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <style>
    body {
      background: url(images/bg1.jpg) !important;
      background-repeat: no-repeat !important;
      background-size: cover !important;
      background-position: center !important;
      object-fit: cover !important;
    }
  </style>

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Laundry</b>APP</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Halaman Login</p>

      <form action="" method="post">
        <?php if (isset($login)) : ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" value="<?= $row['username']; ?>" name="username" placeholder="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        <?php else : ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="username" name="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        <?php endif; ?>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <select name="level" class="form-control">
            <option value="">--Pilih Level--</option>
            <option value="Admin">Admin</option>
            <option value="Kasir">Kasir</option>
          </select>
        </div>
        <div class="form-group" style="margin-left: -21px;">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="cek"> &nbsp;&nbsp;Remember me
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });
    });
  </script>
</body>

</html>