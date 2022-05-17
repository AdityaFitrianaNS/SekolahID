<?php

session_start();
// Jika tidak ada session login, kembalikan user ke halaman login
if( !isset($_SESSION["login"])) {
    header("Location: ../akun/login.php");
    exit; 
}

require '../function.php';

// variabel nis menampung data untuk mendapatkan key nis

$nis = $_GET["nis"];
// var_dump($nis);
if( hapus($nis) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'dataSiswa.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'dataSiswa.php';
        </script>
        ";
}
?>