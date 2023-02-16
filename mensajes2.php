


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh=$fecha." ".$hora;

$destinatario=$_POST['destinatario']; 
$mensaje=$_POST['mensaje']; 

if (trim($mensaje)=='' ){die("<br><br><h3>Debe ingresar el mensaje...</h3>");}

include("conexion.php");
    	$sql = "
		INSERT INTO `covidmensajes`( `fechaingreso`, `usuariode`, `usuariopara`, `mensaje`, `leido`) 
		values( '$fh', '$usuario','$destinatario', '$mensaje' , 0) " ;
		mysqli_query($con, $sql); 
		mysqli_close($con);

    

header("Location: mensajes1.php");

die();

