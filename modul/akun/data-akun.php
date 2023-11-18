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
          $tampilAkun = $superAdmin->tampilAkun();
        ?>
        <!-- Card Section -->
        <div class="col-10 p-3">
          <div class="d-flex justify-content-evenly">
            <!-- Table Stock Section -->
            <div class="flex-fill card">
              <div class="card-header primary">Data Akun</div>
              <div class="card-body">
                <a href="superadmin.php?halaman=kelola-akun&aksi=tambah-data" class="btn primary mb-3"> Tambah</a>
                <!-- Data Account Table -->
                <table class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Level</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      if (mysqli_num_rows($tampilAkun) == 0):
                    ?>
                        <tr>
                          <td class="text-center" colspan="8">Data Tidak Tersedia</td>
                        </tr>
                    <?php
                      else :
                        foreach ($tampilAkun as $data):
                    ?>
                    <tr>
                      <th scope="col"><?= $i; ?></th>
                      <td><?= $data['username']; ?></td>
                      <td><?= $data['password']; ?></td>
                      <td><?= $data['level']; ?></td>
                      <td>
                        <a href="superadmin.php?halaman=kelola-akun&aksi=edit-data&id=<?= $data['idUser']?>" class="btn btn-sm accent-2" ><i class="bi bi-pencil-square"></i></a>
                        <a href="superadmin.php?halaman=kelola-akun&aksi=hapus-data&id=<?= $data['idUser']?>" class="btn btn-sm accent-1" onclick="return confirm('Yakin untuk hapus data?')"><i class="bi bi-trash"></i></a>
                      </td>
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
