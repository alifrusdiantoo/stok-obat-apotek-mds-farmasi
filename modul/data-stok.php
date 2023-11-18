        <style>
          @media print {
            .col-2 {
              display: none;
            }

            form{
              display: none;
            }

            #print {
              visibility: visible;
              width: 100vw;
              position: absolute;
              left: 0;
              top: 0;
            }
          }
        </style>
        
        <?php 
          include_once 'lib/function.php';

          $stok = new stok();

          $jmlStok = mysqli_fetch_row($stok->hitungJmlStok());
          $jmlStokMasuk = mysqli_fetch_row($stok->hitungStokMasuk());
          $jmlStokKeluar = mysqli_fetch_row($stok->hitungStokKeluar());
          $jmlStokExp = mysqli_fetch_row($stok->hitungStokExp());
          $tampilStok = $stok->tampilDataStok();

          if (isset ($_POST['cari'])) {
            $tampilStok = $stok->cariDataStok($_POST);
          }
        ?>
        
        <!-- Card Section -->
        <div class="col-10 p-3">
          <section>
            <div class="d-flex justify-content-between">
              <div class="">
                <div class="card primary" style="width: 15rem">
                  <div class="card-header">Jumlah Stok</div>
                  <div class="card-body">
                    <h5 class="card-title"><?= $jmlStok[0]; ?></h5>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="card secondary" style="width: 15rem">
                  <div class="card-header">Stok Masuk</div>
                  <div class="card-body">
                    <h5 class="card-title"><?= $jmlStokMasuk[0]; ?></h5>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="card accent-2" style="width: 15rem">
                  <div class="card-header">Stok Keluar</div>
                  <div class="card-body">
                    <h5 class="card-title"><?= $jmlStokKeluar[0]; ?></h5>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="card accent-1" style="width: 15rem">
                  <div class="card-header">Stok Kadaluwarsa</div>
                  <div class="card-body">
                    <h5 class="card-title"><?= $jmlStokExp[0]; ?></h5>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- End Card Section -->

          <div class="d-flex justify-content-evenly mt-3">
            <!-- Table Stock Section -->
            <div class="flex-fill card" id="print">
              <div class="card-header primary">Stok Obat</div>
              <div class="card-body">
                <form action="" method="POST" class="mb-3 me-auto">
                  <div class="row gx-1">
                    <div class="col-2">
                      <select class="form-select" name="filter">
                        <option value="" selected>Semua</option>
                        <option value="kodeObat">Kode Obat</option>
                        <option value="namaObat">Nama Obat</option>
                        <option value="jenis">Jenis Obat</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" name="keyword" placeholder="Tramadol" />
                    </div>
                    <div class="col-1">
                      <button type="submit" class="btn secondary" name="cari"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="col-1 ms-auto">
                          <button type="submit" class="btn primary" onclick="window.print()"><i class="bi bi-printer-fill"></i> Print</button>
                    </div>
                  </div>
                </form>
                <!-- Stock Table -->
                <table class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Kode Obat</th>
                      <th scope="col">Nama Obat</th>
                      <th scope="col">Jenis Obat</th>
                      <th scope="col">Jumlah Stok</th>
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
                          <td><?= $i; ?></td>
                          <td><?= $data['kodeObat']; ?></td>
                          <td><?= $data['namaObat']; ?></td>
                          <td><?= $data['jenis']; ?></td>
                          <td><?= $data['jmlStok']; ?></td>
                        </tr>
                    <?php 
                          $i++;
                        endforeach;
                      endif;
                    ?>
                  </tbody>
                </table>
                <!-- End Stock Table -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
