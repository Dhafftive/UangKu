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

    // Menghitung total pengeluaran
    $queryPengeluaran = "SELECT COALESCE(SUM(jumlah_keluar), 0) as total_pengeluaran FROM pengeluaran";
    $resultPengeluaran = $conn->query($queryPengeluaran);
    $rowPengeluaran = $resultPengeluaran->fetch_assoc();
    $totalPengeluaran = $rowPengeluaran['total_pengeluaran'];

    // Menghitung total pemasukan
    $queryPemasukan = "SELECT COALESCE(SUM(jumlah_masuk), 0) as total_pemasukan FROM pemasukan";
    $resultPemasukan = $conn->query($queryPemasukan);
    $rowPemasukan = $resultPemasukan->fetch_assoc();
    $totalPemasukan = $rowPemasukan['total_pemasukan'];

    // Saldo sekarang
    $saldoSekarang = $totalPemasukan - $totalPengeluaran;

    // Menggunakan number_format() untuk memformat total pengeluaran, total pemasukan, dan hasil pengurangan
    $totalPengeluaranFormatted = number_format($totalPengeluaran, 0, ',', '.');
    $totalPemasukanFormatted = number_format($totalPemasukan, 0, ',', '.');
    $saldoSekarangFormatted = number_format($saldoSekarang, 0, ',', '.');

    // Menutup koneksi database
    mysqli_close($conn);
?>
