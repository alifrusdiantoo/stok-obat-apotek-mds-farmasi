        <?php
          include_once 'lib/function.php';

          $stok = new stok();
          $tampilStok = $stok->tampilStok();

          if (isset ($_POST['cari'])) {
            $tampilStok = $stok->cariStok($_POST);
          }
        ?>
  

        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header secondary">Data Stok Masuk</div>
            <div class="card-body">
              <a href="<?=@ $_SESSION['user']?>.php?halaman=stok-masuk&aksi=tambah-data" class="btn primary mb-3 <?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>"> Tambah</a>

              <form action="" method="POST" class="mb-3 me-auto">
                <div class="row gx-1">
                  <div class="col-2">
                    <select name="filter" class="form-select">
                      <option value="" selected>Semua</option>
                      <option name="tanggalMasuk" value="tanggalMasuk">Tanggal Masuk</option>
                      <option name="kodeObat" value="kodeObat">Kode Obat</option>
                      <option name="namaObat" value="namaObat">Nama Obat</option>
                      <option name="jenisObat" value="jenis">Jenis Obat</option>
                      <option name="jmlStok" value="stok">Jumlah Stok</option>
                      <option name="tglKadaluwarsa" value="tanggalKadaluwarsa">Tanggal Kadaluwarsa</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <input name="keyword" type="text" class="form-control"placeholder="Tramadol" />
                  </div>
                  <div class="col-1">
                    <button name="cari" type="submit" class="btn secondary"><i class="bi bi-search"></i></button>
                  </div>
                </div>
              </form>

              <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Kode Obat</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jenis Obat</th>
                    <th scope="col">Jumlah Stok</th>
                    <th scope="col">Tanggal Kadaluwarsa</th>
                    <th scope="col" class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Tampil data stok masuk -->
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
                          <td><?= $data["kodeObat"]; ?></td>
                          <td><?= $data["namaObat"]; ?></td>
                          <td><?= $data["jenis"]; ?></td>
                          <td><?= $data["stok"]; ?></td>
                          <td><?= date("d-m-Y", strtotime($data["tanggalKadaluwarsa"])); ?></td>
                          <td class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">
                            <a href="<?=@ $_SESSION['user']?>.php?halaman=stok-masuk&aksi=stok-keluar&id=<?= $data["idStok"]?>" class="btn btn-sm secondary" title="Tambah Stok Keluar"><i class="bi bi-cart-dash"></i></a>
                            <a href="<?=@ $_SESSION['user']?>.php?halaman=stok-masuk&aksi=edit-data&id=<?= $data["idStok"]?>" class="btn btn-sm accent-2" title="Edit Data"><i class="bi bi-pencil-square"></i></a>
                            <a href="<?=@ $_SESSION['user']?>.php?halaman=stok-masuk&aksi=hapus-data&id=<?= $data["idStok"]?>" class="btn btn-sm accent-1" title="Hapus Data" role="button" onclick="return confirm('Data yang dihapus akan disimpan di STOK KELUAR. Hapus data ini?');"><i class="bi bi-trash"></i></a>
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

