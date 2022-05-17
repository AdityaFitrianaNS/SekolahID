<?php

$conn = mysqli_connect("localhost","root","","db_sekolah");
// $conn = mysqli_connect("localhost","id18943432_root","Adit087873414082~","id18943432_db_sekolah");

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function tambahSiswa($dataSiswa) {
    global $conn;

    $nis = htmlspecialchars(stripslashes($dataSiswa["nis"]));
    $namaSiswa = htmlspecialchars(stripslashes($dataSiswa["nama"]));
    $tanggalLahir = htmlspecialchars($dataSiswa["tanggalLahir"]);
    $alamatSiswa = htmlspecialchars(stripslashes($dataSiswa["alamat"]));
    $angkatanSiswa = htmlspecialchars(stripslashes($dataSiswa["angkatan"]));

    $result = mysqli_query($conn, "SELECT nis FROM data_siswa WHERE nis = '$nis'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Siswa sudah terdaftar!');
        </script>";

        // Mengembalikan nilai agar insert gagal
        return false;
    }

    // Upload foto
    $foto = upload();
    if (!$foto) {
        return false;
    }

    // Insert data
    $query = "INSERT INTO data_siswa VALUES('$foto','$nis','$namaSiswa','$tanggalLahir','$alamatSiswa',now(),'$angkatanSiswa')";
    mysqli_query($conn, $query);

    // Mengembalikan nilai
    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    

    // Cek foto di upload atau tidak

    if($error === 4) {
        echo "<script>
        alert('Gagal, foto tidak di upload');
        </script>";
        return false;
    }

    // Cek format yang diupload adalah foto
    $formatFotoValid = ['jpg','jpeg','png'];
    $formatFoto = explode('.', $namaFile);
    $formatFoto = strtolower(end($formatFoto));
    if(!in_array($formatFoto, $formatFotoValid)) {
        echo "<script>
        alert('Pilih format foto jpg/jpeg/png');
        </script>";

    return false;
    }

    // Cek ukuran foto terlalu besar
    $formatFile = [ ' > 1500000 ' ];
    if(in_array($ukuranFile, $formatFile)) {
        echo "<script>
        alert('Ukuran file terlalu besar!');
        </script>";

    return false;
    }
    
    // Lolos pengecekan file, maka akan generate nama pada file.

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $formatFoto;
    move_uploaded_file($tmpName, '../src/img/dataUpload/' . $namaFileBaru);

    return $namaFileBaru;
    
}

function ubahSiswa($dataSiswa) {
    global $conn;

    $nis = $dataSiswa["nis"];
    $namaSiswa = htmlspecialchars(stripslashes($dataSiswa["nama"]));
    $tanggalLahir = htmlspecialchars(stripslashes($dataSiswa["tanggalLahir"]));
    $alamatSiswa = htmlspecialchars(stripslashes($dataSiswa["alamat"]));
    $angkatanSiswa = htmlspecialchars(stripslashes($dataSiswa["angkatan"]));
    $fotoLama = htmlspecialchars($dataSiswa["fotoLama"]);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
        
    }


    $query = "UPDATE data_siswa SET
            foto = '$foto',
            nama = '$namaSiswa',
            tanggalLahir = '$tanggalLahir',
            alamat = '$alamatSiswa',
            angkatan = '$angkatanSiswa'
            WHERE nis = $nis
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($nis) {
    global $conn;
    mysqli_query($conn, "DELETE FROM data_siswa WHERE nis = $nis");

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM data_siswa WHERE
             nis LIKE '%$keyword%' OR
             nama LIKE '%$keyword%' OR
             tanggalLahir LIKE '%keyword%' OR
             alamat LIKE '%$keyword%' OR
             tanggalDibuat LIKE '%$keyword%' OR
             angkatan  LIKE '%keyword%'
             ";
    return query($query);
    
}

?>