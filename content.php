<?php 
  // Kelola konten yang akan ditampilkan

  @$halaman = $_GET['halaman'];

  if($halaman == "stok-obat" || $halaman == "")
  {
    include "modul/data-stok.php";
  }
  else if($halaman == "stok-masuk")
  {
    // Kondisi tampil konten stok masuk berdasarkan aksi
    if(@$_GET['aksi'] == "tambah-data" || @$_GET['aksi'] == "edit-data" || @$_GET['aksi'] == "hapus-data"){
      include "modul/stok-masuk/form-stok-masuk.php";
    } else if(@$_GET['aksi'] == "stok-keluar"){
      include "modul/stok-keluar/form-stok-keluar.php";
    } else{
      include "modul/stok-masuk/stok-masuk.php";
    }
  }
  else if($halaman == "stok-keluar")
  {
    if(@$_GET['aksi'] == "batalkan"){
      include "modul/stok-keluar/form-stok-keluar.php";
    } else {
      include "modul/stok-keluar/stok-keluar.php";
    }
  }
  else if($halaman == "stok-kadaluwarsa")
  {
    include "modul/stok-kadaluwarsa/stok-kadaluwarsa.php";
  }
  else if($halaman == "kelola-akun")
  {
    if(@$_GET['aksi'] == "tambah-data" || @$_GET['aksi'] == "edit-data" || @$_GET['aksi'] == "hapus-data")
    {
      include "modul/akun/form-akun.php";
    } else
    {
      include "modul/akun/data-akun.php";
    }
  } else {
    echo "<script>
            alert ('Halaman tidak tersedia :)');
            history.back();
          </script>";
  }
?>