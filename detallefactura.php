<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema SISCO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://code.jquery.com/jquery-git.js"></script>


	<link rel="stylesheet" type="text/css" href="css/tablas.css">
	<link rel="stylesheet" type="text/css" href="css/boton.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


	<meta name="viewport" content="width=device-width, height=device-height">
	<html>

	<!-- <head> -->
	<title>Sistema SISCO</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/menus.css"> -->

</head>
<html>

<body>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#ddlpickup").change(function() {
				if ($(this).val() == "Casillero") {
					$("#casilleros").show();
				} else {
					$("#casilleros").hide();
				}
			});
		});
	</script>


	<?PHP
	// aqui ingreso numero de guia y bultos
	session_cache_limiter('private, must-revalidate');
	session_cache_expire(60);

	session_start();
	if (!isset($_SESSION["usuario"])) {
		header("Location: index1.php");
	}
	include("barramenu.php");

	include("conexion.php");
	date_default_timezone_set('America/Guayaquil');


	if (!mssql_select_db('COMPUTRONSA', $link)) {
		die('Unable to select database!');
	}

	// Recibo el ID de la factura
	if (!empty($_POST['numfac'])) {
		$numfac = $_POST['numfac'];
	} else {
		$numfac = $_GET['numfac'];
	}
	$sec = $_GET['sec'];

	$busqueda = str_replace(" ", "%", $busqueda);

	$sqlcas = "select * from covidsales where secuencia ='$sec' ";

	$resultcas = mysqli_query($con, $sqlcas);
	while ($rowcas = mysqli_fetch_array($resultcas)) {
		$casillero = $rowcas['casillero'];
		$bodega = $rowcas['bodega'];
		$pickup = $rowcas['pickup'];
	}
	//die('Bodega' . $bodega);
	$localtotales = '';
	$cuenta = 1;
	echo "<div id='principal'>";
	echo  "<H2>Detalle de factura :</H2>";
	//$sql="PER_Detalle_Facturas ".$numfac;
	$sql = "PER_Detalle_Facturas'" . $numfac . "' ";
	$result = mssql_query(utf8_decode($sql));

	while ($row = mssql_fetch_array($result)) {
		if ($row['Section'] == 'HEADER') {
			echo  "<center><table border=2  cellspacing=0 width=80% ></center>";
			echo "<tr>";
			echo  "<th colspan = 12><h3>Información de despacho de orden </h3></th><tr>";
			echo  "<th bgcolor='$color1' align=center height=0><B>Fecha</B></th>";
			echo "<td align='left'>"  . substr($row['Fecha'], 0, -14) .  "</td>";
			echo  "<th bgcolor='$color1' align=center height=0><B>Secuencia</B></th>";
			echo "<td align='left'>"  . $row['Secuencia'] .  "</td>";
			echo "<th bgcolor='$color1' align=center height=0><B>Nombre</B></th>";
			echo  "<td align='left' colspan =2>"  . $row['Nombre'] .  "</td>";
			echo  "<th bgcolor='$color1' align=center height=0><B>Vendedor</B></th>";
			echo  "<td align='left' colspan =2>"  . $row['Vendedor'] .  "</td>";
			echo "<th bgcolor='$color1' align=center height=0><B>Otro</B></th>";
			echo  "<td align='left'>" . $row['Sucursal'] .  "</td><tr>";

			$SubTotal = $row['SubTotal'];
			$Descuento = $row['Descuento'];
			$Financiamiento = $row['Financiamiento'];
			$Impuestos = $row['Impuestos'];
			$Total = $row['Total'];
			$RentUSD = $row['RentUSD'];
			$Rent = $row['Rent'];
			$RentUSD2 = $row['RentUSD2'];
			$Rent2 = $row['Rent2'];
			$RetEsperada = $row['RetEsperada'];
			$Sucursal = $row['Sucursal'];
			$RecargoTC = $row['RecargoTC'];

			echo "<th bgcolor='$color1' align=center height=0><B>SubTotal</B></th>";
			echo "<td align='left'>$"  . number_format($SubTotal, 2, ",", ".") .  "</td>";
			echo "<th bgcolor='$color1' align=center height=0><B>Descuento</B></th>";
			echo "<td align='left'>$"  . number_format($Descuento, 2, ",", ".") .  "</td>";
			echo "<th bgcolor='$color1' align=center height=0><B>Financiamiento</B></th>";
			echo "<td align='left'>$"  . number_format($Financiamiento, 2, ",", ".") .  "</td>";
			echo  "<th bgcolor='$color1' align=center height=0><B>Impuesto</B></th>";
			echo "<td align='left'>$"  . number_format($Impuesto, 2, ",", ".") .  "</td>";
			echo "<th bgcolor='$color1' align=center height=0 colspan =2><B>Total</B></th>";
			echo "<td align='left' colspan =2>$"  . number_format($Total, 2, ",", ".") .  "</td><tr>";



			$SubTotalt = 0;
			$Impuestot = 0;
			$Totalt = 0;
			//echo  "</table><table border=1  cellspacing=0 width=80% >";
			echo  "<tr>";
			echo "<th bgcolor='$color1' align=center  colspan =2><B>Código</B></th>";
			echo "<th bgcolor='$color1' align=center colspan =4><B>Descripción</B></th>";
			echo "<th bgcolor='$color1' align=center ><B>Cant.</B></th>";
			echo "<th bgcolor='$color1' align=center  ><B>Precio</B></th>";
			echo  "<th bgcolor='$color1' align=center ><B>SubTotal </B></th>";
			echo  "<th bgcolor='$color1' align=center ><B>Descuento </B></th>";
			echo  "<th bgcolor='$color1' align=center <B>Impuesto </B></th>";
			echo "<th bgcolor='$color1' align=center ><B>Total </B></th>";
			echo "<tr>";
			$SubTotalt = $row['SubTotal'];
			$Impuestot =  $row['Impuesto'];
			$Totalt =  $row['Total'];
			$SubTotalt2 =  $row['SubTotal'];
			$TotFin =  $row['Financiamiento'];
			$Impuestot2 =  $row['Impuesto'];
			$Totalt2 = $row['Total'];
		} else  // del if ($row['Section']=='HEADER')
		{
			echo  "<td align='left' colspan =2>"  . $row[utf8_decode('Codigo')] .  "</td>";
			echo  "<td align='left' colspan =4>"  . utf8_encode($row['Nombre']) .  "</td>";
			echo "<td align='right'>"  . number_format($row['Cantidad'], 2, ",", ".")  .  "</td>";
			echo  "<td align='right'>$"  . number_format($row['Precio'], 2, ",", ".")  .  "</td>";
			echo  "<td align='right'>$"  . number_format($row['SubTotal'], 2, ",", ".")   .  "</td>";
			echo "<td align='right'>$"  . number_format($row['Descuento'], 2, ",", ".")   .  "</td>";
			echo "<td align='right'>$"  . number_format($row['Impuesto'], 2, ",", ".")   .  "</td>";
			echo  "<td align='right'>$"  . number_format($row['Total'], 2, ",", ".")   .  "</td>";
			echo "<tr>";
		} // del if ($row['Section']=='HEADER')				    
	}
	echo "<tr>";
	echo  "<Form Action='detallefactura2.php' Method='post'>";
	echo "<Input Type=hidden Name='numfac' value='$numfac'>";
	echo "<Input Type=hidden Name='sec' value='$sec'>";
	echo "<th colspan =2>Forma de Despacho:</th><td>";
	//<select name="pago" id = "ddlcredito" onchange = "ShowHideDiv()" required>
	echo "<select name='medio' required id = 'ddlpickup'  onchange = 'ShowHideDiv()' >";
	if ($pickup == '0') {
		echo "  <option value='Urbano'>Urbano</option>";
		echo "  <option value='Tramaco'>Tramaco</option>";
		echo "  <option value='Servientrega'>Servientrega</option>";
		echo " <option value='Vehiculo Computron'>Vehiculo Computron</option>";
		echo " <option value='Entrega en tienda'>Entrega en tienda</option>";
		echo " <option value='Casillero'>Casillero</option>";
	} else {
		if ($casillero == "SI") {
			echo " <option value='Entrega en tienda'>Entrega en tienda</option>";
			echo " <option value='Casillero' selected>Casillero</option>";
		} else {
			echo " <option value='Entrega en tienda'>Entrega en tienda</option>";
			echo " <option value='Casillero'>Casillero</option>";
		}
	}


	echo "</select></td>";

	echo "<th colspan =2>Info. Envio:</th>";
	if ($pickup == '0') {
		echo "<td colspan =5><br><Input Type=Text Size = 20 Maxlenght=100 Name='despacho' id='despacho' required>*<br> *Si el despacho es con URBANO, ingrese únicamente el número de guía sin comentarios adicionales</td>";
	} else {
		echo "<td colspan =5><br><Input Type=Text Size = 20 Maxlenght=100 Name='despacho' id='despacho' readonly placeholder = 'PICKUP'>*<br> *Si el despacho es con URBANO, ingrese únicamente el número de guía sin comentarios adicionales</td>";
	}
	echo "<th ># de Bultos:</th>";
	echo "<td colspan =2><Input Type=Number Size = 5 Maxlenght=5 Name='bultos' id='bultos' min='1' max='10' required> </td></tr>";

	echo "</table>";

	if ($casillero == "SI") {
		echo "<div id=\"casilleros\" style=\"display: inline\">";
	} else {
		echo "<div id=\"casilleros\" style=\"display: none\">";
	}

	echo "<table border=1 cellspacing=0 width=80%>";



	include("conexioncas.php");
	$sqlocup = "SELECT a.secuencia, a.localid, a.lockerid, a.posicion, a.ocupado, a.medidas,a.reserva, b.localid, b.lockerid, b.bodega
	FROM `lockers` as a 
	left join `locales` as b
	on a.localid=b.localid and a.lockerid=b.lockerid
	where b.bodega='$bodega' ";
	//$datamail2 .=  "</table><br><br><table border=1  cellspacing=0 >";

	echo "<th colspan =2>Bodega</th><th>Casillero</th><th>Ocupado</th><th colspan =2 >Medidas</th><th colspan =2> </th></tr>";

	$resultocup = mysqli_query($concom, $sqlocup);


	while ($rowocup = mysqli_fetch_array($resultocup)) {
		$posicion = $rowocup['posicion'];
		$ocupado = $rowocup['ocupado'];
		$reservado = $rowocup['reserva'];
		$localid = $rowocup['localid'];
		$lockerid = $rowocup['lockerid'];

		if ($ocupado == 0 and strlen($reservado) < 4) {
			$ocupadodt = "Libre";
		} else {

			$ocupadodt = "<b>Ocupado</b>";
		}

		$medidas = $rowocup['medidas'];
		echo "<td colspan =2>" . $bodega . "</td>";
		echo "<td colspan =1>" . $posicion . "</td>";
		echo "<td colspan =1>" . $ocupadodt . " </td>";
		echo "<td colspan =2>" . $medidas . " </td>";
		if ($ocupadodt == "Libre") {
			echo "<td colspan =2> <input type='radio' value='$posicion' name='radio[]' />&nbsp&nbsp&nbspReservar  casillero</td></tr>";
		} else {
			echo "<td colspan =2>&nbsp</td></tr>";
		}

		//echo "<td colspan =2> <input type='radio' value='$posicion' name='radio[]' />&nbsp&nbsp&nbspReservar  casillero</td></tr>";
		//echo "<td align=center  ><center><input type='checkbox' value='.$sec.' name='checkbox[]'/></center></td></tr>";
		// <input type="radio" id="male" name="gender" value="male">
	}
	echo "<Input Type=hidden Name='localid' value='$localid'>";
	echo "<Input Type=hidden Name='lockerid' value='$lockerid'>";
	echo "<Input Type=hidden Name='local' value='$bodega'>";


	echo "</table>";
	echo "</div>";
	echo "<table border=0 cellspacing=0 width=100%>";
	echo "<td colspan =14><br><center><input type=\"submit\" name=\"Submit\" value=\"Grardar Información\" class=\"btn btn-sm btn-primary\"></form><br></td>";
	echo "</table>";

	//echo $datamail;
	//echo $datamail2;

	?>