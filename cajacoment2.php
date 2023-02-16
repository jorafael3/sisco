


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;

$sec = $_POST['sec'];

if (isset($_POST['comentarios'])) {$comentarios=$_POST['comentarios'];} else {$comentarios='';}

if (trim($comentarios)==''){die("<br><br><h3>Debe ingresar el comentario...</h3>");}

include("conexion.php");


    	$sql = "
		insert into `covidcaja` (`comentario`, `usuario`, `fecha`, `transaccion`)
		values ('$comentarios', '$usuario', '$fh' , '$sec') " ;
		mysqli_query($con, $sql); 
				
		mysqli_close($con);
   

header("Location: indexcaja.php");

die();

