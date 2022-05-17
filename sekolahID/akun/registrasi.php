<?php

require 'functionAkun.php';

// Jika tombol sign up ditekan maka akan menjalankan function registrasi
if( isset($_POST["regist"]) ) {

    // Jika registrasi lebih dari 0 ada user baru yang berhasil masuk ke database
    if( registrasi($_POST) > 0 ) {
        echo "<script>
        confirm('Akun berhasil didaftar, ingin kembali login?');
        document.location.href = 'login.php';
        </script>";
    } else {
        // Jika gagal, maka menampilkan pesan error variabel $connection
        echo mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registrasi</title>
</head>
<body>
    <br>
    <div class="card mt-5 offset-sm-4 col-sm-4">
        <h5 class="card-header text-center"style="background-color: rgb(74, 168, 255);">Registrasi Akun</h5>
        <div class="card-body">
        <!-- Form Add Data -->
        <div class="container-sm">
            <!-- Form action dikosongkan karena agar memproses dihalaman yang sama -->
            <!-- action untuk menentukan akan dikirim kemana data yang nantinya didalam form -->
            <!-- action dikosongkan karena data akan dikirim kehalaman ini -->
            <!-- post agar data yang dikirim tidak ada di URL -->
            <form action="" method="POST">
                <div class="mb-2">
                    <!-- name dan id harus sesuai dengan for pada label -->
                    <!-- menggunakan required agar form terisi dan tidak bisa disubmit jika kosong -->
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama" required>
                    <div id="emailHelp" class="form-text">We'll never share your name.</div>
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="row g-3">
                <div class="col-md-6">
                    <label for="password" class="form-label" >Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                </div>
                <div class="col-md-6">
                    <label for="password2" class="form-label">Konfirm Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukkan ulang" required>
                </div>
                </div>
                <button type="submit" name="regist" class="btn btn-primary mt-3" style="width: 100px;">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>