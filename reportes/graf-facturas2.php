<?php

session_start();
if (!isset($_SESSION["usuario"])) {
  header("Location: index1.php");
}
include("../conexion.php");
include("../barramenu.php");

$myfecha1 = $_POST['fecha1'];
$myfecha2 = $_POST['fecha2'];

// echo $myfecha1;
// echo $myfecha2;

// $sqlven0="SELECT SUM(v.valortotal) AS Total,
// 	v.facturador AS facturador
// 	FROM covidsales v 
// 	where
// 	 fechafact>='2020-05-01' and fechafact<='2020-05-24' and anulada<>'1' and canal =0
// 	GROUP BY facturador";
if ($_SESSION["canal_id"] > 2) {
  $sqlven0 = " SELECT SUM(v.valortotal) AS Total, v.facturador AS facturador , COUNT(facturador) as numero 
  FROM covidsales v 	
  where fechafact>='$myfecha1' and fechafact<='$myfecha2' and anulada<>'1' and canal = " . $_SESSION["canal_id"] . "
  GROUP BY facturador";
  $result = mysqli_query($con, $sqlven0);

} else {

  $sqlven0 = " SELECT SUM(v.valortotal) AS Total, v.facturador AS facturador , COUNT(facturador) as numero 
  FROM covidsales v 	
  where fechafact>='$myfecha1' and fechafact<='$myfecha2' and anulada<>'1' and canal =0 
  GROUP BY facturador";


  // $sqlven2="SELECT SUM(v.valortotal) AS Total,
  // 	v.facturador AS facturador
  // 	FROM covidsales v 
  // 	where
  // 	 fechafact>='2020-05-01' and fechafact<='2020-05-24' and anulada<>'1' and canal =1
  // 	GROUP BY facturador";
  $sqlven2 = " SELECT SUM(v.valortotal) AS Total, v.facturador AS facturador , COUNT(facturador) as numero 
  FROM covidsales v 	
  where fechafact>='$myfecha1' and fechafact<='$myfecha2' and anulada<>'1' and canal =1 
  GROUP BY facturador";

  $sqlven3 = "SELECT sum(a.valortotal) as total , a.canal as canal ,COUNT(facturador) as numero
 FROM `covidsales` as a WHERE a.fechafact>='$myfecha1' and a.fechafact<='$myfecha2' and anulada <>'1'
 group by canal ";

  // echo $sqlven0."<br>";
  // echo $sqlven2."<br>";
  // echo $sqlven3."<br>";

  $result = mysqli_query($con, $sqlven0);
  $result2 = mysqli_query($con, $sqlven2);
  $result3 = mysqli_query($con, $sqlven3);
}

?>

<?php
if ($_SESSION["canal_id"] > 2) {

?>
  <html>

  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.arrayToDataTable([
          ['Usuario', 'No. Facturas'],
          <?php
          while ($row = mysqli_fetch_array($result)) {
            echo "['" . $row["facturador"] . "', " . $row["numero"] . "],";
          }
          ?>
        ]);
        var options = {
          title: 'Ventas OnLine',
          pieHole: 0.4,
        };
        var options = {
          title: '<?php echo $_SESSION["canal"] ?>',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);


      }
    </script>
  </head>

  <body>
    <h1><?php echo $_SESSION["canal"] ?></h1>
    <div id="donutchart" style="width: 100%; height: 100%;"></div>
  </body>

  </html>
<?php
} else {

?>
  <html>

  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.arrayToDataTable([
          ['Usuario', 'No. Facturas'],
          <?php
          while ($row = mysqli_fetch_array($result)) {
            echo "['" . $row["facturador"] . "', " . $row["numero"] . "],";
          }
          ?>
        ]);

        var options = {
          title: 'Ventas OnLine',
          pieHole: 0.4,
        };


        var data2 = new google.visualization.arrayToDataTable([
          ['Usuario', 'No. Facturas'],
          <?php
          while ($row2 = mysqli_fetch_array($result2)) {
            echo "['" . $row2["facturador"] . "', " . $row2["numero"] . "],";
          }
          ?>
        ]);


        var data3 = new google.visualization.arrayToDataTable([
          ['Canal', 'No. Facturas'],
          <?php
          while ($row3 = mysqli_fetch_array($result3)) {
            echo "['" . $row3["canal"] . "', " . $row3["numero"] . "],";
          }
          ?>
        ]);


        var options = {
          title: 'Número facturas OnLine',
          pieHole: 0.4,
        };

        var options2 = {
          title: 'Número facturas Callcenter',
          pieHole: 0.4,
        };

        var options3 = {
          title: 'Número facturas total (0 = Online , 1 = Callcenter)',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);

        var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart2.draw(data2, options2);

        var chart3 = new google.visualization.PieChart(document.getElementById('donutchart3'));
        chart3.draw(data3, options3);

      }
    </script>
  </head>

  <body>
    <div id="donutchart" style="width: 100%; height: 100%;"></div>
    <div id="donutchart2" style="width: 100%; height: 100%;"></div>
    <div id="donutchart3" style="width: 100%; height: 100%;"></div>
  </body>

  </html>
<?php
}
?>