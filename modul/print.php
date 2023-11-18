<?php
include_once '../lib/stok.php';

$stok = new stok();
$tampilStok = $stok->tampilStok();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Print Stok Obat</title>
  </head>
  <body>
    <b>Tanggal Cetak: <?= date("j F Y ");?></b>
    <h2>Laporan Stok Obat</h2>
    <h2>MDS Farmasi</h2>
    <div>
      <table style="width: 770px;" cellpadding="10" cellspacing="0" border="1">
        <tr>
            <th>No.</th>
            <th>Tanggal Masuk</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Jenis Obat</th>
            <th>Tanggal Kadaluwarsa</th>
            <th>Jumlah Stok</th>
        </tr>

        <!-- Tampilkan Data pada tabel dengan pengulangan dan pengkondisian -->
        <?php $i = 1; ?>
        <?php if (!empty($tampilStok)): ?>
            <?php foreach ($tampilStok as $data): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?= date("d-m-Y", strtotime($data["tanggalMasuk"])); ?></td>
                    <td><?= $data["kodeObat"]; ?></td>
                    <td><?= $data["namaObat"]; ?></td>
                    <td><?= $data["jenis"]; ?></td>
                    <td><?= date("d-m-Y", strtotime($data["tanggalKadaluwarsa"])); ?></td>
                    <td><?= $data["stok"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Stok Obat Masih Kosong.</td>
            </tr>
        <?php endif; ?>
      </table>
    </div>
  </body>
</html>
