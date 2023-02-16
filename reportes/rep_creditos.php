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
	}
	if (isset($_POST['fecha2'])) {
		$myfecha2 = $_POST['fecha2'];
	}

	//echo "Fecha".$myfecha1. $myfecha2; 
	// die("<br><br><br><br> vendedor".$vendedor." - ".$despacho." - ".$comollego." - ".$formapago." - ".$_POST['despacho1']);

	include("../conexion_mssql.php");
	include("../conexion.php");

	if (isset($_POST['fecha1'])  or isset($_GET['fecha1'])) {
		if ($_POST['tiporeporte'] == 'Ingresadas') {
			$tipofecha = "fecha";
		} else {
			$tipofecha = "fechafact";
		}
		if ($_SESSION["canal_id"] > 2) {
			$sqlven0 = "SELECT  a.despachofinal, count(a.secuencia) as creditos, count(t.RecibidoPor) as Recibidos
			FROM covidsales a
			left outer join covidcredito t 
			on t.transaccion= a.secuencia and RecibidoPor <>'' 
			where  a.anulada<> '1' 
			and a.formapago='Directo'  
			and a.canal = ".$_SESSION["canal_id"]."
			and a.fecha >'2020-11-13' and a.factura <> ''
			and convert(a.fecha,date) between '$myfecha1' and '$myfecha2'
			and a.estado= 'Despachado'
			group by a.despachofinal";
		} else {
			$sqlven0 = "SELECT  a.despachofinal, count(a.secuencia) as creditos, count(t.RecibidoPor) as Recibidos
			FROM covidsales a
			left outer join covidcredito t on t.transaccion= a.secuencia and RecibidoPor <>'' 
			where  a.anulada<> '1' and a.formapago='Directo'  and a.fecha >'2020-11-13' and a.factura <> ''
			and convert(a.fecha,date) between '$myfecha1' and '$myfecha2'
			and a.estado= 'Despachado'
			group by a.despachofinal";
		}
	}
	// echo "<br><br><br>" . $sqlven0;
	// echo "<br><br><br>" . $sqlven1;

	$resultven0 = mysqli_query($con, "$sqlven0");
	$count = mysqli_num_rows($resultven0);
	if ($count == 0) {
		echo "No hay registros anteriores! ";
	} else {

		echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 10% align='center'  class=\"tablexx\"><tr>";
		echo "<th colspan =3 align=center width=  5% ><center>Resumen de Documentos de Credito (Rango de fechas: </b>" . $myfecha1 . " al " . $myfecha2 . ")</center></th></tr>";
		echo "<th align=center width=  5% >Entrega Final</th>";
		echo "<th align=center width=  5% >Despachados</th>";
		echo "<th align=center width=  5% >Recibidos</th></tr>";
		$tot0 = 0;
		$tot1 = 0;
		while ($rowven0 = mysqli_fetch_array($resultven0)) {

			echo "<td>" . $rowven0['despachofinal'] . "</td>";
			echo "<td>" . $rowven0['creditos'] . "</td>";
			echo "<td>" . $rowven0['Recibidos'] . "</td></tr>";
			$tot0 = $tot0 + $rowven0['creditos'];
			$tot1 = $tot1 + $rowven0['Recibidos'];
		}
		$totalonline = $contador;
		echo "<td><b>Total: <b> $contador</td><td><b>" .  $tot0  . "</b></td><td><b>" .  $tot1  . "</b></td></tr>";
		echo "</tr></table>";
		echo "</tr></table>";
	}




	mysqli_close($con);
	?>




</body>

</html>