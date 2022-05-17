<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: ../index.html");
    exit;
}

require 'functionAkun.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM data_user WHERE username ='$username'");

    if(mysqli_num_rows($result) == 1) {
        
        // Cek password 
        $row = mysqli_fetch_assoc($result);
        // Password yang input oleh user cocok dengan password yang sudah diacak yang ada didalam database
        if ( password_verify($password, $row["password"]) ) {
            // jika berhasil, set session.
            $_SESSION["login"] = true;
            header("Location: ../index.html");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/login.css">
    
    <title>Login Perpustakaan</title>
</head>
<body>
    <section>
        <div class="imgBx">
        <img src="../src/img/buku.png" alt="backgroundForm">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>
                <?php if( isset($error) ) : ?>
                    <p style="color: red; font-style: italic;">Username / Password Salah</p> <br>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="inputBx">
                        <label for="username" class="label">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="inputBx">
                        <label for="password" class="label">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="remember">
                        <label><input type="checkbox" name="">Remember me</label>
                    </div>
                    <div class="inputBx">
						<input type="submit" class="tombol" name="login" value="Login">
                    </div>
                    <div class="inputBx">
                        <p>Don't have an account? <a href="registrasi.php"> Sign up</a></p>
                    </div>
                </form>
                <h3>Login with social media</h3>
                <ul class="sci">
                    <li><a href="https://accounts.google.com/Login"><img src="../src/img/gmail.png" alt=""></li></a>
                    <li><a href="https://m.facebook.com/"><img src="../src/img/fb.png" alt=""></li></a>
                    <li><a href="https://twitter.com/login"><img src="../src/img/twitter.png" alt=""></li></a>                    
                </ul>
            </div>
        </div>
    </section>
</body>
</html>