<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bukukas");
$hasil = mysqli_query($koneksi, "SELECT kategori_keluar, SUM(jumlah_keluar) as nominal FROM pengeluaran GROUP BY kategori_keluar ORDER BY kategori_keluar ASC");
$data = [];
$colors = [];

while ($row = mysqli_fetch_assoc($hasil)) {
    $kategori = $row['kategori_keluar'];
    // Mengambil warna berdasarkan kategori dari tabel sumber_keluar
    $result_sumber = mysqli_query($koneksi, "SELECT warna FROM sumber_keluar WHERE kategori_keluar = '{$kategori}'");
    $color_row = mysqli_fetch_assoc($result_sumber);
    
    $data[] = [
        'kategori' => $kategori,
        'nominal' => $row['nominal']
    ];

    // Menyimpan warna dalam array colors
    $colors[] = $color_row['warna'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Lingkaran</title>
    <script src="../js/Chart.js"></script>
    <style type="text/css">
        .container {
            width: 55%;
            margin: 15px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <canvas id="piechart" width="100" height="100"></canvas>
    </div>
</body>
</html>

<script type="text/javascript">
    var ctx = document.getElementById("piechart").getContext("2d");
    var data = {
        labels: [
            <?php foreach ($data as $item) {
                echo '"' . $item['kategori'] . '",';
            } ?>
        ],
        datasets: [
            {
                label: "nominal Barang",
                data: [
                    <?php foreach ($data as $item) {
                        echo $item['nominal'] . ',';
                    } ?>
                ],
                backgroundColor: [
                    <?php foreach ($colors as $color) {
                        echo '"' . $color . '",';
                    } ?>
                ]
            }
        ]
    };

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = ((currentValue / total) * 100).toFixed(1) + '%';
                        return data.labels[tooltipItem.index] + ' ' + percentage;
                    }
                }
            }
        }
    });
</script>
