<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
	<title>Sistema SISCO</title>
	<link rel="stylesheet" type="text/css" href="../css/tablas.css">
	<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
	<meta charset="utf-8">



	<head>

		<link rel="stylesheet" type="text/css" href="../css/boton.css">

	</head>

<body>

	<!-- 
<FORM METHOD="POST" ACTION="reporte_menu1.php">
<br><br><br><input type="submit" name="Buscar" value="Menu inicial" class="btn btn-sm btn-primary"></td><tr>
</Form>
 -->

	<?php

	session_start();
	include("../barramenu.php");

	// if ($_SESSION["sacceso"]<>"1" )
	//         {
	//         // User not logged in, redirect to login page
	//         Header("Location: /elastix/index.php");
	//         }



	if (isset($_POST['fecha1'])) {
		$myfecha1 = $_POST['fecha1'];
		$hora1 = "00:00:00";
		$myfecha11 = $myfecha1 . " " . $hora1;
	}
	if (isset($_POST['fecha2'])) {
		$myfecha2 = $_POST['fecha2'];
		$hora2 = "23:59:59";
		$myfecha21 = $myfecha2 . " " . $hora2;
	}

	//echo "Fecha".$myfecha1. $myfecha2; 

	if (isset($_POST['vendedor'])) {
		$vendedor = $_POST['vendedor'];
	} else {
		$vendedor = '%';
	}
	if (isset($_POST['despacho1'])) {
		$despacho = $_POST['despacho1'];
	} else {
		$despacho = '%';
	}
	if (isset($_POST['comollego'])) {
		$comollego = $_POST['comollego'];
	} else {
		$comollego = '%';
	}
	if (isset($_POST['formapago'])) {
		$formapago = $_POST['formapago'];
	} else {
		$formapago = '%';
	}

	// die("<br><br><br><br> vendedor".$vendedor." - ".$despacho." - ".$comollego." - ".$formapago." - ".$_POST['despacho1']);

	include("../conexion.php");

	if ($_SESSION["canal_id"] > 2) {
		if (isset($_POST['fecha1'])  or isset($_GET['fecha1'])) {
			if ($_POST['tiporeporte'] == 'Ingresadas') {
				$tipofecha = "fecha";
			} else {
				$tipofecha = "fechafact";
			}


			$sqlven0 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' 
			and formapago like '$formapago' 
			and comollego like '$comollego'
			and anulada<>'1' and canal = ".$_SESSION["canal_id"]."
			GROUP BY vendedor";


			$sqlven1 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego'and anulada<>'1' and canal = ".$_SESSION["canal_id"]."
			GROUP BY vendedor";

			$sqlven2 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego'and anulada<>'1' and canal = ".$_SESSION["canal_id"]."
			GROUP BY vendedor";



			$sqlven3 = "SELECT   v.comollego AS comollego, fp.Directo,fp.Tienda, fp.LinktoPay, fp.Transferencia, fp.Paymentez, fp.Tarjeta
					FROM covidsales v 
					inner join (
						select  comollego, 
						sum(case when formapago='Directo' then valortotal else 0 end )as Directo,
						sum(case when formapago='Tienda' then valortotal else 0 end )as Tienda,
						sum(case when formapago='LinkToPay' then valortotal else 0 end) as LinktoPay,
						sum(case when formapago='Transferencia' then valortotal else 0 end) as Transferencia,
						sum(case when formapago='Paymentez' then valortotal else 0 end) as Paymentez,
						sum(case when formapago='Tarjeta' then valortotal else 0 end) as Tarjeta
						from covidsales where 
						convert($tipofecha,date) between '$myfecha11' and '$myfecha21' and anulada<>'1'
						group by comollego) fp 
					on fp.comollego = v.comollego
					where
					convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
					and anulada<>'1'
					and canal = ".$_SESSION["canal_id"]."
					GROUP BY comollego ";
		}
	} else {

		if (isset($_POST['fecha1'])  or isset($_GET['fecha1'])) {
			if ($_POST['tiporeporte'] == 'Ingresadas') {
				$tipofecha = "fecha";
			} else {
				$tipofecha = "fechafact";
			}


			$sqlven0 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego'and anulada<>'1' and canal =0
			GROUP BY vendedor";


			$sqlven1 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego'and anulada<>'1' and canal =1
			GROUP BY vendedor";

			$sqlven2 = "SELECT SUM(v.valortotal) AS Total,
			v.vendedor AS Vendedor
			FROM covidsales v 
			where
			convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego'and anulada<>'1' and canal =2
			GROUP BY vendedor";



			$sqlven3 = "SELECT   v.comollego AS comollego, fp.Directo,fp.Tienda, fp.LinktoPay, fp.Transferencia, fp.Paymentez, fp.Tarjeta
					FROM covidsales v 
					inner join (select  comollego, 
					sum(case when formapago='Directo' then valortotal else 0 end )as Directo,
					sum(case when formapago='Tienda' then valortotal else 0 end )as Tienda,
					sum(case when formapago='LinkToPay' then valortotal else 0 end) as LinktoPay,
					sum(case when formapago='Transferencia' then valortotal else 0 end) as Transferencia,
					sum(case when formapago='Paymentez' then valortotal else 0 end) as Paymentez,
					sum(case when formapago='Tarjeta' then valortotal else 0 end) as Tarjeta
					from covidsales where 
					convert($tipofecha,date) between '$myfecha11' and '$myfecha21' and anulada<>'1'
					group by comollego) fp on fp.comollego = v.comollego
					where
					convert($tipofecha,date) between '$myfecha11' and '$myfecha21'
					and anulada<>'1'GROUP BY comollego ";
		}
	}

	// echo "<br><br><br>" . $sqlven0;
	// echo "<br><br><br>" . $sqlven1;

	$resultven0 = mysqli_query($con, "$sqlven0");
	$resultven1 = mysqli_query($con, "$sqlven1");
	$resultven2 = mysqli_query($con, "$sqlven2");
	$count = mysqli_num_rows($resultven0) + mysqli_num_rows($resultven1) + +mysqli_num_rows($resultven2);
	// $result = mysqli_query($con,"$sql");
	// $count=mysqli_num_rows($result);
	//echo "<br>->:".$sql."<br>";
	// If result matched $myusername and $mypassword, table row must be 1 row
	if ($count == 0) {
		echo "No hay registros anteriores! ";
	} else {

		echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 10% align='center'  class=\"tablexx\"><tr>";
		echo "<th colspan =3 align=center width=  5% ><center>Resumen de venta por vendedor (Rango de fechas: </b>" . $myfecha1 . " al " . $myfecha2 . ")</center></th></tr>";
		echo "<th align=center width=  5% >#</th>";
		echo "<th align=center width=  5% >Vendedor</th>";
		echo "<th align=center width=  5% >Total venta</th></tr>";
		$tot0 = 0;
		$tot1 = 0;
		$tot2 = 0;
		$contador = 0;
		while ($rowven0 = mysqli_fetch_array($resultven0)) {
			$contador = $contador + 1;
			echo "<td>" . $contador . "</td>";
			echo "<td>" . $rowven0['Vendedor'] . "</td>";
			echo "<td>" . number_format($rowven0['Total'], 2) . "</td></tr>";
			$tot0 = $tot0 + $rowven0['Total'];
		}
		$totalonline = $contador;
		echo "<td><b>Total Vendedores ONLINE: <b> $contador</td><td><b>TOTAL ONLINE:</b></td><td><b>" . number_format($tot0, 2) . "</b></td></tr>";
		$contador = 0;
		while ($rowven1 = mysqli_fetch_array($resultven1)) {
			$contador = $contador + 1;
			echo "<td>" . $contador . "</td>";
			echo "<td>" . $rowven1['Vendedor'] . "</td>";
			echo "<td>" . number_format($rowven1['Total'], 2) . "</td></tr>";
			$tot1 = $tot1 + $rowven1['Total'];
		}
		$totalcallcenter = $contador;
		//		$totalvendedores = $totalcallcenter + $totalonline;
		echo "<td><b>Total Vendedores CALLCENTER: <b> $contador</td><td><b>TOTAL CALLCENTER: </b></td><td><b>" . number_format($tot1, 2) . "</b></td></tr>";
		//		$totg = $tot1 + $tot0;
		//		echo "<td><b>Total Vendedores : <b> $totalvendedores</td><td><b>TOTAL ONLINE + CALLCENTER: </b></td><td><b>" . number_format($totg, 2) . "</b></td></tr>";

		$contador = 0;
		while ($rowven2 = mysqli_fetch_array($resultven2)) {
			$contador = $contador + 1;
			echo "<td>" . $contador . "</td>";
			echo "<td>" . $rowven2['Vendedor'] . "</td>";
			echo "<td>" . number_format($rowven2['Total'], 2) . "</td></tr>";
			$tot2 = $tot2 + $rowven2['Total'];
		}
		$totalweb = $contador;
		$totalvendedores = $totalcallcenter + $totalonline + $totalweb;
		echo "<td><b>Total Vendedores WEB: <b> $contador</td><td><b>TOTAL WEB: </b></td><td><b>" . number_format($tot2, 2) . "</b></td></tr>";
		$totg = $tot1 + $tot0 + $tot2;
		echo "<td><b>Total Vendedores : <b> $totalvendedores</td><td><b>TOTAL ONLINE + CALLCENTER: </b></td><td><b>" . number_format($totg, 2) . "</b></td></tr>";

		echo "</tr></table>";
		echo "</tr></table>";
	}

	$resultven3 = mysqli_query($con, "$sqlven3");
	$count1 = mysqli_num_rows($resultven3);

	if ($count1 == 0) {
		echo "No hay registros anteriores! ";
	} else {

		echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 10% align='center'  class=\"tablexx\"><tr>";
		echo "<th align=center width=  5% >Medio</th>";
		echo "<th align=center width=  5% > C. Directo </th>";
		echo "<th align=center width=  5% > Tienda</th>";
		echo "<th align=center width=  5% > LinkToPay</th>";
		echo "<th align=center width=  5% > Paymentez</th>";
		echo "<th align=center width=  5% > Transferencia</th>";
		echo "<th align=center width=  5% > Tarjeta</th>";
		echo "<th align=center width=  5% >Total venta</th></tr>";
		$tdirecto = 0;
		$ttienda = 0;
		$tlink = 0;
		$ttransfer = 0;
		$tpay = 0;
		$ttarjeta = 0;
		$contador1 = 0;
		while ($rowven3 = mysqli_fetch_array($resultven3)) {

			echo "<td>" . $rowven3['comollego'] . "</td>";
			echo "<td>" . number_format($rowven3['Directo'], 2) . "</td>";
			echo "<td>" . number_format($rowven3['Tienda'], 2) . "</td>";
			echo "<td>" . number_format($rowven3['LinktoPay'], 2) . "</td>";
			echo "<td>" . number_format($rowven3['Paymentez'], 2) . "</td>";
			echo "<td>" . number_format($rowven3['Transferencia'], 2) . "</td>";
			echo "<td>" . number_format($rowven3['Tarjeta'], 2) . "</td>";
			$tdirecto = $tdirecto + $rowven3['Directo'];
			$ttienda = $ttienda + $rowven3['Tienda'];
			$tlink = $tlink + $rowven3['LinktoPay'];
			$ttransfer = $ttransfer + $rowven3['Transferencia'];
			$tpay = $tpay + $rowven3['Paymentez'];
			$ttarjeta = $ttarjeta + $rowven3['Tarjeta'];
			$tapli = $rowven3['Directo'] + $rowven3['Tienda'] + $rowven3['LinktoPay'] + $rowven3['Transferencia'] +  $rowven3['Paymentez'] + $rowven3['Tarjeta'];
			echo "<td><b>" . number_format($tapli, 2) . "</b></td></tr>";
		}
		$totg = $tdirecto + $ttienda + $tlink + $ttransfer + $tpay + $ttarjeta;
		echo "<td><b>Total Ventas: <b></td><td><b>" . number_format($tdirecto, 2) . "</b></td><td><b>" . number_format($ttienda, 2) .
			"</b></td><td><b>" . number_format($tlink, 2) . "</b></td><td><b>" . number_format($tpay, 2) . "</b></td><td><b>" . number_format($ttransfer, 2) .
			"</b></td><td><b>" . number_format($ttarjeta, 2) . "</b></td><td><b>" . number_format($totg, 2) . "</b></td></tr>";



		echo "</tr></table>";
		echo "</tr></table>";
	}



	mysqli_close($con);
	?>




</body>

</html>