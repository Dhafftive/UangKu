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

    $sqlKategori = "SELECT kategori, nominal, warna FROM pengeluaran";
    $resultKategori = $conn->query($sqlKategori);

    $labels = [];
    $data = [];
    $backgroundColor = [];

    while ($row = $resultKategori->fetch_assoc()) {
        $labels[] = $row['kategori'];
        $data[] = $row['nominal'];
        $backgroundColor[] = $row['warna'];
    }

    $conn->close();

    $data = [
        'labels' => $labels,
        'datasets' => [
            [
                'data' => $data,
                'backgroundColor' => $backgroundColor,
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