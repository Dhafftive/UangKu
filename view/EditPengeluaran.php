<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");

// Ambil data dari tabel kategori untuk ditampilkan pada halaman dan form
$query_kategori = "SELECT id_keluar, kategori_keluar FROM sumber_keluar";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Check if the id_pengeluaran parameter is set in the URL
if (isset($_GET['id_pengeluaran'])) {
    $id_pengeluaran = $_GET['id_pengeluaran'];
    
    // Fetch the data for the selected id_pengeluaran
    $query = "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran"; // Replace your_table_name with your actual table name
    $result = mysqli_query($koneksi, $query); // Replace $koneksi with your database connection
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        // Handle the database query error here
        die("Database query error: " . mysqli_error($koneksi));
    }
} else {
    // Handle the case where id_pengeluaran is not set in the URL
    die("Invalid request. Please select a valid record to edit.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengeluaran</title>
    <link rel="stylesheet" href="../css/pengeluaran.css">
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
</head>
<body>
    <div class="container mt-5">
        <h1 class="page-title">Edit Pengeluaran</h1>
        <form action="../function/editkeluarprocess.php" method="POST">
            <input type="hidden" name="id_pengeluaran" value="<?php echo $data['id_pengeluaran']; ?>">
            <div class="form-group">
                <label for="id_keluar">Pilih Kategori:</label>
                <select class="form-control" name="id_keluar" id="id_keluar">
                    <option value="">Pilih Kategori</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_kategori)) {
                        $selected = ($row['id_keluar'] == $data['id_keluar']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $row['id_keluar']; ?>" <?php echo $selected; ?>><?php echo $row['kategori_keluar']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_keluar">Nominal Pengeluaran:</label>
                <input type="text" class="form-control" name="jumlah_keluar" id="jumlah_keluar" value="<?php echo $data['jumlah_keluar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="catatan_keluar">Catatan:</label>
                <textarea class="form-control" name="catatan_keluar" id="catatan_keluar"><?php echo $data['catatan_keluar']; ?></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Update Pengeluaran"></input>
            <a href="pengeluaran.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery (Optional, if needed) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
