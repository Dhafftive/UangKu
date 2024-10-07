<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel kategori untuk ditampilkan pada halaman dan form
$query_kategori = "SELECT id_keluar, kategori_keluar FROM sumber_keluar";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Proses ketika user menambahkan pengeluaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kategori = $_POST["id_kategori"];
    $nominal = $_POST["nominal"];
    $catatan = $_POST["catatan"];
    $curdate = date("Y-m-d");

    // Masukkan data ke dalam tabel kategori pengeluaran
    $insert_pengeluaran = "INSERT INTO pengeluaran (id_keluar, kategori_keluar, jumlah_keluar, tgl_pengeluaran, catatan_keluar) 
                          VALUES ('$id_kategori', (SELECT kategori_keluar FROM kategori WHERE id_keluar = '$id_kategori'), '$nominal', '$curdate', '$catatan')";

    mysqli_query($koneksi, $insert_pengeluaran);
}
?>

<!-- Wadah Form -->
<form method="POST" action="" >
    <h2 class="input-header">Masukkan Kategori</h2>
    <div class="kategori-nominal">
        <div class="kategori-input">  
            <p class="pilih">Pilih kategori</p>
            <div id="kategoriSelect" class="popupselect">
                <p>Klik Disini untuk memilih</p>
            </div>
        </div>
        <div class="nominal-input">
            <input type="hidden" name="id_kategori" id="hidden-id-input">  
            <p class="pilih">Jumlah pengeluaran</p>
            <input type="text" name="nominal" id="nominal" placeholder="Nominal" required>
            </div>
        </div>
    </div>
    <div class="catatan">
        <input type="text" name="catatan" id="catatan" placeholder="Catatan" required>
    </div>
    <input type="submit" value="Kirim" id="kirim">
</form>
<div class="popup-kategori" id="popup-kategori">
    <form id="menu-keluar">
        <?php while ($row = mysqli_fetch_assoc($result_kategori)) {?>
            <label class="menu-keluar">
                <input type="radio" name="keluar" value="<?php echo $row['id_keluar']; ?>">
                <p class="nama"><?php echo $row['kategori_keluar']; ?></p>
            </label>
        <?php } ?>
    </form>
</div>