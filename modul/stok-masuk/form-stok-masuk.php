        <?php
          include_once 'lib/function.php';
          $stokObj = new stok();

          if(isset($_GET['aksi'])){
            if($_GET['aksi'] == "edit-data"){
              if(isset($_GET['id'])){
                $idStok = $_GET['id'];
                $getData = $stokObj->getData($idStok);

                if (mysqli_num_rows($getData) == 1) {
                    $data = mysqli_fetch_assoc($getData);
                    $kodeObat = strtoupper($data['kodeObat']);
                    $namaObat = ucwords($data['namaObat']);
                    $tanggalMasuk = $data['tanggalMasuk'];
                    $jenis = $data['jenis'];
                    $stok = $data['stok'];
                    $tanggalKadaluwarsa = $data['tanggalKadaluwarsa'];
                } else {
                    echo "<script>alert('Data Tidak Ditemukan.');</script>";;
                }
              }
            } else if($_GET['aksi'] == "hapus-data"){
              if(isset($_GET['id'])){
                  $idStok = $_GET['id'];
                  $hapusStok = $stokObj->hapusStok($idStok);
              }
            }
          }

          // Cek kondisi akan edit data atau tambah data
          if(isset ($_POST['submit'])) {
            if($_GET['aksi'] == 'edit-data'){
              $editStok = $stokObj->editStok($_POST, $idStok);
            } else {
              $tambahStok = $stokObj->tambahStok($_POST);
            }
          }
        ?>
        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header">Form Tambah Stok Masuk</div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                  <input type="date" class="form-control" name="tanggalMasuk" id="tanggalMasuk" value="<?=@$tanggalMasuk;?>" required autofocus />
                </div>
                <div class="mb-3">
                  <label for="kodeObat" class="form-label">Kode Obat</label>
                  <input type="text" class="form-control" name="kodeObat" id="kodeObat" value="<?=@$kodeObat;?>" required autocapitalize="true" style="text-transform: uppercase" />
                </div>
                <div class="mb-3">
                  <label for="namaObat" class="form-label">Nama Obat</label>
                  <input type="text" class="form-control" name="namaObat" id="namaObat" value="<?=@$namaObat;?>" required autocapitalize="true" style="text-transform: capitalize" />
                </div>
                <div class="mb-3">
                  <label for="jenisObat" class="form-label">Jenis Obat</label>
                  <select class="form-select" name="jenisObat" id="jenisObat" value="<?=@$jenis;?>" required>
                    <option disabled>Pilih</option>
                    <option value="Obat Bebas" <?=@ $jenis == "Obat Bebas" ? 'selected' : '';?>>Obat Bebas</option>
                    <option value="Obat Bebas Terbatas" <?=@ $jenis == "Obat Bebas Terbatas" ? 'selected' : '';?>>Obat Bebas Terbatas</option>
                    <option value="Obat Keras" <?=@ $jenis == "Obat Keras" ? 'selected' : '';?>>Obat Keras</option>
                    <option value="Obat Golongan Narkotika" <?=@ $jenis == "Obat Golongan Narkotika" ? 'selected' : '';?>>Obat Golongan Narkotika</option>
                    <option value="Obat Fitofarmaka" <?=@ $jenis == "Obat Fitofarmaka" ? 'selected' : '';?>>Obat Fitofarmaka</option>
                    <option value="Obat Herbal Terstandar (OHT)" <?=@ $jenis == "Obat Herbal Terstandar (OHT)" ? 'selected' : '';?>>Obat Herbal Terstandar (OHT)</option>
                    <option value="Obat Herbal (Jamu)" <?=@ $jenis == "Obat Herbal (Jamu)" ? 'selected' : '';?>>Obat Herbal (Jamu)</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="jmlStok" class="form-label">Jumlah Stok</label>
                  <input type="number" name="jmlStok" class="form-control" id="jmlStok" value="<?=@$stok;?>" required/>
                </div>
                <div class="mb-5">
                  <label for="tglKadaluwarsa" class="form-label">Tanggal Kadaluwarsa</label>
                  <input type="date" name="tglKadaluwarsa" class="form-control" id="tglKadaluwarsa" value="<?=@$tanggalKadaluwarsa;?>" required/>
                </div>
                <button type="submit" name="submit" value="simpan" class="btn primary">Simpan</button>
                <button type="reset" name="reset" value="reset" class="btn accent-1">Reset</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>