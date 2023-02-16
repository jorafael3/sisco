


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());


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
$comentarios=$_POST['comentarios'];

include("conexion.php");

$estado = 'Verif. pago';



/// Para MySQL
$sql = "
UPDATE `covidsales` SET `comentcc` = '$comentarios', `aprobadocc` = '$usuario' where secuencia = $sec" ;
mysqli_query($con, $sql); 
mysqli_close($con);




header("Location: blanco.php");
die();

