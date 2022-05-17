<?php

// Koneksi ke database dengan variabel $conn
$conn = mysqli_connect("localhost","root","","db_sekolah");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($regist) {
    global $conn;

    $nama = stripslashes($regist["nama"]);
    $email = strtolower($regist["email"]);
    $username = strtolower(stripslashes($regist["username"]));
    $password = mysqli_real_escape_string($conn, $regist["password"]);
    $password2 = mysqli_real_escape_string($conn, $regist["password2"]);

    // Konfirm password
    if ($password !== $password2) {
        echo "<script>
        alert('Password dengan Konfirmasi Password tidak sesuai!');
        </script>";

        // Tidak melanjutkan ekseskusi
        return false; 
    }
    // Username tidak boleh duplikat
    $ResultUsername = mysqli_query($conn, "SELECT username from data_user WHERE username = '$username'");

    if(mysqli_fetch_assoc($ResultUsername)) {
        echo "<script>
        alert('Akun yang dibuat sudah terdaftar');
        </script>";

        // Tidak melanjutkan eksekusi
        return false;
    }

    // Encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO data_user VALUES('$nama','$email','$username','$password',now())");

    return mysqli_affected_rows($conn);

}

function hapus($username) {
    global $conn;
    mysqli_query($conn, "DELETE FROM data_user WHERE username = '$username'");
    return mysqli_affected_rows($conn);
}

function search($keyword) {
    $query = "SELECT * FROM data_user WHERE
            nama LIKE '%$keyword%' OR
            username LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";
    return query($query);
}
?>