


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh=$fecha." ".$hora;


            
$sec=$_POST['sec'];
$numfac=$_POST['numfac'];

include("conexion.php");


/// ahora actualizo la table
$sql = "UPDATE `covidsales` SET  `l2pconf`='$usuario' , `l2pfecha`='$fh' where secuencia = '$sec' " ;
mysqli_query($con, $sql); 
mysqli_close($con);



echo "<br><br><H2>Actualizando información</h2>".
header("Refresh:3; url=indexl2p.php");

//header("Location: pdf1.php?sec=".$sec);
die();

