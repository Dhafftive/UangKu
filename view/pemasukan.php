<?php 
    require '../function/saldo.php';
    require '../function/readmasuk.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UangKu - Pemasukan</title>
    <!-- Fonts Google -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <!-- CSS Style -->
    <link rel="stylesheet" href="../css/font.css">
    <link rel="stylesheet" href="../css/pengeluaran.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navigation.css?v=<?php echo time(); ?>">
</head>
<body>
    <!--
            ===============================================
            ============== HEADER NAVIGATION ==============
            ===============================================
     -->
     <header class="custom-header">
        <h1 class="logo">UangKu</h1>
        <nav class="custom-nav">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="./pemasukan.php">Pemasukan</a></li>
                <li><a href="./pengeluaran.php">Pengeluaran</a></li>
                <li><button class="sign-in"><a href="./grafik.php">Grafik</a></button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="left">
            <div class="grafik">
                <iframe src="piemasuk.php" width="100%" height="350" style="outline: none; border: none;"></iframe>
                <div class="tambah-kategori">
                    <p class="add-kategori">Tambah kategori</p>
                    <div class="btn-add">
                        <a href="./addkategoripemasukan.php"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="pengeluaran">
                <div class="btn-tambah">
                    <a href="./tambahPemasukan.php"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="text">
                    <p class="saldo-out">Pemasukan anda</p>
                    <p class="nominal-keluar">Rp. <?php echo $totalPemasukanFormatted ?></p>
                </div>
            </div>
        </div>
        <div class="right">
            <p class="notice">Ini adalah Aktivitas Pemasukan Anda</p>
            <p class="notice-catatan">Upayakan uangmu digunakan sebaik mungkin dan jangan banyak beli yang tak perlu</p>
            <div class="table">
                <div class="table-container">
                    <table class="tablePengeluaran">
                        <thead>
                            <tr class="head-table">
                                <th>Catatan</th>
                                <th>Kategori</th>
                                <th>Nominal</th>
                                <th  style="width: 8vw;">Tanggal</th>
                                <th style="width: 4vw;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="row"> 
                <?php      
                    while($row = mysqli_fetch_assoc($resultMasuk)){ 
                    $tanggal_terformat = date("d M Y", strtotime($row["tgl_pemasukan"]));
                ?>
                            <tr class="menu-table">
                                <td><?php echo $row["catatan_masuk"] ?></td>
                                <td><?php echo $row["kategori_masuk"] ?></td>
                                <td>Rp. <?php echo number_format($row["jumlah_masuk"], 0, '.', '.'); ?></td>
                                <td style="text-align: center;"><?php echo $tanggal_terformat ?></td>
            <form id="deleteForm" action="../function/delpemasukan.php?id_pemasukan=<?php echo $row["id_pemasukan"] ?>" method="post">
                                <td style="display: flex; justify-content: center; align-items: center;">
                                    <label for="data1">
                                        <input type="checkbox" class="checkbox" name="data[]" value="<?php echo $row["id_pemasukan"];?>" data-id="<?php echo $row["id_pemasukan"];?>"> 
                                    </label>
                                </td>
                                <!-- Script for chance href -->
                                <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const checkboxes = document.querySelectorAll(".checkbox");
                                    
                                    checkboxes.forEach(function (checkbox) {
                                        checkbox.addEventListener("change", function () {
                                            let selectedIds = [];
                                            
                                            // Mengumpulkan ID pemasukan yang dicentang
                                            checkboxes.forEach(function (cb) {
                                                if (cb.checked) {
                                                    selectedIds.push(cb.value);
                                                }
                                            });
                                        });
                                    });
                                });
                                </script>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                        <div id="noResultsMessage" class="no-results-message">Tidak ada data yang sesuai</div>
                    </div>
                </div>
                <div class="action">
                    <input class="form-search" type="text" name="search" id="searchInput" placeholder="Cari...">
                    <div class="button-action">
                        <input type="submit" class="del" value="Hapus" onclick="return confirm('Apakah kamu yakin ingin menghapus ini?')">
                        <input type="reset" class="batal" value="Batal">
                    </form>
                        <button class="edit" id="editButton" disabled>Edit</button>
                        <button class="unduh" id="downloadButton">Download</button>
                    </div>
                </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../script/search.js"></script>
    <script src="../script/edit-masuk.js"></script>
    <script src="../script/unduhdatamasuk.js"></script>
</body>
</html>