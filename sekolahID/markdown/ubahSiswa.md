<?php

session_start();
// Jika tidak ada session login, kembalikan user ke halaman login
if( !isset($_SESSION["login"])) {
    header("Location: ../akun/login.php");
    exit; 
}

require '../function.php';
// Mengambil data di URL
$nis = $_GET["nis"];

// id digunakan untuk mengambil data ubahSiswa
// query data ubahSiswa berdasarkan id
// Memanggil function query pada functions.php
// [0] adalah array $rows pada functions.php
// [0] diberi pada akhir agar dimulai mengambil data dari index 0
$ubahSiswa = query("SELECT * FROM data_siswa WHERE nis = $nis")[0];

// cek tombol submit sudah ditekan atau belum
// apakah element yang ada di form menggunakan method post dan menggunakan key submit
if(isset($_POST["submit"])) {
    var_dump($_POST);
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
        </script>
        ";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ubah ubahSiswa</title>
  </head>
<body>
    <!-- Navbar -->
    <div class="card mt-5 offset-sm-4 col-sm-4">
        <h5 class="card-header text-center"style="background-color: rgb(74, 168, 255);">Ubah Anggota PerpustakaanID</h5>
        <div class="card-body">
        <!-- Form Add Data -->
        <div class="container-sm">
            <!-- action untuk menentukan akan dikirim kemana data yang nantinya didalam form -->
            <!-- action dikosongkan karena data akan dikirim kehalaman ini -->
            <!-- post agar data yang dikirim tidak ada di URL -->
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
                <button type="submit" name="submit" class="btn btn-primary mt-3" style="width: 100px;">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
 </body>
</html>

