<?php
// Menghubungkan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// cek koneksi ke database
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['kirim'])) {
    // Ambil nilai dari form
    $kategori = htmlspecialchars($_POST['name-kategori']);
    $warna = $_POST['color-inp'];
    $jenisTransaksi = $_POST['jenis-transaksi']; // Nilai dari input radio

    // Lakukan koneksi ke database
    if ($jenisTransaksi == "pemasukan") {
        // Masukkan data ke tabel pemasukan
        $queryInsert = "INSERT INTO sumber_masuk (kategori_masuk, warna) VALUES ('$kategori', '$warna')";
    } else if ($jenisTransaksi == "pengeluaran") {
        // Masukkan data ke tabel pengeluaran
        $queryInsert = "INSERT INTO sumber_keluar (kategori_keluar, warna) VALUES ('$kategori', '$warna')";
    }

    if (mysqli_query($koneksi, $queryInsert)) {
        echo "Data berhasil dimasukkan ke tabel pemasukan.";
        header("Location: ../view/pemasukan.php"); 
        exit(); // Pastikan untuk keluar dari script setelah mengarahkan pengguna
    } else {
        echo "Error: " . $queryInsert . "<br>" . mysqli_error($koneksi);
    }
}
?>
