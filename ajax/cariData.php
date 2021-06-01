<?php

sleep(1);
$conn = mysqli_connect('localhost', 'root', '', 'laundry');
function lihat($query)
{
  global $conn;

  $data = [];
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  return $data;
}

$keyword = $_GET['keyword'];

$query = "SELECT * FROM tb_pelanggan WHERE nama_pelanggan LIKE '%$keyword%'";

$pelanggan = lihat($query);
$cariPelanggan = count($pelanggan);
if ($cariPelanggan == 0) {
  $cek = false;
}

?>

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
    <?php if (isset($cek)) : ?>
      <tr>
        <td colspan="6" style="text-align: center;">Data Tidak ada</td>
      </tr>
    <?php else : ?>
      <?php $no = 1 ?>
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
<h4 style="float: left;">Jumah Data Pelanggan: <?= $cariPelanggan; ?></h4>