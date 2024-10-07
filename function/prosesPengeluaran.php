<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel kategori untuk ditampilkan pada halaman dan form
$query_kategori = "SELECT id_keluar, kategori_keluar FROM sumber_keluar";
$result_kategori = mysqli_query($koneksi, $query_kategori);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validasi input di sini

    $id_keluar = $_POST["id_keluar"];
    $nominal = $_POST["nominal"];
    $catatan = $_POST["catatan"];
    $curdate = date("Y-m-d");

    // masukkan data ke dalam tabel kategori pengeluaran
    $insert_pengeluaran = "INSERT INTO pengeluaran (id_keluar, kategori_keluar, jumlah_keluar, tgl_pengeluaran, catatan_keluar) 
                          VALUES ('$id_keluar', (SELECT kategori_keluar FROM sumber_keluar WHERE id_keluar = '$id_keluar'), '$nominal', '$curdate', '$catatan')";

    if (mysqli_query($koneksi, $insert_pengeluaran)) {
        // Sukses
        header("Location: ../view/pengeluaran.php");
        exit(); // Penting untuk menghentikan eksekusi lebih lanjut setelah pengalihan
    } else {
        // Gagal
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>