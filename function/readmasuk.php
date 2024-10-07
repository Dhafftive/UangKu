<?php 
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel keluar
$histori = "SELECT * FROM pemasukan ORDER BY tgl_pemasukan DESC";
$resultMasuk = mysqli_query($koneksi, $histori);
?>