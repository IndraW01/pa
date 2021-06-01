<?php

include "prosesLaundry.php";

$id = $_GET['id'];

if (hapus($id) > 0) {
  echo "<script>
          alert('Data Berhasil dihapus');
          window.location.href ='?page=laundry';
        </script>
    ";
} else {
  echo "<script>
          alert('Data Gagal dihapus');
          window.location.href ='?page=laundry';
        </script>
    ";
}
