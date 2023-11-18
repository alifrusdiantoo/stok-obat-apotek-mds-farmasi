        <?php 
          include_once 'lib/function.php';
          $stokObj = new stok();

          if (isset($_GET['id'])){
            $idStok = $_GET['id'];
            $getData = $stokObj->getData($idStok);

            $data = mysqli_fetch_assoc($getData);
          }

          // Kondisi untuk mengembalikan stok keluar ke stok masuk
          if(isset($_GET['aksi'])){
            if($_GET['aksi'] == 'batalkan'){
              // Panggil function kembalikan stok keluar
              $stokObj->kembalikanStok($_GET['id']);
            }
          }

          if(isset ($_POST['submit'])){
            $tambahStok = $stokObj->tambahStokKeluar($idStok, $_POST['stok_keluar']);
          }
        
        ?>

        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header">Form Stok Keluar</div>
            <div class="card-body">
              <p>Kode Obat : <?= $data['kodeObat']; ?></p>
              <div class="d-flex flex-coloumn justify-content-start mb-3">
                <div class="flex-fill">
                  <p><strong>Tanggal Masuk</strong></p>
                  <p><?= date("d-m-Y", strtotime($data["tanggalMasuk"])); ?></p>
                  <p><strong>Tanggal Kadaluwarsa</strong></p>
                  <p><?= date("d-m-Y", strtotime($data["tanggalKadaluwarsa"])); ?></p>
                </div>
                <div class="flex-fill">
                  <p><strong>Nama Obat</strong></p>
                  <p><?= $data['namaObat']; ?></p>
                  <p><strong>Jenis Obat</strong></p>
                  <p><?= $data['jenis']; ?></p>
                </div>
                <div class="flex-fill">
                  <p><strong>Jumlah Stok</strong></p>
                  <p><?= $data['stok']; ?></p>
                </div>
              </div>

              <form action="" method="POST">
                <div class="mb-5">
                  <label for="stok_keluar" class="form-label">Jumlah Stok Keluar</label>
                  <input type="number" name="stok_keluar" class="form-control" id="stok_keluar" min="1" max="<?= $data['stok']?>"/>
                  <div class="form-text">Jumlah stok keluar tidak melebihi jumlah stok.</div>
                </div>
                <button type="submit" name="submit" value="simpan" class="btn primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
