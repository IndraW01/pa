<?php

include "prosesLaundry.php";

if (isset($_POST['tambah'])) {
  // cek apakah berhasil ditambahkan

  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href='?page=laundry';
          </script>";
  } else {
    echo "<script>
            alert('Data gagal ditambahkan');
            window.location.href='?page=laundry';
          </script>";
  }
}

?>

<script>
  function namaPaket() {
    let paket = document.getElementById('paket').value;
    if (paket == 1) {
      let jumlah = document.getElementById('jml_kiloan');
      jumlah.addEventListener('keyup', function() {
        let simpan = jumlah.value;
        let total = parseInt(simpan) * 7000;
        if (!isNaN(total)) {
          document.getElementById('total').value = total;
        }
      })
    }
    if (paket == 2) {
      let jumlah = document.getElementById('jml_kiloan');
      jumlah.addEventListener('keyup', function() {
        let simpan = jumlah.value;
        let total = parseInt(simpan) * 5000;
        if (!isNaN(total)) {
          document.getElementById('total').value = total;
        }
      })
    }
    if (paket == 3) {
      let jumlah = document.getElementById('jml_kiloan');
      jumlah.addEventListener('keyup', function() {
        let simpan = jumlah.value;
        let total = parseInt(simpan) * 4000;
        if (!isNaN(total)) {
          document.getElementById('total').value = total;
        }
      })
    }
  }

  // function sum() {
  //   let jumlah = document.getElementById('jml_kiloan').value;
  //   let total = parseInt(jumlah) * 7000;

  //   if (!isNaN(total)) {
  //     document.getElementById('total').value = total;
  //   }
  // }
</script>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Pelanggan</h3>
      </div>
      <form role="form" action="" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label>Pelanggan</label>
            <select class="form-control select2" style="width: 100%;" name="pelanggan">
              <option value="pilih">Pilih Pelanggan</option>

              <?php
              $pelanggan = lihat("SELECT * FROM tb_pelanggan");
              ?>

              <?php foreach ($pelanggan as $plg) : ?>
                <option value="<?= $plg['kode_pelanggan']; ?>"><?= $plg['kode_pelanggan']; ?> | <?= $plg['nama_pelanggan']; ?></option>
              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group">
            <label for="tgl_terima">Tanggal Terima</label>
            <input type="date" class="form-control" name="tgl_terima" id="tgl_terima">
          </div>
          <div class="form-group">
            <label for="tgl_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai">
          </div>
          <div class="form-group">
            <label for="paket">Paket</label>
            <select name="paket" id="paket" class="form-control" onchange="namaPaket()">
              <option value="paket">Pilih Paket</option>
              <?php
              $paket = lihat("SELECT * FROM tb_paket");
              ?>

              <?php foreach ($paket as $pkt) : ?>
                <option value="<?= $pkt['id_paket']; ?>"><?= $pkt['nama_paket']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="jml_kiloan">Jumlah Kiloan</label>
            <input type="number" class="form-control" name="jml_kiloan" id="jml_kiloan">
          </div>
          <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" name="total" id="total" readonly>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control select2" style="width: 100%;" required name="status">
              <option value="">Pilih Status</option>
              <option value="Lunas">Lunas</option>
              <option value="Belum Lunas">Belum Lunas</option>
            </select>
          </div>
          <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" rows="3" name="catatan" id="catatan"></textarea>
          </div>

        </div>
        <div class="box-footer">
          <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
          <a href="?page=laundry" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i>&nbsp;Kembali</a>
        </div>
      </form>
    </div>