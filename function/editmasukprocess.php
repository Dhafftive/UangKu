<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $id_pemasukan = $_POST['id_pemasukan'];
    $id_masuk = $_POST['id_masuk'];
    $nominal = $_POST['jumlah_masuk'];
    $catatan = $_POST['catatan_masuk'];

    // Buat kueri SQL UPDATE
    $query = "UPDATE pemasukan SET kategori_masuk = (SELECT kategori_masuk FROM sumber_masuk WHERE id_masuk = '$id_masuk'), id_masuk = '$id_masuk', jumlah_masuk = '$nominal', catatan_masuk = '$catatan' WHERE id_pemasukan = $id_pemasukan";
    
    // Jalankan kueri UPDATE
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect pengguna kembali ke halaman "pemasukan.php" setelah berhasil diupdate
        header("Location: ../view/pemasukan.php");
        exit();
    } else {
        // Handle kesalahan jika terjadi
        die("Kesalahan database: " . mysqli_error($koneksi));
    }
}
?>
