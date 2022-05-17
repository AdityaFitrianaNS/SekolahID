<?php

session_start();
// Jika tidak ada session login, kembalikan user ke halaman login
if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit; 
}

require 'functionAkun.php';

// Mekanisme didalam functions.php
$users = query("SELECT * FROM data_user");

// Tombol search ditekan
if(isset($_POST["cari"])) {
  // $tb_buku akan berisi data hasil pencarian dari function cari. function cari mendapatkan dari apapun yang dicari user.
  $users = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Data Akun</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-info p-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SekolahID </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
                <a class="nav-link mx-1" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="../siswa/dataSiswa.php">Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Guru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1 active text-light" href="tabelAkun.php">Akun</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link mx-1 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Social Media
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Facebook</a></li>
                <li><a class="dropdown-item" href="#">Instagram</a></li>
                <li><a class="dropdown-item" href="#">WhatsApp</a></li>
            </ul>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
            <li class="nav-item">
                <a class="nav-link mx-1" href="logout.php">Logout</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
            </li>
        </ul>
        </div>
    </div>
</nav>
  <br><br>
  <h3 style="text-align: center;">Data Akun SekolahID</h3>
  <br>
  <div class="container-md mt-4 offset-sm-1 col-sm-3">
    <form action="" method="POST" class="d-flex">
      <input class="form-control me-3" type="text" name="keyword" placeholder="Masukkan pencarian" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-primary" type="submit" name="cari">Search</button>
    </form>
  </div>
  <div class="container-md">
    <table class="table table-info table-striped table-bordered border-secondary" style="text-align: center;"> 
        <br>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
          </tr>

      <!-- Membuat Tabel untuk Data -->
      <!-- Membuat variabel i untuk perulangan pemberian angka pada no. yang ada pada tabel -->
      <?php $i = 1; ?>
      <!-- Membuat perulangan untuk array -->
      <?php foreach ($users as $row) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["username"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["TanggalDibuat"]; ?></td>
        <td>
            <a href="hapusAkun.php?id=<?= $row["username"];?>" onclick="return confirm('Yakin hapus data?');">
            <button type="button" class="btn btn-sm btn-primary">Delete</button></a>
        </td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>