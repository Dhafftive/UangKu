<?php 
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel keluar
$histori = "SELECT * FROM pengeluaran ORDER BY tgl_pengeluaran DESC";
$resultKeluar = mysqli_query($koneksi, $histori);
?>