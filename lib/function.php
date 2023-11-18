<?php
include_once 'lib/crud.php';

class stok {
    public $kodeObat;
    public $namaObat;
    public $tanggalMasuk;
    public $jenis;
    public $stok;
    public $tanggalKadaluwarsa;
    public $sql;

    public function __construct() {
        $this->sql = new crud();
    }

    public function hitungJmlStok(){
        $query = "SELECT (SUM(stok_masuk.stok) + SUM(stok_keluar.stokKeluar)) FROM stok_masuk, stok_keluar";
        $result = $this->sql->select($query);

        return $result;
    }

    public function hitungStokMasuk(){
        $query = "SELECT SUM(stok) FROM stok_masuk";
        $result = $this->sql->select($query);

        return $result;
    }

    public function hitungStokKeluar(){
        $query = "SELECT SUM(stokKeluar) FROM stok_keluar";
        $result = $this->sql->select($query);

        return $result;
    }

    public function hitungStokExp(){
        $query = "SELECT SUM(stok) FROM stok_masuk WHERE (tanggalKadaluwarsa < CURRENT_DATE)";
        $result = $this->sql->select($query);

        return $result;
    }

    public function tampilDataStok(){
        $query = "SELECT kodeObat, namaObat, jenis, SUM(stok) AS jmlStok FROM stok_masuk GROUP BY namaObat ORDER BY kodeObat ASC";
        $result = $this->sql->select($query);

        return $result;
    }

    public function cariDataStok($dataCari){
        $filter = $dataCari['filter'];
        $keyword = $dataCari['keyword'];
        if($keyword != '' && $filter != ''){
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT kodeObat, namaObat, jenis, SUM(stok) AS jmlStok FROM stok_masuk 
            WHERE $filter LIKE '%$keyword%'
            GROUP BY namaObat
            ORDER BY kodeObat ASC
            ");
        } elseif($keyword != '') {
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT kodeObat, namaObat, jenis, SUM(stok) AS jmlStok FROM stok_masuk
            WHERE kodeObat LIKE '%$keyword%'
            OR namaObat LIKE '%$keyword%'
            OR jenis LIKE '%$keyword%'
            GROUP BY namaObat
            ORDER BY kodeObat ASC
            ");

        } else {
            $tampil = mysqli_query($this->sql->db->koneksi, "SELECT kodeObat, namaObat, jenis, SUM(stok) AS jmlStok FROM stok_masuk GROUP BY namaObat ORDER BY kodeObat ASC");
        }
        return $tampil;
    }

    public function tambahStok($data) {
        $this->kodeObat = strtoupper($data['kodeObat']);
        $this->namaObat = ucwords($data['namaObat']);
        $this->tanggalMasuk = $data['tanggalMasuk'];
        $this->jenis = $data['jenisObat'];
        $this->stok = $data['jmlStok'];
        $this->tanggalKadaluwarsa = $data['tglKadaluwarsa'];

        $querry = "INSERT INTO `stok_masuk` (`idStok`, `kodeObat`,`namaObat`, `tanggalMasuk`, `jenis`, `stok`, `tanggalKadaluwarsa`) VALUES ('', '$this->kodeObat','$this->namaObat', '$this->tanggalMasuk', '$this->jenis', '$this->stok', '$this->tanggalKadaluwarsa')";

        $result = $this->sql->insert($querry);
        if ($result) {
            echo "<script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location='?halaman=stok-masuk';
                  </script>";
        }
    }

    public function tampilStok(){
        $querry = "SELECT * FROM `stok_masuk`";
        $result = $this->sql->select($querry);

        return $result;
    }

    public function editStok($data, $idStok){
        $this->kodeObat = strtoupper($data['kodeObat']);
        $this->namaObat = ucwords($data['namaObat']);
        $this->tanggalMasuk = $data['tanggalMasuk'];
        $this->jenis = $data['jenisObat'];
        $this->stok = $data['jmlStok'];
        $this->tanggalKadaluwarsa = $data['tglKadaluwarsa'];

        $querry = "UPDATE `stok_masuk` SET `kodeObat` = '$this->kodeObat', `namaObat` = '$this->namaObat', `tanggalMasuk` = '$this->tanggalMasuk', `jenis` = '$this->jenis', `stok` = '$this->stok', `tanggalKadaluwarsa` = '$this->tanggalKadaluwarsa' WHERE `idStok` = '$idStok'";
        
        $result = $this->sql->update($querry);
        
        if ($result) {
            echo "<script>
            alert('Data Berhasil Diperbarui.');
            document.location = '?halaman=stok-masuk';
            </script>";
        }else{
            echo "<script>alert('Gagal memperbarui data');</script>";
        }
    }

    public function getData($idStok){
        $querry = "SELECT * FROM stok_masuk WHERE `idStok` = '$idStok'";
        $result = mysqli_query($this->sql->db->koneksi, $querry);

        if ($result) {
            return $result;
        }
    }

    public function getDataKeluar($idStok){
        $querry = "SELECT * FROM stok_keluar WHERE `idStok` = '$idStok'";
        $result = mysqli_query($this->sql->db->koneksi, $querry);

        if ($result) {
            return $result;
        }
    }

    public function hapusStok($idStok){
        $querry = "DELETE FROM stok_masuk WHERE `idStok` = '$idStok'";

        $result = $this->sql->delete($querry);
        if ($result) {
            echo "<script>
                    alert('Data Berhasil Dihapus.');
                    document.location = '?halaman=stok-masuk';
                  </script>";
        }
    }

