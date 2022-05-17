<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="navbar.css"> 
    <link rel="stylesheet" href="src/css/style.css">
    <title>Data Anggota</title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-info p-2 position-absolute top-0 start-0 end-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> SekolahID </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
                <a class="nav-link mx-1 active text-light" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="../sekolahID/siswa/dataSiswa.php">Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="#">Guru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-1" href="../sekolahID/akun/tabelAkun.php">Akun</a>
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
                <a class="nav-link mx-1" href="../sekolahID/akun/logout.php">Logout</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
            </li>
        </ul>
        </div>
    </div>
</nav>

<main class="p-4 p-sm-5 min-vh-100 bg-main d-flex flex-column-reverse flex-md-row align-items-center justify-content-center justify-content-md-between">
    <section>
        <h1 class="d-flex flex-column text-white fw-bold text-capitalize fs-4">
            Selamat datang di sekolahID
            <span class="mt-3 fw-normal text-small"> Kami sekolahID menerima peserta didik baru. </span>
        </h1>

        <p class="text-white text-small"> 
            Sudah mempunyai akun,  
            <span class="text-white"> Jika belum? <a class="text-link" href="./akun/registrasi.php">Daftar sekarang</a> </span> <br>
            <a class="btn btn-info text-capitalize d-inline-block mt-3" href="./akun/login.php" role="button">login disini</a> 
        </p>
    </section>

    <div>
        <img class="img-main" src="./src/img/online-learning.png" alt="Online Learning">
    </div>
</main>

</body>
</html>
