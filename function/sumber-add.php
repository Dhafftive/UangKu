<?php
// Koneksi ke database (gantikan dengan detail koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['kirim'])) {
    // Ambil nilai dari form
    $kategori = $_POST['name-kategori'];
    $warna = $_POST['color-inp'];
    $ikon = $_POST['icon-name'];
    $jenisTransaksi = $_POST['jenis-transaksi']; // Nilai dari input radio

    // Lakukan koneksi ke database

    if ($jenisTransaksi == "pemasukan") {
        // Masukkan data ke tabel pemasukan
        INSERT INTO tabel_pemasukan (kolom1, kolom2, kolom3) VALUES ('$kategori', '$warna', '$ikon');
    } elseif ($jenisTransaksi == "pengeluaran") {
        // Masukkan data ke tabel pengeluaran
        INSERT INTO tabel_pengeluaran (kolom1, kolom2, kolom3) VALUES ('$kategori', '$warna', '$ikon');
    }
}

// Tutup koneksi setelah selesai
mysqli_close($koneksi);
?>