<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel kategori untuk ditampilkan pada halaman dan form
$query_kategori = "SELECT id_masuk, kategori_masuk FROM sumber_masuk";
$result_kategori = mysqli_query($koneksi, $query_kategori);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validasi input di sini
    $id_masuk = $_POST["id_masuk"];
    $nominal = $_POST["nominal"];
    $catatan = $_POST["catatan"];
    $curdate = date("Y-m-d");

    // Ambil ID dari data atribut 'data-id'
    $kategori_masuk = htmlspecialchars($_POST['id_masuk']);
    $id_masuk = $_POST['id_masuk'];
    
    // Masukkan data ke dalam tabel kategori pemasukan
    $insert_pemasukan = "INSERT INTO pemasukan (id_masuk, kategori_masuk, jumlah_masuk, tgl_pemasukan, catatan_masuk) 
    VALUES ('$id_masuk', (SELECT kategori_masuk FROM sumber_masuk WHERE id_masuk = '$id_masuk'), '$nominal', '$curdate', '$catatan')";

    if (mysqli_query($koneksi, $insert_pemasukan)) {
        // Sukses
        header("Location: ../view/pemasukan.php");
        exit(); // Penting untuk menghentikan eksekusi lebih lanjut setelah pengalihan
    } else {
        // Gagal
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>