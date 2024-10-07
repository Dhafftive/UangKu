<!DOCTYPE html>
<html>
<head>
    <title>Chart.js Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 50%;">
        <canvas id="myPieChart"></canvas>
    </div>

    <script>
        // Membuat data PHP
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_bukukas";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query SQL untuk mengambil total pengeluaran per kategori
        $query = "SELECT sumber_keluar.kategori_keluar, SUM(pengeluaran.jumlah_pengeluaran) AS total_pengeluaran
                  FROM sumber_keluar
                  LEFT JOIN pengeluaran ON sumber_keluar.id_keluar = pengeluaran.id_keluar
                  GROUP BY sumber_keluar.kategori_keluar";

        $result = $conn->query($query);

        $labels = [];
        $data = [];
        $backgroundColor = [];

        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['kategori_keluar'];
            $data[] = $row['total_pengeluaran'];
            // Misalnya, Anda memiliki kolom warna dalam tabel sumber_keluar, Anda dapat mengambilnya dengan cara berikut
            $backgroundColor[] = $row['warna'];
        }

        $conn->close();

        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $backgroundColor, // Anda dapat mengganti ini dengan warna dari tabel sumber_keluar jika diperlukan
                ],
            ],
        ];
        ?>

        // Membuat grafik pie menggunakan Chart.js
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: <?php echo json_encode($data); ?>,
        });
    </script>
</body>
</html>
