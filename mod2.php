


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());

$medio=$_POST['medio']; 
$numfac=$_POST['numfac'];               
$sec=$_POST['sec'];
$datafinalorig=$_POST['datafinalorig'];
$datadesporig=$_POST['datadesporig'];
$despacho = $_POST['despacho'];	
$bultosorig=$_POST['bultosorig'];
$bultos = $_POST['bultos'];	

//Nuevos: echo "medio".$medio."<br>";
//Nuevos: echo "despacho".$despacho."<br>";
//Originales: echo "datadesporig".$datadesporig."<br>";
//Originales: echo "datafinalorig".$datafinalorig."<br>";

if($medio==$datafinalorig and $despacho==$datadesporig)
{// SIN CAMBIOS:
header("Location: busca0.php");
}
else

{// Con Cambios:
	
	


include("conexion.php");

// Primero leo la tabla para sacar nombre y mail
$sql1 = "SELECT * FROM covidsales where secuencia = $sec ";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);
$nombre = $row1['nombres'];
$mail = $row1['mail'];
//$despacho = $row1['despacho'];
//$bultos = $row1['bultos'];


//Actualizo la informacion nueva en la DB
$sql = "
UPDATE `covidsales` SET  `fechafinal`='$fecha', `usuariofinal`='$usuario', `bultos`='$bultos' , `despachofinal`='$medio', `despacho`='$despacho'
where secuencia = '$sec' " ;

mysqli_query($con, $sql); 

//actualizo la Db de los despachos cambiados
$sql2 = "insert into covidbultos (`guiaant`,`guiaact`,`bultosant`,`bultosact`,`usuario`,`fecha`,`medioant`,`medioact`, `id`) 
VALUES ('$datadesporig','$despacho','$datadesporig','$bultos','$usuario','$fecha','$datafinalorig','$medio','$sec')";
mysqli_query($con, $sql2); 
mysqli_close($con);
//die($sql2);





header("Location: pdf1.php?sec=".$sec);
}

die();

