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
    <title>Chartjs, PHP dan MySQL Demo Grafik Batang</title>
    <script src="../js/Chart.js"></script>
    <style type="text/css">
        .container {
            width: 40%;
            margin: 15px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <canvas id="barchart" width="200" height="200"></canvas>
    </div>
</body>
</html>

<script type="text/javascript">
    var ctx = document.getElementById("barchart").getContext("2d");
    var data = {
        labels: [
            <?php foreach ($data as $item) {
                echo '"' . $item['kategori'] . '",';
            } ?>
        ],
        datasets: [
            {
                label: "Nominal Pengeluaran",
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

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            legend: {
                display: false
            },
            barValueSpacing: 20,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format angka sebagai "Rp." dengan pemisah ribuan
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var label = data.labels[tooltipItem.index];
                        var value = 'Rp. ' + dataset.data[tooltipItem.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        return label + ': ' + value;
                    }
                }
            }
        }
    });
</script>
