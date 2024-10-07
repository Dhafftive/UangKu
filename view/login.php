<?php 
    require '../function/proses-login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BukuKas</title>
    <!-- CSS style-->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <!-- Font -->
    <link rel="stylesheet" href="../css/font.css">
    <style>
        .nama-aplikasi{
            color: #1f1f1f;
        }
    </style>
</head>
<body>
    <!-- splash background -->
    <div class="background-items">
        <div class="rectangle1"></div>
        <div class="rectangle2"></div>
        <div class="rectangle3"></div>
        <img src="../splash/welcome.svg" alt="" class="welcome">
    </div>
    <div class="txt">
        <h1 class="halo">Halooo, selamat datang di aplikasi <span class="nama-aplikasi"> UangKu</span></h1>
        <p class="text-desc">Aplikasi <span>UangKu</span> berguna untukmu sebagai rekan manajemen uangmu, agar kamu tidak perlu susah-susah untuk menuliskan uang pengeluaran dan pemasukanmu dan menghabiskan banyak kertas atau buku. dengan aplikasi ini uangmu akan lebih terstruktur dan efisien, tanpa takut ada kesalahan ketika mencatat dan bisa menghemat lebih banyak buku.</p>
    </div>

    <!-- Form Login -->
    <div class="text-welcome">
        <!-- <h1 class="welcome-back">Haloo,</h1> -->
        <p class="paragraph-login">Silahkan konfirmasi apakah ini benar-benar anda atau bukan, senang rasanya bisa melihat anda kembali.</p>
    </div>
    <form method="POST">
        <label for="username">Username :</label>
        <input placeholder="Masukkan username" id="username" type="text" name="username" required>
        <label for="password">Password :</label>
        <input placeholder="Masukkan password" type="password" id="password" name="password" required>
        <input type="submit" value="Konfirmasi" name="Login">
    </form>

    <!-- Gapunya akun lu bang? masuk kesini ae -->
    <p class="regist-txt">Belum punya akun? <a href="./registration.php">Daftar disini</a></p>
</body>
</html>