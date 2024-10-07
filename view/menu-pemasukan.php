<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$queryPemasukan = "SELECT kategori_masuk, ikon, warna FROM sumber_masuk";
$resultPemasukan = mysqli_query($koneksi, $queryPemasukan);

// Cek apakah tabel pengeluaran kosong
if (mysqli_num_rows($resultPemasukan) > 0) {
    // Tampilkan hasil query
    generateSelectionMasuk($resultPemasukan);
}

function generateSelectionMasuk($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $kategori_masuk = $row['kategori_masuk'];
        $warna = $row['warna'];
        $ikonClass = $row['ikon'];
        ?>

            <div class="menu-pemasukan"> <!-- Ganti class sesuai kebutuhan -->
                <div class="icon-masuk" style="background-color: <?php echo $warna; ?>">
                    <i class="<?php echo $ikonClass; ?> " style="color: #fff;"></i>
                </div>
                <p><?php echo $kategori_masuk; ?></p>
            </div>

        <?php
    }
}

mysqli_close($koneksi);
?>