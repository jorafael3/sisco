<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">

<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?PHP

session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

//if (!isset($_SESSION["susername"])) {header('Location: http://app.compu-tron.net/inventario');}

//if ($_SESSION["sacceso"] <> 5) { die("Acceso no autorizado!");}

include("conexion.php");
date_default_timezone_set('America/Guayaquil');


if (!mssql_select_db('COMPUTRONSA', $link)) 
{ 
die('Unable to select database!');
} 

// Recibo el ID de la factura
if (!empty($_POST['numfac'])) { $numfac=$_POST['numfac'];}  else {$numfac=$_GET['numfac'];}
$sec=$_GET['sec'];

$busqueda = str_replace(" ","%",$busqueda);

$localtotales = '';
$cuenta =1;
$datamail = '';
$datamail .=  "<H2>Detalle de factura :<br></H2>";
//$sql="PER_Detalle_Facturas ".$numfac;
$sql="PER_Detalle_Facturas'".$numfac."' ";
//echo $sql;
$result = mssql_query(utf8_decode($sql));
				  				                    
    while ($row = mssql_fetch_array($result)) {
 				if ($row['Section']=='HEADER')
				{
						$datamail .=  "<br><br><table border=2  cellspacing=0 width=80% >";
						$datamail .=  "<tr>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Fecha</B></th>";
						$datamail .=  "<td align='left'>"  .substr($row['Fecha'],0,-14).  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Secuencia</B></th>";
						$datamail .=  "<td align='left'>"  .$row['Secuencia'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Nombre</B></th>";
						$datamail .=  "<td align='left' colspan =2>"  .$row['Nombre'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Vendedor</B></th>";
						$datamail .=  "<td align='left' colspan =2>"  .$row['Vendedor'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Otro</B></th>";
						$datamail .=  "<td align='left'>".$row['Sucursal'].  "</td><tr>";
						
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
						$datamail .=  "<td align='left'>$"  .number_format($SubTotal,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Descuento</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Descuento,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Financiamiento</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Financiamiento,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Impuesto</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Impuesto,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0 colspan =2><B>Total</B></th>";
						$datamail .=  "<td align='left' colspan =2>$"  .number_format($Total,2,",",".").  "</td><tr>";

// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>RecargoTC</B></th>";
// 						$datamail .=  "<td align='left'>$"  .number_format($RecargoTC,2,",",".").  "</td>";
// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Rent $</B></th>";
// 						$datamail .=  "<td align='left'>$"  .number_format($RentUSD,2,",",".").  "</td>";
// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Rent</B></th>";
// 						$datamail .=  "<td align='left'>"  .number_format($Rent,2,",",".").  "%</td>";
// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Rent2 $</B></th>";
// 						$datamail .=  "<td align='left'>$"  .number_format($RentUSD2,2,",",".").  "</td>";
// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Rent2</B></th>";
// 						$datamail .=  "<td align='left'>"  .number_format($Rent2,2,",",".").  "%</td>";
// 						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Rent Esp</B></th>";
// 						$datamail .=  "<td align='left'>"  .number_format($RentEsperada,2,",",".").  "%</td><tr>";


				$SubTotalt = 0;
				$Impuestot = 0;
				$Totalt = 0;
				$datamail .=  "<br><br><table border=1 class='sortable' id='myTable' cellpadding=3 cellspacing=0 width=80% >";
				$datamail .=  "<tr>";
				$datamail .=  "<th bgcolor='$color1' align=center  width=10% height=0><B>Código</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center  width=30% height=0><B>Descripción</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Cant.</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Precio</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>SubTotal </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Descuento </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Impuesto </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Total </B></th>";
// 				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>RegargoTC </B></th>";
// 				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Rent $ </B></th>";
// 				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Rent</B></th>";
// 				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Rent2 $</B></th>";
// 				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Rent 2</B></th>
				$datamail .= "<tr>";
				$SubTotalt = $row['SubTotal'];
				$Impuestot =  $row['Impuesto'];
				$Totalt =  $row['Total'];	
				$SubTotalt2 =  $row['SubTotal'];
				$TotFin =  $row['Financiamiento'];
				$Impuestot2 =  $row['Impuesto'];
				$Totalt2 = $row['Total'];
// 				$TotalTC =  $row['RecargoTC'];	
// 				$TotalRent1 =  $row['RentUSD'];
// 				$TotalRent2 =  $row['Rent'];
// 				$TotalRent3 = $row['RentUSD2'];
// 				$TotalRent4 =  $row['Rent2'];
				}
				else  // del if ($row['Section']=='HEADER')
				{				
					$datamail .=  "<td align='left'>"  .$row[utf8_decode('Código')].  "</td>";
					$datamail .=  "<td align='left'>"  .utf8_encode($row['Nombre']) .  "</td>";	  
					$datamail .=  "<td align='right'>"  .number_format($row['Cantidad'],2,",",".")  .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Precio'],2,",",".")  .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['SubTotal'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Descuento'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Impuesto'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Total'],2,",",".")   .  "</td>";
// 					$datamail .=  "<td align='right'>$"  .number_format($row['RecargoTC'],2,",",".")   .  "</td>";
// 					$datamail .=  "<td align='right'>$"  .number_format($row['RentUSD'],2,",",".")   .  "</td>";
// 					$datamail .=  "<td align='right'>"  .number_format($row['Rent'],2,",",".")   .  "%</td>";
// 					if ($row['RentUSD2'] <=  $row['RentUSD']) {
// 					$datamail .=  "<td align='right'>$"  .number_format($row['RentUSD2'],2,",",".")   .  "</td>";
// 					} else {
// 					$datamail .=  "<td align='right'><font color='red'>$"  .number_format($row['RentUSD2'],2,",",".")   .  "</td>";					
// 					}
// 					$datamail .=  "<td align='right'>"  .number_format($row['Rent2'],2,",",".")   .  "%</td>";
					$datamail .= "<tr>";
				} // del if ($row['Section']=='HEADER')				    
     }
$datamail .=  "<tr>";
$datamail .=  "<Form Action='detallefactura2.php' Method='post'>";
$datamail .= "<Input Type=hidden Name='numfac' value='$numfac'>";
$datamail .= "<Input Type=hidden Name='sec' value='$sec'>";
$datamail .="<td ># de Bultos:</td>";
$datamail .="<td ><Input Type=Number Size = 5 Maxlenght=5 Name='bultos' id='bultos' min='1' max='10' required> </td></tr>";
$datamail .="<td >Info. Envio:</td>";
$datamail .="<td ><Input Type=Text Size = 40 Maxlenght=100 Name='despacho' id='despacho' required></td></tr>";
$datamail .=  "<td colspan =13><br><center><input type=\"submit\" name=\"Submit\" value=\"Grardar Informaci'on\" class=\"btn btn-sm btn-primary\"></form><br></td>";
 
 echo $numfac."aaaa".$sec;
echo $datamail ;

 ?>




