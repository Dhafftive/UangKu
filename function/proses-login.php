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
    if (isset($_POST['Login'])){
        //Jika tombol login diklik
        $username = $_POST['username'];
        $password = $_POST['password']; //-- pure password pengguna yg belum dienkripsi

        $cekdb = mysqli_query($conn, "SELECT * FROM user_admin WHERE username_admin = '$username'");
        $hitung = mysqli_num_rows($cekdb);
        $pw = mysqli_fetch_array($cekdb);
        $passwordSekarang = $pw['pass']; //-- Password yang sudah dienkripsi di database

        if ($hitung > 0){
            // jika ada
            // verifikasi password
            if (password_verify($password, $passwordSekarang)) {
                // jika passwordnya benar
                echo'
                    <script>
                        alert("Anda berhasil login!");
                    </script>
                ';
                header("location: ../index.php"); // redirect ke halaman home

                // Tambahkan logs aktivitas
                $curdate = date("Y-m-d");
                $logs = "INSERT INTO logs (datalogs, tanggal) VALUES ('$username berhasil login masuk', '$curdate')";
                if (mysqli_query($conn, $logs)) {
                    // Log berhasil ditambahkan
                } else {
                    echo "Error logs: " . mysqli_error($conn); // Tampilkan pesan error
                }
            } else {
                // jika password salah 
                echo '
                    <script>
                        alert("Password salah");
                        window.location.href = "../view/login.php";
                    </script>
                ';
            }
        } else {
            echo '
            <script>
                alert("Login gagal");
                window.location.href = "../view/login.php";
            </script>
        ';
        }
    }

    // Menutup koneksi database
    mysqli_close($conn);
?>