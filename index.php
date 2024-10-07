<?php 
    require './function/saldo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UangKu</title>
    <!-- Fonts Google -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    <!-- CSS Style -->
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/navigation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
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
                <li><a href="./index.php">Home</a></li>
                <li><a href="./view/pemasukan.php">Pemasukan</a></li>
                <li><a href="./view/pengeluaran.php">Pengeluaran</a></li>
                <li><button class="sign-in"><a href="./view/grafik.php">Grafik</a></button></li>
            </ul>
        </nav>
    </header>
    <!--
            ===============================================
            ================= MAIN CONTENT ================
            ===============================================
     -->
     <main>
        <!-- Item sambutan -->
        <div class="sambutan">
            <div class="items-sambutan">
                <div class="items1"></div>
                <div class="items2"></div>
                <div class="items3"></div>
            </div>
            <div class="text-sambutan">
                <h1>Kelola uangmu lebih baik dan mudah agar masa depanmu terencana </h1>
                <p>Belajarlah hemat dan kelola uangmu untuk masa depan, ketahui apa saja yang kamu butuhkan dan sering kamu beli untuk kedepannya.</p>
            </div>
        </div>

        <!-- Dompet digital -->
        <div class="dompet">
            <div class="dompet-digital">
                <div class="header-dompet">
                    <p>Dompet digital</p>
                </div>
                <div class="saldo-anda">
                    <p class="saldo-head">Saldo anda</p>
                    <p class="saldo-nominal">Rp. <?php echo $saldoSekarangFormatted; ?></p>
                </div>
                <div class="masuk-keluar">
                    <div class="keluar">
                        <p class="keluar-header">Pengeluaran</p>
                        <p class="saldo">Rp. -<?php echo $totalPengeluaranFormatted; ?></p>
                    </div>
                    <div class="masuk">
                        <p class="masuk-header">Pemasukan</p>
                        <p class="saldo">Rp. +<?php echo $totalPemasukanFormatted; ?></p>
                    </div>
                    <div id="unduh-data"><i class="fa-solid fa-download"></i></div>
                </div>
            </div>
            <div class="kategori">
                <div class="tambahPemasukan"></div>
                <div class="tambahPengeluaran"></div>
            </div>
     </main>
     <!--
            ===============================================
            ============== FOOTER NAVIGATION ==============
            ===============================================
     -->
     <footer>
        <div id="masuk-keluar">
            <p class="hlm-hdr">Lihat Pemasukan & Pengeluaranmu</p>
            <div class="halaman-btn">         
                <a href="./view/pemasukan.php">Lihat Pemasukan</a>
            </div>
            <div class="halaman-btn">                
                <a href="./view/pengeluaran.php">Lihat Pengeluaran</a>
            </div>
        </div>
        <div class="desc">
            <p class="desc-header">Apa sih gunanya aplikasi ini ?</p>
            <p class="desc-apk">
                Aplikasi ini memudahkanmu untuk memanajemen uang sehari-harimu. Dengan memanajemen uang kamu sebaik mungkin, maka kamu tidak akan perlu takut lupa uangmu dipakai apa saja dan darimana saja kamu mendapat tambahan uang, dikasih nenek misalnya wkwk.
            </p>
        </div>
     </footer>
</body>
</html>