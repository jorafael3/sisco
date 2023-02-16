


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;

$nombre=$_POST['nombre']; 
$cedula=$_POST['cedula']; 
$celular=$_POST['celular']; 
$ciudad=$_POST['ciudad'];  
$direccion=$_POST['direccion']; 
$referencia=$_POST['referencia']; 
$compra=$_POST['compra']; 
$pago=$_POST['pago']; 
$ordenweb=$_POST['ordenweb'];
$factura=$_POST['factura'];
$sec=$_POST['sec'];

if (isset($_POST['comentarios'])) {$comentarios=$_POST['comentarios'];} else {$comentarios='';}

if (trim($comentarios)=='' and !isset($_POST['cargar'])){die("<br><br><h3>Debe ingresar el comentario...</h3>");}

include("conexion.php");

$estado = 'Verif. pago';

    if (isset($_POST['contacto'])) {
    	$sql = "
		insert into `covidcobranzas` (`comentario`, `usuario`, `fecha`, `transaccion`)
		values ('$comentarios', '$usuario', '$fecha' , '$sec') " ;
		mysqli_query($con, $sql); 
		mysqli_close($con);
    }
    
    
    elseif (isset($_POST['anular'])) {
    	$sql = "
		UPDATE `covidsales` SET `tccobra` = '$comentarios',`anuladapor`='$myusername',`comentarios`='$comentarios', `tcusuario` = '$usuario', `tcfecha` = '$fecha', `anulada` = '1' where secuencia = $sec" ;
		mysqli_query($con, $sql); 
		mysqli_close($con);
    }
    
    
    elseif (isset($_POST['aplicar'])) {
    	$sql = "
		UPDATE `covidsales` SET `tccobra` = '$comentarios', `tcusuario` = '$usuario', `tcfecha` = '$fh' where secuencia = $sec" ;
		mysqli_query($con, $sql); 
		mysqli_close($con);

    }
    

header("Location: blanco.php");

die();

