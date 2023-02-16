


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("../barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
$usuario = $_SESSION["usuario"] ;

date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());

$comentarios=$_GET['com']; 

$sec=$_GET['sec'];
$myusername=$_GET['usr'];
include("../conexion.php");


/// Para MySQL
$sql = "
UPDATE `covidsales` SET `anulada`='1', `anuladapor`='$myusername', `comentarios`='$comentarios', `fechaanulada`='$fecha' where secuencia = $sec" ;

mysqli_query($con, $sql); 
mysqli_close($con);

//echo $sql;


//header("Location: usuarios1.php");
die("<br><br><br><br><h2>Transacción ".$sec." anulada por usuario: ".$myusername);

