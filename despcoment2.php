


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());

$sec = $_POST['sec'];
$cuenta = $_POST['cuenta'];

if (isset($_POST['comentarios'])) {$comentarios=$_POST['comentarios'];} else {$comentarios='';}

if (trim($comentarios)==''){die("<br><br><h3>Debe ingresar el comentario...</h3>");}

include("conexion.php");


    	$sql = "
		insert into `covidlogistica` (`comentario`, `usuario`, `fecha`, `transaccion`)
		values ('$comentarios', '$usuario', '$fecha' , '$sec') " ;
		mysqli_query($con, $sql); 
		
		$sql2 = " update covidsales set comentlogi = '$cuenta' where secuencia = '$sec' ";
		//die($sql2);
		mysqli_query($con, $sql2);
		
		mysqli_close($con);
   

header("Location: blanco.php");

die();

