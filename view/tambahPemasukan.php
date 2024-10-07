<?php 
    require '../function/prosesPemasukan.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form pemasukan</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f3f3f3;
        }
        .container {
            max-width: 40vw;
            background: #fff;
            border-top: 5px solid blue;
            padding: 20px;
            margin: 0 auto;
            margin-top: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 5vh; /* Posisikan 15vh dari atas */
            left: 5vw; /* Posisikan 5vw dari sisi kiri */
        }
        .page-title {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="page-title">Tambah Pemasukan</h1>
        <form method="POST" action="../function/prosesPemasukan.php">
            <div class="form-group">
                <label for="id_masuk">Pilih Kategori:</label>
                <select class="form-control" name="id_masuk" id="id_masuk">
                    <option value="">Pilih Kategori</option>
                    <?php while ($row = mysqli_fetch_assoc($result_kategori)) { ?>
                        <option value="<?php echo $row['id_masuk']; ?>"><?php echo $row['kategori_masuk']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nominal">Nominal pemasukan:</label>
                <input type="text" class="form-control" name="nominal" id="nominal">
            </div>
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea class="form-control" name="catatan" id="catatan"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Kirim Pemasukan"></input>
            <a href="pemasukan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Tambahkan Bootstrap JS dan jQuery (Opsional, jika Anda memerlukannya) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
