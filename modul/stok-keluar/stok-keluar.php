        <?php
          include_once 'lib/function.php';

          $stok = new stok();
          $tampilStok = $stok->tampilStokKeluar();

          if (isset ($_POST['cari'])) {
            $tampilStok = $stok->cariStokKeluar($_POST);
          }
        ?>
        
        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header accent-2">Data Stok Keluar</div>
            <div class="card-body">
              <form action="" method="POST" class="mb-3 me-auto">
                <div class="row gx-1">
                  <div class="col-2">
                    <select class="form-select" name="filter">
                      <option value="" selected>Semua</option>
                      <option value="tglMasuk">Tanggal Masuk</option>
                      <option value="tglKeluar">Tanggal Keluar</option>
                      <option value="kodeObat">Kode Obat</option>
                      <option value="namaObat">Nama Obat</option>
                      <option value="jenisObat">Jenis Obat</option>
                      <option value="stokKeluar">Stok Keluar</option>
                      <option value="tglKadaluwarsa">Tanggal Kadaluwarsa</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <input type="text" class="form-control" name="keyword" placeholder="Tramadol" />
                  </div>
                  <div class="col-1">
                    <button type="submit" class="btn secondary" name="cari"><i class="bi bi-search"></i></button>
                  </div>
                </div>
              </form>

              <table class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Tanggal Keluar</th>
                    <th scope="col">Kode Obat</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jenis Obat</th>
                    <th scope="col">Stok Keluar</th>
                    <th scope="col">Tanggal Kadaluwarsa</th>
                    <th scope="col" class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Tampil data stok keluar -->
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
                          <td><?= $i; ?></td>
                          <td><?= date("d-m-Y", strtotime($data["tglMasuk"])); ?></td>
                          <td><?= date("d-m-Y", strtotime($data["tglKeluar"])); ?></td>
                          <td><?= $data['kodeObat']; ?></td>
                          <td><?= $data['namaObat']; ?></td>
                          <td><?= $data['jenisObat']; ?></td>
                          <td><?= $data['stokKeluar']; ?></td>
                          <td><?= date("d-m-Y", strtotime($data["tglKadaluwarsa"])); ?></td>
                          <td class="<?= $_SESSION['level'] == '2' ? 'd-none' : '' ?>">
                            <a href="<?=@ $_SESSION['user']?>.php?halaman=stok-keluar&aksi=batalkan&id=<?= $data["idStok"]?>" class="btn btn-sm primary" title="Kembalikan Data ke Stok Masuk" role="button" onclick="return confirm('Stok Keluar akan dikembalikan ke Stok Masuk. Lanjutkan?')"><i class="bi bi-arrow-counterclockwise"></i></a>
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