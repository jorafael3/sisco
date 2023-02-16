<?php  
include("conexion.php");


$sqlven0="SELECT SUM(v.valortotal) AS Total,
	v.vendedor AS Vendedor
	FROM covidsales v 
	where
	 fecha>='2020-05-01' and fecha<='2020-05-24' and anulada<>'1' and canal =0
	GROUP BY vendedor";

$sqlven2="SELECT SUM(v.valortotal) AS Total,
	v.vendedor AS Vendedor
	FROM covidsales v 
	where
	 fecha>='2020-05-01' and fecha<='2020-05-24' and anulada<>'1' and canal =1
	GROUP BY vendedor";

$sqlven3="SELECT sum(a.valortotal) as total , a.canal as canal FROM `covidsales` as a WHERE a.fecha>='2020-05-01' and a.fecha<='2020-05-24' group by canal ";



$result = mysqli_query($con, $sqlven0); 
$result2 = mysqli_query($con, $sqlven2); 
$result3 = mysqli_query($con, $sqlven3); 

 ?>  
 
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        		<?php
				  while($row = mysqli_fetch_array($result))  
				  {  
					   echo "['".$row["Vendedor"]."', ".$row["Total"]."],";  
				  }  
				?>
        ]);

        var options = {
          title: 'Ventas OnLine',
          pieHole: 0.4,
        };


        var data2 = new google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        		<?php
				  while($row2 = mysqli_fetch_array($result2))  
				  {  
					   echo "['".$row2["Vendedor"]."', ".$row2["Total"]."],";  
				  }  
				?>
        ]);


        var data3 = new google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        		<?php
				  while($row3 = mysqli_fetch_array($result3))  
				  {  
					   echo "['".$row3["canal"]."', ".$row3["total"]."],";  
				  }  
				?>
        ]);


        var options = {
          title: 'Ventas OnLine',
          pieHole: 0.4,
        };
        
        var options2 = {
          title: 'Ventas Callcenter',
          pieHole: 0.4,
        };

        var options3 = {
          title: 'Venta Total (0 = Online , 1 = Callcenter)',
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
