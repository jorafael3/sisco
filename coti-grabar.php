<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>COMPUTRON CUOTAS</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
</head>
<body>

<?php

include("conexion.php");

session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");

session_start();

$vendedor = $_SESSION['usuario'];
$direccion = $_SESSION['sdireccion'];
$nombrecli = $_SESSION["snombrecli"];
$cedula = $_SESSION["scedula"];
$celular = $_SESSION["scelular"];
$ciudad = $_SESSION["sciudad"];
$referencia = $_SESSION["sreferencia"];
$mail = $_SESSION["smail"];
$plazo = $_SESSION['splazo'];
$z = sizeof($_SESSION['datosarreglos']);

$pagoforma = $_SESSION['pagoforma'];
echo "fp:".$pagoforma;
if  ( $pagoforma =='cd'  ) 
{$pagoforma = "Directo";} else {$pagoforma ='Tarjeta'; $plazo ='00'; }
//echo "fp:".$pagoforma;


$bodega = $_SESSION['sbodega'] ;
$provincia = $_SESSION['sprovincia'];
$ingresocli = $_SESSION['singresocli'];
$comentarios = $_SESSION['scomentarios'] ;
$desp = $_SESSION['sdespacho'] ; // es Pickup o Envio
if ($desp =='Envio'){$despacho =0;} else {$despacho =1;}
echo "<br><br><br>XXXXXXXXXXX<br>";
if ($pagoforma=='Directo')
	{echo "Directooooooooo";
	if ($plazo == '3') {$pos = 7;}
	if ($plazo == '6') {$pos = 8;}
	if ($plazo == '9') {$pos = 9;}
	if ($plazo == '12') {$pos = 4;}
	if ($plazo == '18') {$pos = 5;}
	if ($plazo == '24') {$pos = 6;}
	}
	else
	{echo "Tarjetaaaaaaaa";
	if ($plazo == '00') {$pos = 10;}
	}

$cuotatotal=0;
$sumtotal=0;
$descrip='';
//die("Pl:".$_SESSION['splazo']);
$sql1="INSERT INTO covidsales (cedula, nombres, celular, direccion, ciudad, referencias, mail, fecha, vendedor, comentarios, pickup, formapago)
values ('$cedula','$nombrecli', '$celular', '$direccion', '$ciudad', '$referencia', '$mail', '$fecha', '$vendedor','$comentarios','$despacho','$pagoforma')  ";
echo "Sql1:".$sql1."<br><br>";
$result1 = mysqli_query($con, $sql1); /// Para MySQL
$row1 = mysqli_fetch_array($result1);

$sql2="select * from covidsales where cedula='$cedula' and nombres='$nombrecli' and celular = '$celular'
 and direccion= '$direccion' and ciudad='$ciudad' and referencias='$referencia' and mail='$mail' and fecha='$fecha'";
 echo "Sql2:".$sql2."<br><br>";
// sql 2 para obtener el secuencial 
$result2 = mysqli_query($con, $sql2); /// Para MySQL
$row2 = mysqli_fetch_array($result2);
$sec=$row2['secuencia'];

$count =0;
$arreglo = $_SESSION['datosarreglos'];
echo "<pre>";
   print_r($arreglo);
echo "</pre>";

while($count< $z) {
		$pid = $arreglo[$count][99];
		$cod = $arreglo[$count][1];
		$des = $arreglo[$count][2];
		$valcuot = $arreglo[$count][$pos];
		$cuotatotal = $cuotatotal+floatval($valcuot);
		$sumtotal = $sumtotal+floatval($arreglo[$count][3]);
  
		//if ($plazo =='00') 
		if ($pagoforma == 'Tarjeta')
				{
				$valoritem= $arreglo[$count][10];
				$valcuot=0;
				$descrip = $descrip."COD: <strong>".$cod."</strong> DES: <strong>".$des."</strong> Valor: <strong>".$valoritem."</strong></br>";
				} 
				else
				{
				$valoritem=$arreglo[$count][3];
				$descrip = $descrip."COD: <strong>".$cod."</strong> DES: <strong>".$des."</strong> Cuotas: <strong>".$plazo."</strong> Valor: <strong>".$valoritem."</strong></br>";
				} 

		$sql3="INSERT INTO covidcotizador (`cedula`, `index`, `productoid`, `producto`,  `descripcion`,`cuota`, `plazo`, `valor`)
		values ('$cedula','$sec', '$pid', '$cod','$des',  '$valcuot', '$plazo',$valoritem)  ";
		//$result1 = mysqli_query($con, $sql3); /// Para MySQL
		echo "Sql3:".$sql3."<br><br>";
		mysqli_query($con, $sql3); /// Para MySQL

		$count++;
		}


if ($pagoforma =='Tarjeta')  // que es pago con tarjeta
		{$sql4=" update covidsales set valortotal = '$cuotatotal', formapago ='Tarjeta', estado ='Tarjeta',venta= '$descrip' where secuencia = '$sec' ";}
		else
		{
		$sql4=" update covidsales set valortotal = '$sumtotal', numcuotas ='$plazo', valorcuotas='$cuotatotal', venta= '$descrip' ,
		 estado ='Enviar Docs.', formapago ='Directo' where secuencia = '$sec' ";}
mysqli_query($con, $sql4); /// Para MySQL
echo "Sql4:".$sql4."<br><br>";

if ($despacho ==1)
		{
		$sqldesp="INSERT INTO covidpickup (`orden`, `provincia`, `bodega`)
		values ('$sec', '$provincia','$bodega')  ";
		echo "Sqldesp:".$sqldesp."<br><br>";
		mysqli_query($con, $sqldesp); /// Para MySQL

		}


mysqli_close($con);



// $nombre = $_POST['nombre'];
unset($_SESSION['datosarreglos']);
unset($_SESSION['sseguro']);
unset($_SESSION['sentrada']);
unset($_SESSION['sentrada']);
unset($_SESSION["snombre"]);
unset($_SESSION["scedula"]);
unset($_SESSION["scelular"]);
unset($_SESSION["sciudad"]);
unset($_SESSION["sreferencias"]);
unset($_SESSION["snombrecli"]);
unset($_SESSION["smail"]);
unset($_SESSION["sdireccion"]);
unset($_SESSION["sreferencia"]);

header("Location: coti-inicio.php");

?>

</body>
</html>
