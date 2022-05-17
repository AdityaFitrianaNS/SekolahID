<?php

session_start();
// Jika tidak ada session login, kembalikan user ke halaman login
if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit; 
}

require 'functionAkun.php';

// variabel id menampung data untuk mendapatkan key id

$id = $_GET["id"];
// var_dump($id);
if( hapus($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'tabelAkun.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'tabelAkun.php';
        </script>
        ";
}
?>