    public function cariStok($dataCari){
        $filter = $dataCari['filter'];
        $keyword = $dataCari['keyword'];
        if($keyword != '' && $filter != ''){
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_masuk 
            WHERE $filter LIKE '%$keyword%'
            ");
        } elseif($keyword != '') {
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_masuk
            WHERE kodeObat LIKE '%$keyword%'
            OR namaObat LIKE '%$keyword%'
            OR tanggalMasuk LIKE '%$keyword%'
            OR jenis LIKE '%$keyword%'
            OR stok LIKE '%$keyword%'
            OR tanggalKadaluwarsa LIKE '%$keyword%'
            ");

        } else {
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_masuk");
        }
        return $tampil;
    }

    public function tampilStokKeluar(){
        $querry = "SELECT * FROM `stok_keluar`";
        $result = $this->sql->select($querry);
  
        return $result;
    }

    public function cariStokKeluar($dataCari){
        $filter = $dataCari['filter'];
        $keyword = $dataCari['keyword'];
        if($keyword != '' && $filter != ''){
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_keluar 
            WHERE $filter LIKE '%$keyword%'
            ");
        } elseif($keyword != '') {
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_keluar
            WHERE tglMasuk LIKE '%$keyword%'
            OR tglKeluar LIKE '%$keyword%'
            OR kodeObat LIKE '%$keyword%'
            OR namaObat LIKE '%$keyword%'
            OR jenisObat LIKE '%$keyword%'
            OR stokKeluar LIKE '%$keyword%'
            OR tglKadaluwarsa LIKE '%$keyword%'
            ");

        } else {
            $tampil = mysqli_query($this->sql->db->koneksi, " SELECT * FROM stok_keluar");
        }
        return $tampil;
    }

    public function tambahStokKeluar($id, $jml){
        // Ambil data berdasarkan id stok masuk
        $query = mysqli_query($this->sql->db->koneksi, "SELECT * FROM stok_masuk WHERE `idStok` = '$id'");
        $data = mysqli_fetch_array($query);

        // Set zona waktu untuk tanggal keluar
        date_default_timezone_set("Asia/Jakarta");
        
        // Inisialisasi data untuk input value
        $idStokMasuk = $data['idStok'];
        $tglMasuk = $data['tanggalMasuk'];
        $tglKeluar = date("Y-m-d");
        $kodeObat = $data['kodeObat'];
        $namaObat = $data['namaObat'];
        $jenisObat = $data['jenis'];
        $stokKeluar = $jml;
        $sisaStok = $data['stok'] - $jml;
        $tglKadaluwarsa = $data['tanggalKadaluwarsa'];

        // Kondisi stok masuk
        if($stokKeluar == $data['stok']){
            // Jika stok keluar = stok masuk, maka hapus data stok masuk
            $queryDelete = "DELETE FROM stok_masuk WHERE idStok=$id";
            $result = $this->sql->delete($queryDelete);
        } else {
            // Kueri untuk menambahkan data
            $query = "INSERT INTO stok_keluar VALUES ('', '$idStokMasuk', '$tglMasuk', '$tglKeluar', '$kodeObat', '$namaObat', '$jenisObat', '$stokKeluar', '$tglKadaluwarsa')";
            $result = $this->sql->insert($query);

            // Kueri untuk memperbarui stok masuk setelah dikeluarkan
            $queryUpdate = "UPDATE stok_masuk SET stok = $sisaStok WHERE idStok = $id";
            $result = $this->sql->update($queryUpdate);
        }

        if ($result) {
            echo "<script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location='?halaman=stok-keluar';
                </script>";
        }
    }

    public function kembalikanStok($idStokKeluar){
        // Ambil data berdasarkan id stok masuk
        $getData = $this->getDataKeluar($idStokKeluar);
        $data = mysqli_fetch_array($getData);

        // Set zona waktu untuk tanggal masuk
        date_default_timezone_set("Asia/Jakarta");

        // Ambil data yang diperlukan
        $kodeObat = $data['kodeObat'];
        $namaObat = $data['namaObat'];
        $tanggalMasuk = date("Y-m-d");
        $jenis = $data['jenisObat'];
        $stok = $data['stokKeluar'];
        $tanggalKadaluwarsa = $data['tglKadaluwarsa'];

        // Buat data baru pada stok masuk
        $queryKembalikan = "INSERT INTO stok_masuk VALUES ('', '$kodeObat', '$namaObat', '$tanggalMasuk', '$jenis', '$stok', '$tanggalKadaluwarsa')";
        $result = $this->sql->insert($queryKembalikan);

        if ($result) {
            // Jika tambah data pada stok masuk berhasil, hapus data pada stok keluar
            $hapusStok = "DELETE FROM stok_keluar WHERE idStok = $idStokKeluar";
            $this->sql->delete($hapusStok);
            echo "<script>
                    alert('Data Berhasil Dikembalikan!');
                    document.location='?halaman=stok-masuk';
                </script>";
        }

    }

    public function tampilStokExp(){
        $query = "SELECT * FROM stok_masuk WHERE (tanggalKadaluwarsa < CURRENT_DATE)";
        $result = $this->sql->select($query);

        return $result;
    }
  }

?>