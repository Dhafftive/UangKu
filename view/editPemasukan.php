<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel kategori untuk ditampilkan pada halaman dan form
$query_kategori = "SELECT id_masuk, kategori_masuk FROM sumber_masuk";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Check if the id_pemasukan parameter is set in the URL
if (isset($_GET['id_pemasukan'])) {
    $id_pemasukan = $_GET['id_pemasukan'];
    
    // Fetch the data for the selected id_pemasukan
    $query = "SELECT * FROM pemasukan WHERE id_pemasukan = $id_pemasukan"; // Replace your_table_name with your actual table name
    $result = mysqli_query($koneksi, $query); // Replace $koneksi with your database connection
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        // Handle the database query error here
        die("Database query error: " . mysqli_error($koneksi));
    }
} else {
    // Handle the case where id_pemasukan is not set in the URL
    die("Invalid request. Please select a valid record to edit.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit pemasukan</title>
    <!-- Add Bootstrap CSS -->
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
            top: 5vh; /* Position 15vh from the top */
            left: 5vw; /* Position 5vw from the left side */
        }
        .page-title {
            color: blue;
        }
    </style>
    <link rel="stylesheet" href="../css/pengeluaran.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="page-title">Edit pemasukan</h1>
        <form action="../function/editmasukprocess.php" method="POST">
            <input type="hidden" name="id_pemasukan" value="<?php echo $data['id_pemasukan']; ?>">
            <div class="form-group">
                <label for="id_masuk">Pilih Kategori:</label>
                <select class="form-control" name="id_masuk" id="id_masuk">
                    <option value="">Pilih Kategori</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_kategori)) {
                        $selected = ($row['id_masuk'] == $data['id_masuk']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $row['id_masuk']; ?>" <?php echo $selected; ?>><?php echo $row['kategori_masuk']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_masuk">Nominal pemasukan:</label>
                <input type="text" class="form-control" name="jumlah_masuk" id="jumlah_masuk" value="<?php echo $data['jumlah_masuk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="catatan_masuk">Catatan:</label>
                <textarea class="form-control" name="catatan_masuk" id="catatan_masuk"><?php echo $data['catatan_masuk']; ?></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Update pemasukan"></input>
            <a href="pemasukan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery (Optional, if needed) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
