<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
	<title>Sistema SISCO</title>
	<link rel="stylesheet" type="text/css" href="../css/tablas.css">
	<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
	<meta charset="utf-8">

	<head>
		<link rel="stylesheet" type="text/css" href="../css/boton.css">
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	 -->
	</head>

	<script>
		function exportTableToExcel(tableID, filename = '') {
			var downloadLink;
			var dataType = 'application/vnd.ms-excel';
			var tableSelect = document.getElementById(tableID);
			var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

			// Specify file name
			filename = filename ? filename + '.xls' : 'excel_data.xls';

			// Create download link element
			downloadLink = document.createElement("a");

			document.body.appendChild(downloadLink);

			if (navigator.msSaveOrOpenBlob) {
				var blob = new Blob(['\ufeff', tableHTML], {
					type: dataType
				});
				navigator.msSaveOrOpenBlob(blob, filename);
			} else {
				// Create a link to the file
				downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

				// Setting the file name
				downloadLink.download = filename;

				//triggering the function
				downloadLink.click();
			}
		}
	</script>

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

	date_default_timezone_set('America/Guayaquil');

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
	if (isset($_POST['estadoorden'])) {
		$estadoorden = $_POST['estadoorden'];
	} else {
		$estadoorden = '%';
	}
	// die("<br><br><br><br> vendedor".$vendedor." - ".$despacho." - ".$comollego." - ".$formapago." - ".$_POST['despacho1']);

	include("../conexion.php");

	if (isset($_POST['fecha1'])  or isset($_GET['fecha1'])) {
		if ($_POST['tiporeporte'] == 'Ingresadas') {
			$tipofecha = "fecha";
		} else {
			$tipofecha = "fechafact";
		}
		if ($_SESSION["canal_id"] > 2) {

			$sqlven0 = "SELECT * FROM covidsales v 
			where
			$tipofecha>='$myfecha11' 
			and $tipofecha<='$myfecha21' 
			and vendedor like '$vendedor' 
			and despachofinal like '$despacho' 
			and formapago like '$formapago' 
			and comollego like '$comollego' 
			and canal = ".$_SESSION["canal_id"]."
			and estado like '$estadoorden' and anulada<>'1'";
		} else {
			$sqlven0 = "SELECT * FROM covidsales v 
			where
			$tipofecha>='$myfecha11' and $tipofecha<='$myfecha21' and vendedor like '$vendedor' 
			and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
			like '$comollego' and estado like '$estadoorden' and anulada<>'1'";
		}



		// 	$sqlven1 = "SELECT * FROM covidsales v 
		// where
		// $tipofecha>='$myfecha1' and $tipofecha<='$myfecha2' and vendedor like '$vendedor' 
		//  and despachofinal like '$despacho' and formapago like '$formapago' and comollego 
		//  like '$comollego'and anulada<>'1' and canal =1";
		// }
		// echo "<br><br><br>" . $sqlven0;
		// echo "<br><br><br>" . $sqlven1;

		$result = mysqli_query($con, "$sqlven0");
		//	$resultven1 = mysqli_query($con, "$sqlven1");
		$count = mysqli_num_rows($resultven0) + mysqli_num_rows($resultven1);


		echo "<br><table  id='tblData' border=1 cellpadding=10 cellspacing=0 width = 90% align='center' class='table ' ><tr>
			<thead class='bg-info' cursor: default;\">
		
			<th align=center width=  5% >ID</th>
			<th align=center width=  5% >Cédula</th>
			<th align=center width= 10% >Nombre</th>
			<th align=center width=  5% >Teléfono</th>
			<th align=center width=  5% >Ciudad</th>";

		//<th align=center width= 30% >Venta</th>
		echo "<th align=center width= 10% >Orden<br>WEB</th>
			<th align=center width= 10% >Bodega</th>
			<th align=center width= 10% >Pago</th>
			<th align=center width=  5% >Vendedor</th>
			<th align=center width=  5% >Fecha<br>Venta</th>
			<th align=center width= 10% >Estado</th>
			<th align=center width= 10% >Factura</th>
			<th align=center width=  5% >Fecha<br>Factura</th>
			<th align=center width=  5% >Cajero</th>
			<th align=center width= 10% >Guia</th>
			<th align=center width= 5% >Bultos</th>
			<th align=center width=  5% >Fecha<br>Guia</th>
			<th align=center width= 5% >Despacho</th>
			<th align=center width=  5% >Fecha<br>Despacho</th>
			<th align=center width=  5% >Valor<br>Total</th>
			<th align=center width=  5% >Canal</th>
			<th align=center width=  5% >Forma de<br>Ingreso</th> 
			<th align=center width=  5% >Dias </th><tr>";
		echo "</thead>";

		echo "<tbody>";
		while ($row = mysqli_fetch_array($result)) {

			$sec = $row['secuencia'];

			// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
			echo "<tr>";
			if ($row['factura'] == '') {
				echo "<td><a href=form1a.php?sec=$sec>" . $sec . "</td>";
			} else {
				echo "<td>" . $sec . "</td>";
			}
			echo "<td>" . $row['cedula'] . "</td>";
			echo "<td>" . $row['nombres'] . "</td>";
			echo "<td>" . $row['celular'] . "</td>";
			echo "<td>" . $row['ciudad'] . "</td>";
			//echo "<td>" . $row['venta'] . "</td>";
			echo "<td>" . $row['ordenweb'] . "</td>";
			echo "<td>" . $row['bodega'] . "</td>";
			echo "<td>" . $row['formapago'] . "</td>";
			echo "<td>" . $row['vendedor'] . "</td>";
			echo "<td>" . $row['fecha'] . "</td>";
			echo "<td>" . $row['estado'] . "</td>";
			$factura = $row['factura'];
			echo "<td>" . $row['factura'] . "</td>";
			echo "<td>" . $row['fechafact'] . "</td>";
			echo "<td>" . $row['facturador'] . "</td>";
			echo "<td>" . $row['despacho'] . "</td>";
			echo "<td>" . $row['bultos'] . "</td>";

			if ($row['fechadesp'] == '0000-00-00') {
				echo "<td></td>";
			} else {
				echo "<td>" . $row['fechadesp'] . "</td>";
			}

			echo "<td>" . $row['despachofinal'] . "</td>";
			if ($row['fechafinal'] == '0000-00-00') {
				echo "<td></td>";
			} else {
				echo "<td>" . $row['fechafinal'] . "</td>";
			}

			//echo number_format("1000000",2)."<br>";
			//echo "<td style=\"text-align:right\">" . number_format($row['valortotal'], 2) . "</td>";
			echo "<td style=\"text-align:right\">" . number_format($row['valorfactura'], 2) . "</td>";

			$totalventa = $totalventa + $row['valorfactura'];

			echo "<td>" . $row['canal'] . "</td>";

			echo "<td>" . $row['comollego'] . "</td>";
			$fechaActual = date('Y-m-d');
			$datetime1 = date_create($row['fecha']);
			$datetime2 = date_create($fechaActual);
			$contador = date_diff($datetime1, $datetime2);
			$differenceFormat = '%a';

			echo "<td>" . $contador->format($differenceFormat) . ' dias' . "</td>";
			// si no hay factura veo verorden1, si ya hay factura veo verorden2
			// if ($row['factura'] == "") {
			// 	echo "<td align=center  ><a href=../verorden1.php?sec=$sec>  <img src='../images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
			// } else {
			// 	echo "<td align=center  ><a href=../verorden1.php?sec=$sec>  <img src='../images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
			// }

			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	// echo "<h2>Total :". number_format($totalventa,2)."<h2>";
	mysqli_close($con);
	?>
	<button onclick="exportTableToExcel('tblData')">Exportar a Excel</button>


</body>
<!-- <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script> -->


<script>

</script>

</html>