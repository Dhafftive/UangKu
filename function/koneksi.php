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
?>