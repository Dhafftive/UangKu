<?php
  // Menghubungkan proses registrasi
  require '../function/adduser_bukukas.php';

  if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
      echo "<script>
        alert('Registrasi berhasil!');
      </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/registration.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
    <!-- splash items -->
    <div class="background">
      <img src="../splash/login.svg" alt="" class="human-work">
      <div class="application">
        <p class="logo">UangKu</p>
        <p class="credit">Manajer keuangan andalanmu</p>
      </div>
    </div>
    <div class="text-regist">
        <h1>Selamat datang!</h1>
        <p>Silahkan registrasi terlebih dahulu sebelum anda masuk ke aplikasi BukuKas. Bantu kami mengenali siapa identitas anda dengan mengisi  beberapa form berikut.</p>
    </div>
    <img src="../splash/leaves1.svg" alt="" class="leaves">

    <!-- Form login -->
    <form action="../function/adduser_bukukas.php" method="POST">
        <input type="text" id="username" name="username" placeholder="Masukkan username anda" required>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama anda" required>
        <input type="password" name="password" id="password" placeholder="Masukkan password anda" required>
        <input type="password" name="confirm" id="confirm" placeholder="Konfirmasi Password anda" required>
        <p class="login-txt">Sudah punya akun? <a href="./login.php">Login</a></p>
        <input type="submit" value="SIGN IN" name="register">
    </form>
</body>
</html>