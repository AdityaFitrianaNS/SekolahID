<?php

session_start();
// Jika tidak ada session login, kembalikan user ke halaman login
if( !isset($_SESSION["login"])) {
    header("Location: ../akun/login.php");
    exit; 
}

require '../function.php';

// 
$dataSiswa = query("SELECT * FROM data_siswa");

// Tombol search ditekan
if(isset($_POST["cari"])) {
  $dataSiswa = cari($_POST["keyword"]);
}

// Tambah Siswa
if(isset($_POST["submit"])) {
  // Cek apakah data berhasil ditambahkan atau tidak

  if(tambahSiswa($_POST) > 0) {
      echo "
      <script>
          alert('Data Berhasil ditambahkan!');
          document.location.href = 'dataSiswa.php';
      </script>
      ";
  } else {
      echo "
      <script>
          alert('Data Gagal ditambahkan!');
          document.location.href = 'dataSiswa.php';
      </script>
      ";
  }
}

//
$ubahSiswa = query("SELECT * FROM data_siswa")[0];

// cek tombol submit sudah ditekan atau belum
// apakah element yang ada di form menggunakan method post dan menggunakan key submit
if(isset($_POST["submitUbah"])) {
    // cek apakah data berhasil diubah atau tidak
    if(ubahSiswa($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href = 'dataSiswa.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah');
            document.location.href = 'dataSiswa.php';
        </script>
        ";
    }
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
    <title>Data Anggota</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-info p-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SekolahID  </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
                <a class="nav-link mx-1" aria-current="page" href="../index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1 active text-light" href="dataSiswa.php">Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Guru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="../akun/tabelAkun.php">Akun</a>
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
                <a class="nav-link mx-1" href="../akun/logout.php">Logout</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
            </li>
        </ul>
        </div>
    </div>
</nav>
  <br><br>
  <h3 style="text-align: center;">Data Siswa sekolahID</h3>
  <br>
  <div class="container-md mt-4 offset-sm-1 col-sm-3">
    <form action="" method="POST" class="d-flex">
      <input class="form-control me-3" type="text" name="keyword" placeholder="Masukkan pencarian" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-primary" type="submit" name="cari">Search</button>
    </form>
  </div>
  <div class="container-md">
    <table class="table table-info table-striped table-bordered border-secondary" style="text-align: center; vertical-align: middle;"> 
        <br>
        <tr>
          <th>No.</th>
          <th>Foto</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>Tanggal Dibuat</th>
          <th>Angkatan</th>
          <th>Aksi</th>
        </tr>
      <!-- Membuat Tabel untuk Data -->
      <!-- Membuat variabel i untuk perulangan pemberian angka pada no. yang ada pada tabel -->
      <?php $i = 1; ?>
      <!-- Membuat perulangan untuk array -->
      <?php foreach ($dataSiswa as $row) : ?>
      <tr>
        <td><?= $i; ?></td> 
        <td><img width="50" src="../src/img/dataUpload/<?= $row["foto"]; ?> "></td>
        <td><?= $row["nis"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["tanggalLahir"]; ?></td>
        <td><?= $row["alamat"]; ?></td>
        <td><?= $row["tanggalDibuat"]; ?></td>
        <td><?= $row["angkatan"]; ?></td>

        <td>
            <a href="#?nis=<?= $row["nis"];?>">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ubahModal">Ubah</button></a> |
            <a href="hapusSiswa.php?nis=<?= $row["nis"];?>" onclick="return confirm('Yakin hapus data?');">
            <button type="button" class="btn btn-sm btn-primary">Hapus</button></a>
        </td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </table>

    <!-- Tambah Modal Siswa -->
    <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
    <div class="modal fade" id="tambahModal" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa SMAN 1 Gakuen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-2">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto">
              </div>
              <div class="mb-2">
                <label for="nis" class="form-label">NIS Siswa</label>
                <input type="text" class="form-control" name="nis" id="nis" required placeholder="Masukkan NIS Siswa">
              </div>
              <div class="mb-2">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" required placeholder="Masukkan nama">
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required placeholder="Masukkan Tanggal Lahir">
                </div>
                <div class="col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="number" class="form-control" name="angkatan" id="angkatan" placeholder="Masukkan angkatan" required>
                </div>
                </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" required placeholder="Masukkan alamat">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Ubah Modal Siswa -->
    <div class="modal fade" id="ubahModal" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Siswa SMAN 1 Gakuen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-2">
                <!-- Hidden id -->
                <input type="hidden" name="nis" value="<?= $ubahSiswa["nis"]; ?>">
                <input type="hidden" name="fotoLama" value="<?= $ubahSiswa["foto"]; ?>">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Masukkan foto">
              </div>
              <div class="mb-2">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" required placeholder="Masukkan nama Siswa"
                value="<?=$ubahSiswa["nama"];?>">
              </div>
              <div class="row g-3">
              <div class="col-md-6">
                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required placeholder="Masukkan Tanggal Lahir" 
                value="<?=$ubahSiswa["tanggalLahir"];?>">
              </div>
              <div class="col-md-6">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="number" class="form-control" name="angkatan" id="angkatan" placeholder="Masukkan angkatan" required placeholder="Pilih angkatan"
                value="<?=$ubahSiswa["angkatan"];?>">
              </div>
              </div>
              <div class="mb-2">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" required placeholder="Masukkan alamat"
                value="<?=$ubahSiswa["alamat"];?>">
              </div>
                <button type="submit" name="submitUbah" class="btn btn-primary mt-3" style="width: 100px;">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>