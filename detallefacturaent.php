<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?PHP
// aqui pongo si es urbano, pick up o despacho carro computron
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

//if (!isset($_SESSION["susername"])) {header('Location: http://app.compu-tron.net/inventario');}

//if ($_SESSION["sacceso"] <> 5) { die("Acceso no autorizado!");}

include("conexion.php");
date_default_timezone_set('America/Guayaquil');

// Recibo el ID de la factura
if (!empty($_POST['numfac'])) { $numfac=$_POST['numfac'];}  else {$numfac=$_GET['numfac'];}
$sec=$_GET['sec'];

//antes de leer factura leo los bultos y demas cosas
$sqlmy = "SELECT * FROM covidsales where secuencia = '$sec' ";
$resultmy = mysqli_query($con, $sqlmy);
$rowmy = mysqli_fetch_array($resultmy);
$bultos = $rowmy['bultos'];
$datadesp = $rowmy['despacho'];

if (!mssql_select_db('COMPUTRONSA', $link)) 
{ 
die('Unable to select database!');
} 


$busqueda = str_replace(" ","%",$busqueda);

$localtotales = '';
$cuenta =1;
$datamail = '';
$datamail .=  "<br><br><br><H2>Detalle de factura : ".$numfac."</H2>";
//$sql="PER_Detalle_Facturas ".$numfac;
$sql="PER_Detalle_Facturas'".$numfac."' ";
//echo $sql;
$result = mssql_query(utf8_decode($sql));
				  				                    
    while ($row = mssql_fetch_array($result)) {
 				if ($row['Section']=='HEADER')
				{
						$datamail .=  "<table border=2  cellspacing=0 width=80% >";
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



				$SubTotalt = 0;
				$Impuestot = 0;
				$Totalt = 0;
				$datamail .=  "<br><br><table border=1  cellspacing=0 width=80% >";
				$datamail .=  "<tr>";
				$datamail .=  "<th bgcolor='$color1' align=center  width=10% height=0><B>Código</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center  width=30% height=0><B>Descripción</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Cant.</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Precio</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>SubTotal </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Descuento </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Impuesto </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Total </B></th>";
				$datamail .= "<tr>";
				$SubTotalt = $row['SubTotal'];
				$Impuestot =  $row['Impuesto'];
				$Totalt =  $row['Total'];	
				$SubTotalt2 =  $row['SubTotal'];
				$TotFin =  $row['Financiamiento'];
				$Impuestot2 =  $row['Impuesto'];
				$Totalt2 = $row['Total'];
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
					$datamail .= "<tr>";
				} // del if ($row['Section']=='HEADER')				    
     }
$datamail .=  "<tr>";
$datamail .=  "<Form Action='detallefacturaent2.php' Method='post'>";
$datamail .= "<Input Type=hidden Name='numfac' value='$numfac'>";
$datamail .= "<Input Type=hidden Name='sec' value='$sec'>";
$datamail .="<td ># de Bultos:</td>";
$datamail .="<td >".$bultos." </td>";
$datamail .="<td >Info. Envio:</td>";
$datamail .="<td colspan =3>".$datadesp."</td>";

$datamail .= "<td>Forma de Despacho:</td><td>";
$datamail .= "<select name='medio'>";
$datamail .= "  <option value='Urbano'>Urbano</option>";
 $datamail .= " <option value='Vehiculo Computron'>Vehiculo Computron</option>";
 $datamail .= " <option value='Entregado en tienda'>Entregado en tienda</option>";

$datamail .= "</select></td></tr>";

$datamail .=  "<td colspan =13><br><center><input type=\"submit\" name=\"Submit\" value=\"Grardar Informaci'on\" class=\"btn btn-sm btn-primary\"></form><br></td>";
 
 //echo $numfac."aaaa".$sec;
echo $datamail ;

 ?>




