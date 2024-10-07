<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $id_pengeluaran = $_POST['id_pengeluaran'];
    $id_keluar = $_POST['id_keluar'];
    $nominal = $_POST['jumlah_keluar'];
    $catatan = $_POST['catatan_keluar'];

    // Buat kueri SQL UPDATE
    $query = "UPDATE pengeluaran SET kategori_keluar = (SELECT kategori_keluar FROM sumber_keluar WHERE id_keluar = '$id_keluar'), id_keluar = '$id_keluar', jumlah_keluar = '$nominal', catatan_keluar = '$catatan' WHERE id_pengeluaran = $id_pengeluaran";
    
    // Jalankan kueri UPDATE
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect pengguna kembali ke halaman "pengeluaran.php" setelah berhasil diupdate
        header("Location: ../view/pengeluaran.php");
        exit();
    } else {
        // Handle kesalahan jika terjadi
        die("Kesalahan database: " . mysqli_error($koneksi));
    }
}
?>
