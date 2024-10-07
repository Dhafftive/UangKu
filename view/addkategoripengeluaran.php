<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Kategori Masuk</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/addmenu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/color-spectrum.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/font.css">
    <!-- JQUERY LIBRARY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Spectrum Color Picker CDN (Content Delivery Network) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
    
</head>
<body>
    <div class="addmenu-category">
        <div class="popup-addmenu" id="kategori-masuk">
            <h2 class="tambah-judul">Atur Kategori Masuk</h2>
            <form action="../function/proseskategoripengeluaran.php" method="POST" class="form-addmenu" id="form-category">
                <div class="contain">
                    <p class="label">Buat nama kategori</p>
                    <input type="text" name="name-kategori" id="name-kategori" placeholder="Nama Kategori" required>
                    <p class="label">Pilih kategori yang akan ditambahkan</p>
                    <div class="pilih">
                        <label class="radio">
                            <input type="radio" name="jenis-transaksi" value="pemasukan" id="pemasukan">
                            <div class="select-tabel">
                                <span class="radio-label">Pemasukan</span>
                            </div>
                        </label>
                        <label class="radio">
                            <input type="radio" name="jenis-transaksi" value="pengeluaran" id="pengeluaran">
                            <div class="select-tabel">
                                <span class="radio-label">Pengeluaran</span>
                            </div>
                        </label>
                    </div>
                    <p class="label">Pilih warna untuk ditampilkan di chartpie</p>
                    <input id="color-picker" value='#276cb8' />
                    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
                    <script src="./script/spectrum-init.js"></script>
                    <input type="hidden" name="color-inp" id="hexInput">
                    <input type="submit" value="Konfirmasi" name="kirim" id="kirim-kategori">
                </div>
            </form>
        </div>
    </div>
    <!-- Color spectrum JS -->
    <script src="../script/spectrum-init.js"></script>
</body>
</html>
