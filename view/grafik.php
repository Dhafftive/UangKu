<!DOCTYPE html>
<html>
<head>
  <title>UangKu - Grafik</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font.css">
  <link rel="stylesheet" href="../css/navigation.css?v=<?php echo time(); ?>"> 
  <style>
    .panel-heading{
      font-family: Poppins-medium;
      font-size: 20px;
      text-align: center;
    }
    iframe{
      border: none;
    }
  </style>
</head>
<body>
  <!--
        ===============================================
        ============== HEADER NAVIGATION ==============
        ===============================================
  -->
  <header class="custom-header" style="padding: 38px 0 28px;">
    <h1 class="logo" style="margin-top: 0px;">UangKu</h1>
      <nav class="custom-nav">
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="./pemasukan.php">Pemasukan</a></li>
          <li><a href="./pengeluaran.php">Pengeluaran</a></li>
          <li><button class="sign-in"><a href="./grafik.php">Grafik</a></button></li>
        </ul>
      </nav>
  </header>
  <div class="container" style="margin-top: 5vh;">
    <div class="row">
      <div class="col-sm-6">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading" style="background: blue; color: #fff;">Persentase Pengeluaran</div>
            <div class="panel-body"><iframe src="piekeluar.php" width="100%" height="350"></iframe></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading" style="background: blue; color: #fff;">Nominal Pengeluaran</div>
            <div class="panel-body"><iframe src="barchartskeluar.php" width="140%" height="350" style="margin-left: -100px; overflow-x: hidden;"></iframe></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top: 5vh;">
    <div class="row">
      <div class="col-sm-6">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading" style="background: blue; color: #fff;">Persentase Pemasukan</div>
            <div class="panel-body"><iframe src="piemasuk.php" width="100%" height="350"></iframe></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading" style="background: blue; color: #fff;">Nominal Pengeluaran</div>
            <div class="panel-body"><iframe src="barchartsmasuk.php" width="140%" height="350" style="margin-left: -100px; overflow-x: hidden;"></iframe></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
