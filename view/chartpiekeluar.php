<?php
$koneksi            = mysqli_connect("localhost", "root", "", "db_bukukas");
$jumlah_keluar      = mysqli_query($koneksi, "SELECT SUM(jumlah_keluar) as totalkeluar FROM pengeluaran order by id_keluar asc");
$kategori_keluar    = mysqli_query($koneksi, "SELECT kategori_keluar FROM pengeluaran order by id_keluar asc");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Lingkaran</title>
    <script src="js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 40%;
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

<script  type="text/javascript">
  var ctx = document.getElementById("piechart").getContext("2d");
  var data = {
            labels: [<?php while ($p = mysqli_fetch_array($kategori_keluar)) { echo '"' . $p['kategori_keluar'] . '",';}?>],
            datasets: [
            {
              label: "jumlah_keluar Barang",
              data: [<?php while ($p = mysqli_fetch_array($jumlah_keluar)) { echo '"' . $p['totalkeluar'] . '",';}?>],
              backgroundColor: [
                '#29B0D0',
                '#2A516E',
                '#F07124',
                '#CBE0E3',
                '#979193'
              ]
            }
            ]
            };

  var myPieChart = new Chart(ctx, {
                  type: 'pie',
                  data: data,
                  options: {
                    responsive: true
                }
              });

</script>