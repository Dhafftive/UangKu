<?php
    // Menghubungkan ke database
    $host = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "db_bukukas";
    $conn = mysqli_connect($host, $username, $password, $database);
    
    // Mengecek koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Memanggil fungsi registrasi setelah deklarasi fungsi
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Panggil fungsi registrasi
        $result = registrasi($conn, $_POST);
        if ($result) {
            header("Location: ../view/login.php");
            echo "<script>
                alert('Registrasi berhasil!');
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Registrasi gagal');
            </script>";
        }
    }

    // Struktur fungsi registrasi
    function registrasi($conn, $data) {
        $username = strtolower(stripslashes($data["username"]));
        $namauser = strtolower(stripslashes($data["nama"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $confirm = mysqli_real_escape_string($conn, $data["confirm"]);
    

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT nama_admin FROM user_admin WHERE nama_admin = '$username'");
        if (mysqli_fetch_assoc($result)){
            echo '<script>
                alert("Akun ini sudah ada!");
                window.location.href = "../view/registration.php";
                </script>';
        }
        // cek nama sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username_admin FROM user_admin WHERE username_admin = '$namauser'");
        if (mysqli_fetch_assoc($result)){
            echo '<script>
            alert("Harap pilih nama lain!");
            window.location.href = "../view/registration.php";
            </script>';
        }

        // Cek konfirmasi password user
        if($password !== $confirm) {
            echo '<script>
            alert("Password tidak sama!");
            window.location.href = "../view/registration.php";
            </script>';
        }

        // Enkripsi terlebih dahulu password user
        $confirm = password_hash($confirm, PASSWORD_DEFAULT);

        // Ambil tanggal saat ini
        $tanggalRegistrasi = date("Y-m-d");

        // Tambahkan user ke database
        $query = "INSERT INTO user_admin (username_admin, nama_admin, pass, tanggal) VALUES ('$username', '$namauser', '$confirm', '$tanggalRegistrasi')";
        if (mysqli_query($conn, $query)) {
            // Tambahkan logs aktivitas
            $curdate = date("Y-m-d H:i:s");
            $logs = "INSERT INTO logs (datalogs, tanggal) VALUES ('User bernama $username berhasil registrasi ke database', '$curdate')";
            if (mysqli_query($conn, $logs)) {
                return true;
            } else {
                echo "Error logs: " . mysqli_error($conn); // Tampilkan pesan error
                return false;
            }
        } else {
            echo "Error user: " . mysqli_error($conn); // Tampilkan pesan error
            return false;
        }
    }

    // Menutup koneksi database
    mysqli_close($conn);
?>