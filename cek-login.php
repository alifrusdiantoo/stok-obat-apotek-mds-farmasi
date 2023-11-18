<?php 
  session_start();
  include 'config/koneksi.php';
  $koneksi = new database();


  @$username = mysqli_escape_string($koneksi->koneksi, $_POST['username']);
  @$password = mysqli_escape_string($koneksi->koneksi, $_POST['password']);

  $login = mysqli_query($koneksi->koneksi, "SELECT * FROM user WHERE `username`='$username' AND `password`= '$password' ");
  $data = mysqli_fetch_array($login);

  if($data){
    if($data['level'] == '3')
    {
      $_SESSION['idUser'] = $data['idUser'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['user'] = 'superadmin';
      header('location:superadmin.php');
    }
    else if($data['level'] == '2')
    {
      $_SESSION['idUser'] = $data['idUser'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['user'] = 'kepala-apotek';
      header('location:kepala-apotek.php');
    }
    else if($data['level'] == '1')
    {
      $_SESSION['idUser'] = $data['idUser'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['user'] = 'apoteker';
      header('location:apoteker.php');
    }
    else
    {
      echo "<script>
              alert('Ada masalah pada database');
              document.location='index.php';
            </script>";
    }
  }
  else
  {
      echo "<script>
              alert('Username atau Password Salah!');
              document.location='index.php';
            </script>";
  }

?>