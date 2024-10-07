<?php
// Koneksi ke database (gantikan dengan detail koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel pengeluaran
$queryPengeluaran = "SELECT kategori_keluar, ikon, warna FROM sumber_keluar";
$resultPengeluaran = mysqli_query($koneksi, $queryPengeluaran);

// Fungsi untuk menghasilkan elemen HTML
function generateSelectionMenu($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $kategori_keluar = $row['kategori_keluar'];
        $warna = $row['warna'];
        $ikonClass = $row['ikon'];
        ?>
            <div class="menu-pengeluaran"> <!-- Ganti class sesuai kebutuhan -->
                <div class="icon-keluar" style="background-color: <?php echo $warna; ?>">
                    <i class="<?php echo $ikonClass; ?>" style="color: #fff;"></i>
                </div>
                <p><?php echo $kategori_keluar; ?></p>
            </div>
        <?php
    }
}

// Panggil fungsi untuk menghasilkan elemen HTML
generateSelectionMenu($resultPengeluaran);

// Tutup koneksi setelah selesai
mysqli_close($koneksi);
?>
