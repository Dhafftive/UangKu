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
        $id_pengeluaran = $_GET["id_pengeluaran"];

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Hapus data dari tabel berdasarkan ID yang dipilih
        foreach ($dataToDelete as $id) {
            $sql = "DELETE FROM pengeluaran WHERE id_pengeluaran = $id";
            mysqli_query($conn, "UPDATE pengeluaran SET total=total-1 WHERE id_pengeluaran='$id_pengeluaran'");

            if ($conn->query($sql) === TRUE) {
                header("location:../view/pengeluaran.php?id_pengeluaran=$id_pengeluaran");
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