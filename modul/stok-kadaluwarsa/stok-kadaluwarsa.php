        <?php
          include_once 'lib/function.php';

          $stok = new stok();
          $tampilStok = $stok->tampilStokExp();
        ?>
        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header accent-1">Data Stok Kadaluwarsa</div>
            <div class="card-body">
              <p>Tanggal : <?= date("d-m-Y"); ?></p>
              <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Tanggal Kadaluwarsa</th>
                    <th scope="col">Kode Obat</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jenis Obat</th>
                    <th scope="col">Jumlah Stok</th>
                    <th scope="col" class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 1;
                    if (mysqli_num_rows($tampilStok) == 0):
                  ?>
                      <tr>
                        <td class="text-center" colspan="8">Data Tidak Tersedia</td>
                      </tr>
                  <?php
                    else :
                      foreach ($tampilStok as $data):
                  ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?= date("d-m-Y", strtotime($data["tanggalMasuk"])); ?></td>
                        <td><?= date("d-m-Y", strtotime($data["tanggalKadaluwarsa"])); ?></td>
                        <td><?= $data["kodeObat"]; ?></td>
                        <td><?= $data["namaObat"]; ?></td>
                        <td><?= $data["jenis"]; ?></td>
                        <td><?= $data["stok"]; ?></td>
                        <td class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">
                          <a href="<?= $_SESSION['user']?>.php?halaman=stok-masuk&aksi=hapus-data&id=<?= $data["idStok"]?>" class="btn btn-sm accent-1" role="button" onclick="return confirm('Data yang dihapus akan disimpan di STOK KELUAR. Hapus data ini?')"><i class="bi bi-trash"></i></a>
                        </td>
                      </tr>
                  <?php 
                        $i++;
                      endforeach;
                    endif;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>