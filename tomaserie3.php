

<meta charset="utf-8">
<?php
session_start();
$usuario = $_SESSION["usuario"] ;
$canal = $_SESSION["canal"] ;
include("conexion.php");
include("conexion_mssql.php");
if (!mssql_select_db('COMPUTRONSA', $link)) 
{ 
die('Unable to select database!');
}
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$sec=$_POST['sec']; 
$fid=$_POST['fid']; 
$sid=$_POST['sid']; 
$aid=$_POST['aid']; 
$can=$_POST['can']; 
$serie = $_POST['serie'];

$cod=$_POST['cod']; 
$subsec ='001';

			print "<pre>";
			print_r($serie);
			print "</pre>";	
			echo $can;


//antes de ingresar reviso que no exista serie en la tabla 
// for ($x = 0; $x < $can; $x++) {
// 	$sqlcheck = "select * from series where serie ='$serie[$x]' and articulo = '$aid'  ";
// 	//echo $sqlcheck."<br>";
// 	$resultcheck = mssql_query(utf8_decode($sqlcheck));
// 	$countcheck=mssql_num_rows($resultcheck);
// 	if ($countcheck >0 ) {die("<br><br><h1>ERROR: Serie ya registrada:".$serie[$x]  );}
// }


for ($x = 0; $x < $can; $x++) {
	// $subsec=str_pad($x+1, 3, '0', STR_PAD_LEFT);
	// $usu2=substr($usuario,0,8);
// 	$sql = "insert into series (FACTURA,SECUENCIA, SERIE, FECHA,ARTICULO,usrid,subsec) 
// 	VALUES ('$fid','$sid','$serie[$x]','$fecha','$aid','$usu2','$subsec')";
	$sql = "PER_Proceso_Insert_Series '$fid','$aid','$serie[$x]' ";
	//echo $sql."<br>";
	$resultado = mssql_query(utf8_decode($sql));
	$row = mssql_fetch_array($resultado);
	echo "Estado:".utf8_encode($row['Estado'])."<br>";
// $arr = get_defined_vars();
// echo '<pre>';
// echo print_r($row);
// echo '</pre>';
}
mssql_close($link);

echo "<br><br><h1>Actualizando información</h1>";
header("Refresh:1; url=tomaserie1.php?sec=$sec&numfac=$sid");
die();


?>



