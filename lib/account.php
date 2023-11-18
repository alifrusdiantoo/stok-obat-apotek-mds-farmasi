<?php
  include_once 'crud.php';
  include_once 'config/koneksi.php';

  class akun {
      protected $username;
      protected $password;
      public $sql;

      public function __construct() {
          $this->sql = new crud();
      }
  }

  class superAdmin extends akun{
    private $level;

    public function tambahAkun($data){
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->level = (int)$data['level'];

        $querry = "INSERT INTO `user` (`idUser`, `username`, `password`, `level`) VALUES ('', '$this->username', '$this->password', '$this->level')";

        $result = $this->sql->insert($querry);
        if ($result) {
            echo "<script>
                  alert('Data Berhasil Ditambahkan.');
                  document.location='?halaman=kelola-akun';
                  </script>";
        } else {
            echo "<script>
                  alert('Data Gagal Disimpan');
                  document.location='?halaman=kelola-akun';
                  </script>";
        }
    }

    public function tampilAkun(){
        $querry = "SELECT * FROM `user`";

        $result = $this->sql->select($querry);
        return $result;
    }

    public function getData($idUser){
      $querry = "SELECT * FROM user WHERE `idUser` = '$idUser'";
      $result = mysqli_query($this->sql->db->koneksi, $querry);

      if ($result) {
          return $result;
      }
    }

    public function editAkun($data, $idUser){
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->level = (int)$data['level'];

        $querry = "UPDATE `user` SET `username` = '$this->username', `password` = '$this->password', `level` = '$this->level' WHERE `idUser` = '$idUser'";
        
        $result = $this->sql->update($querry);
        
        if ($result) {
          echo "<script>
                alert('Data Berhasil Diperbarui.');
                document.location = '?halaman=kelola-akun'
                </script>";
        }else{
          echo "<script>
                alert('Data Berhasil Diperbarui.');
                document.location = '?halaman=kelola-akun'
                </script>";
        }
    }

    public function hapusAkun($idUser){
      $querry = "DELETE FROM user WHERE `idUser` = '$idUser'";

      $result = $this->sql->delete($querry);
      if ($result) {
          echo "<script>
                alert('Data Berhasil Dihapus.');
                document.location = '?halaman=kelola-akun';
                </script>";
      } else{
        echo "<script>
              alert('Data Berhasil Dihapus.');
              document.location = '?halaman=kelola-akun';
              </script>";
      }
    }
  }
?>