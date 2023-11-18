        <?php 
          // Kondisi menentukan pengguna tertentu yang memiliki akses kepada halaman
          if($_SESSION['level'] != '3') {
            echo "<script>
                alert('Anda tidak punya hak akses ke halaman ini!');
                history.back();
            </script>";
          }

          include_once 'lib/account.php';
          $superAdmin = new superAdmin();

          if(isset($_GET['aksi'])){
            if($_GET['aksi'] == 'edit-data'){
              $idUser = $_GET['id'];
              $getData = $superAdmin->getData($idUser);
          
              if (mysqli_num_rows($getData) == 1) {
                  $data = mysqli_fetch_assoc($getData);
                  $username = $data['username'];
                  $password = $data['password'];
                  $level = $data['level'];
              } else {
                  echo "<script>
                        alert('Data Tidak Ditemukan.');
                        document.location = '?halaman=kelola-akun';
                        </script>";;
              }
            } else if($_GET['aksi'] == 'hapus-data'){
                $idUser = $_GET['id'];
                $hapusStok = $superAdmin->hapusAkun($idUser);
            }
          }

          if(isset ($_POST['submit'])) {
            $superAdmin = new superAdmin();
            if($_GET['aksi'] == 'edit-data'){
              $editAkun = $superAdmin->editAkun($_POST, $_GET['id']);
            } else{
              $tambahAkun = $superAdmin->tambahAkun($_POST);
            }
          }
        ?>
        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="card">
            <div class="card-header">Form Tambah Akun</div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" value="<?=@$username;?>" autocomplete="off" autofocus required/>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="text" class="form-control" name="password" id="password" value="<?=@$password;?>" required/>
                </div>
                <div class="mb-3">
                  <label for="level" class="form-label">Level</label>
                  <select class="form-select" name="level" id="level" value="<?=@$level;?>" required>
                    <option selected disabled>Pilih</option>
                    <option value="1" <?=@ $level == "1" ? 'selected' : '';?>>Apoteker</option>
                    <option value="2" <?=@ $level == "2" ? 'selected' : '';?>>Kepala Apotek</option>
                    <option value="3" <?=@ $level == "3" ? 'selected' : '';?>>Super Admin</option>
                  </select>
                </div>
                <button type="submit" name="submit" value="submit" class="btn primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>