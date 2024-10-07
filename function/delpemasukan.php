<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dipilih dari checkbox
    if (isset($_POST["data"]) && is_array($_POST["data"])) {
        $dataToDelete = $_POST["data"];
        
        // Koneksi ke database (gantilah dengan informasi database Anda)
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "db_bukukas";

        $conn = new mysqli($host, $username, $password, $database);
        $id_pemasukan = $_GET["id_pemasukan"];

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Hapus data dari tabel berdasarkan ID yang dipilih
        foreach ($dataToDelete as $id) {
            $sql = "DELETE FROM pemasukan WHERE id_pemasukan = $id";
            mysqli_query($conn, "UPDATE pemasukan SET total=total-1 WHERE id_pemasukan='$id_pemasukan'");

            if ($conn->query($sql) === TRUE) {
                header("location:../view/pemasukan.php?id_pemasukan=$id_pemasukan");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    } else {
        echo "Tidak ada data yang dipilih untuk dihapus.";
    }
}
?>