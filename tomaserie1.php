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

//http://app.compu-tron.net/siscoc/tomaserie1.php?sec=7999&numfac=022-002-000004691

// aqui ingreso numero de guia y bultos
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
date_default_timezone_set('America/Guayaquil');

include("conexion.php");
include("conexion_mssql.php");
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
$datamail .=  "<H2>Toma de series :</H2>";
//$sql="PER_Detalle_Facturas ".$numfac;
$sql="PER_Detalle_Facturas'".$numfac."' ";
//echo "<br>".$sql."";
$result = mssql_query(utf8_decode($sql));
$zz=0; // primer contador del arreglo
$primero =0;
				  				                    
    while ($row = mssql_fetch_array($result)) {
 				if ($row['Section']=='HEADER')
				{
						$facturaid = $row['ID'];
						//echo $facturaid;
						$facturasecuencia = $row['Secuencia'];
						$datamail .=  "<center><table border=2  cellspacing=0 width=80% ></center>";
						$datamail .=  "<tr>";
						$datamail .=  "<th colspan = 12><h3>Información de despacho de orden </h3></th><tr>";
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
	
						$SubTotalt = 0;
						$Impuestot = 0;
						$sumaseries= 0;
				
						$Totalt = 0;
						$datamail .=  "<br><br><table border=1  cellpadding=5 width=80% >";
						$datamail .=  "<tr>";
						$datamail .=  "<th  bgcolor='$color1' align=center  width=15% height=0><B>Código</B></th>";
						$datamail .=  "<th bgcolor='$color1' align=center  width=70% height=0><B>Descripción</B></th>";
						$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Cant.</B></th>";
						$datamail .=  "<th bgcolor='$color1' align=center   height=5><B>Series<br>pendientes</B></th>";
						$datamail .=  "<th bgcolor='$color1' align=center   width=5%><B>Bodega de<br>Facturación </B></th>";
						$datamail .= "<tr>";
				}
				else  // del if ($row['Section']=='HEADER')
				{	
					// Meto todos unificados en un arreglo
					if ($zz==0 and  $primero==0 ) 
					{
						$primero =1;
						$arreglo[$zz][1]=$row[utf8_decode('Código')];
						$arreglo[$zz][2]=$row[utf8_decode('Nombre')];
						$arreglo[$zz][3]=$row[utf8_decode('Cantidad')];
						$arreglo[$zz][4]=$row[utf8_decode('Bodega')];
						$arreglo[$zz][5]=$row[utf8_decode('IsSerie')];
						$arreglo[$zz][6]=$row[utf8_decode('ID')];
						$arreglo[$zz][7]=$row[utf8_decode('SeriePend')];
					}
					else
					{
						$encontrado = 0; $posi=0;
						for ($x = 0; $x <= $zz; $x++) {
							   if ($arreglo[$x][1]==$row[utf8_decode('Código')])
								{
									$encontrado =1; $posi = $x; 
								}
						}
						if ($encontrado =='1')
						{ 
							$arreglo[$posi][3] = $arreglo[$posi][3] + $row[utf8_decode('Cantidad')];
						}
						else
						{
							$zz++;
							$arreglo[$zz][1]=$row[utf8_decode('Código')];
							$arreglo[$zz][2]=$row[utf8_decode('Nombre')];
							$arreglo[$zz][3]=$row[utf8_decode('Cantidad')];
							$arreglo[$zz][4]=$row[utf8_decode('Bodega')];
							$arreglo[$zz][5]=$row[utf8_decode('IsSerie')];
							$arreglo[$zz][6]=$row[utf8_decode('ID')];
							$arreglo[$zz][7]=$row[utf8_decode('SeriePend')];
						}
					}
				
				}
			}
			// print "<pre>";
			// print_r($arreglo);
			// print "</pre>";	
				



// $sql="PER_Detalle_Facturas'".$numfac."' ";
// $result = mssql_query(utf8_decode($sql));
$aitems = count($arreglo);
$citems = 0;
while ($citems < $aitems) {
		$articuloid = $arreglo[$citems][6];
		// $sql2 = "SELECT * FROM SERIES where  FACTURA = '$facturaid' and SECUENCIA = '$facturasecuencia'and ARTICULO = '$articuloid'  "; 
		// $result2 = mssql_query(utf8_decode($sql2));
		// $count2=mssql_num_rows($result2);
		$can = $arreglo[$citems][3];
		$porleer = $arreglo[$citems][7];
		$pname = str_replace(" ","_",$arreglo[$citems][2]);
		$datamail .=  "<td align='left'>"  .$arreglo[$citems][1].  "</td>";
		$datamail .=  "<td align='left'>"  .$arreglo[$citems][2] .  "</td>";	  
		$datamail .=  "<td ><center>"  .$arreglo[$citems][3] .  "</center></td>";
		if ($arreglo[$citems][7] >0 and $arreglo[$citems][5]=='SI')
		{
				$sumaseries= 1; //si entro aqui es porque falta de tomar series y marco sumaseries =1 para indicar que estan incomletas
				$datamail .=  "<td><center> <a href=tomaserie2.php?sec=$sec&fid=$facturaid&sid=$facturasecuencia&aid=$articuloid&cod=$cod&can=$porleer&pname=$pname>".$arreglo[$citems][7]."</a></center></td>";
		}
		else
				{
					//$datamail .=  "<td ><center>"  .$arreglo[$citems][7].  "</center></td>";
					$datamail .=  "<td ><center> - </center></td>";
				}


		$datamail .=  "<td ><center>"  .$arreglo[$citems][4] .  "</center></td></tr>";



		$citems++;
}


				  				                    
$datamail .=  "<tr>";

$datamail .= "</select></td></table>";

echo $datamail ;
if ($sumaseries ==0) // si las series estan completas las marco asi en covidsales
{
$sqli = "UPDATE covidsales set series ='1' where secuencia ='$sec' and factura ='$numfac' ";
mysqli_query($con, $sqli);
}

 ?>




