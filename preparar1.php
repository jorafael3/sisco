<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- 
<link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
 -->
<meta name="viewport" content="width=device-width, height=device-height">
<html>

<head>
	<title>Sistema SISCO</title>
	<link rel="stylesheet" type="text/css" href="css/menus.css">
</head>
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

$localtotales = '';
$cuenta = 1;
$datamail = '';
$datamail .=  "<H2>Acopio o preparación de factura :<br></H2>";
//$sql="PER_Detalle_Facturas ".$numfac;
$sql = "PER_Detalle_Facturas'" . $numfac . "' ";
//echo "<br><br><br>".$sql;
$result = mssql_query(utf8_decode($sql));

while ($row = mssql_fetch_array($result)) {
	if ($row['Section'] == 'HEADER') {
		$datamail .=  "<center><table border=2  cellspacing=0 width=80% ></center>";
		$datamail .=  "<tr>";
		$datamail .=  "<th colspan = 12><h3>Detalle de orden </h3></th><tr>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Fecha</B></th>";
		$datamail .=  "<td align='left'>"  . substr($row['Fecha'], 0, -14) .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Secuencia</B></th>";
		$datamail .=  "<td align='left'>"  . $row['Secuencia'] .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Nombre</B></th>";
		$datamail .=  "<td align='left' colspan =2>"  . $row['Nombre'] .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Vendedor</B></th>";
		$datamail .=  "<td align='left' colspan =2>"  . $row['Vendedor'] .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Otro</B></th>";
		$datamail .=  "<td align='left'>" . $row['Sucursal'] .  "</td><tr>";

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

		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>SubTotal</B></th>";
		$datamail .=  "<td align='left'>$"  . number_format($SubTotal, 2, ",", ".") .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Descuento</B></th>";
		$datamail .=  "<td align='left'>$"  . number_format($Descuento, 2, ",", ".") .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Financiamiento</B></th>";
		$datamail .=  "<td align='left'>$"  . number_format($Financiamiento, 2, ",", ".") .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Impuesto</B></th>";
		$datamail .=  "<td align='left'>$"  . number_format($Impuesto, 2, ",", ".") .  "</td>";
		$datamail .=  "<th bgcolor='$color1' align=center height=0 colspan =2><B>Total</B></th>";
		$datamail .=  "<td align='left' colspan =2>$"  . number_format($Total, 2, ",", ".") .  "</td><tr>";



		$SubTotalt = 0;
		$Impuestot = 0;
		$Totalt = 0;
		$datamail .=  "<br><br><table border=1  cellspacing=0 width=80% >";
		$datamail .=  "<tr>";
		$datamail .=  "<th bgcolor='$color1' align=center  width=5% height=0><B>Código</B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center  width=30% height=0><B>Descripción</B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Cant.</B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Precio</B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>SubTotal </B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Descuento </B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Impuesto </B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Total </B></th>";
		$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Bodega de<br>Facturación </B></th>";
		$datamail .= "<tr>";
		$SubTotalt = $row['SubTotal'];
		$Impuestot =  $row['Impuesto'];
		$Totalt =  $row['Total'];
		$SubTotalt2 =  $row['SubTotal'];
		$TotFin =  $row['Financiamiento'];
		$Impuestot2 =  $row['Impuesto'];
		$Totalt2 = $row['Total'];
	} else  // del if ($row['Section']=='HEADER')
	{
		$datamail .=  "<td align='left'>"  . $row[utf8_decode('Código')] .  "</td>";
		$datamail .=  "<td align='left'>"  . utf8_encode($row['Nombre']) .  "</td>";
		$datamail .=  "<td align='right'>"  . number_format($row['Cantidad'], 2, ",", ".")  .  "</td>";
		$datamail .=  "<td align='right'>$"  . number_format($row['Precio'], 2, ",", ".")  .  "</td>";
		$datamail .=  "<td align='right'>$"  . number_format($row['SubTotal'], 2, ",", ".")   .  "</td>";
		$datamail .=  "<td align='right'>$"  . number_format($row['Descuento'], 2, ",", ".")   .  "</td>";
		$datamail .=  "<td align='right'>$"  . number_format($row['Impuesto'], 2, ",", ".")   .  "</td>";
		$datamail .=  "<td align='right'>$"  . number_format($row['Total'], 2, ",", ".")   .  "</td>";
		$datamail .=  "<td align='right'>"  . $row['Bodega']  .  "</td>";
		$datamail .= "<tr>";
	} // del if ($row['Section']=='HEADER')				    
}
$datamail .=  "<tr>";
$datamail .=  "<Form Action='preparar2.php' Method='post'>";
$datamail .= "<Input Type=hidden Name='numfac' value='$numfac'>";
$datamail .= "<Input Type=hidden Name='sec' value='$sec'>";

$datamail .=  "<td colspan =10><br><center>Orden completa<input type=\"checkbox\"  onchange=\"document.getElementById('grabar').disabled = !this.checked;\" />";
$datamail .=  "<br><br><center><input type=\"submit\" name=\"Submit\" disabled=\"disabled\" value=\"Guardar Información\" class=\"btn btn-sm btn-primary\"  id=\"grabar\"></form><br><br></td>";

//echo $numfac."aaaa".$sec;
echo $datamail;

?>

<!-- 
<input type="submit" name="sendNewSms" class="inputButton" id="sendNewSms" value=" Send " />

<input type="checkbox"  onchange="document.getElementById('sendNewSms').disabled = !this.checked;" />
 -->

<!-- 
<input type="checkbox" id="checkme"/>
  <input type="submit" name="sendNewSms" class="inputButton" disabled="disabled" id="sendNewSms" value=" Send2 " />

 -->