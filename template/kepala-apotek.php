<?php
    session_start();
    //mengatasi jika user langsung masuk menggunakan link tanpa login
    if(empty($_SESSION['idUser']) or empty($_SESSION['username'])) {
        echo "<script>
            alert('Login Terlebih Dahulu !');
            document.location='index.php';
        </script>";
    }

    // Kondisi menentukan pengguna tertentu yang memiliki akses kepada halaman
    if($_SESSION['level'] != '2') {
      echo "<script>
          alert('Anda tidak punya hak akses ke halaman ini!');
          history.back();
      </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="img/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
    <link rel="manifest" href="img/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />

    <title>MDS Farmasi</title>

    <style>
      @media print {
        .navbar {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row g-0">
        <div class="col-2">
          <!-- Side Bar -->
          <div class="navbar navbar-expand sticky-top sidebar d-flex flex-column align-items-stretch w-100">
            <a class="navbar-brand p-3" href="admin.php?halaman=stok-obat">
              <img src="img/logo.png" alt="mds logo" width="30" height="30" class="d-inline-block align-text-bottom" />
              <b class="text-light">MDS Farmasi</b>
            </a>

            <hr />

            <ul class="navbar-nav flex-column mb-auto w-100">
              <li class="nav-item mt-2">
                <a href="?halaman=stok-obat" class="nav-link text-light <?=@ $_GET['halaman'] == 'stok-obat'? 'active-link': '' ?>">
                  <i class="bi bi-speedometer"></i>
                  Stok Obat
                </a>
              </li>
              <li class="nav-item ps-2 sub-menu <?=@ $_GET['halaman'] == 'stok-masuk'? 'active-link': '' ?>">
                <a href="?halaman=stok-masuk" class="nav-link text-light">
                  <i class="bi bi-box-arrow-in-down"></i>
                  Stok Masuk
                </a>
              </li>
              <li class="nav-item ps-2 sub-menu <?=@ $_GET['halaman'] == 'stok-keluar'? 'active-link': '' ?>">
                <a href="?halaman=stok-keluar" class="nav-link text-light">
                  <i class="bi bi-box-arrow-up"></i>
                  Stok Keluar
                </a>
              </li>
              <li class="nav-item mt-2">
                <a href="?halaman=stok-kadaluwarsa" class="nav-link text-light <?=@ $_GET['halaman'] == 'stok-kadaluwarsa'? 'active-link': '' ?>">
                  <i class="bi bi-calendar-x"></i>
                  Stok Kadaluwarsa
                </a>
              </li>
            </ul>

            <hr />
            <div class="d-flex p-3 w-100 align-items-center">
              <img src="img/avatar-keptek.png" alt="" width="32" height="32" class="rounded-circle me-2" />
              <p class="text-white">Kepala Apotek</p>
              <a href="logout.php" class="btn btn-sm accent-1 ms-auto">
                <i class="bi bi-box-arrow-left"></i>
              </a>
            </div>
          </div>
          <!-- End Side Bar -->
        </div>