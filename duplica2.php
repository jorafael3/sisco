<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>




<?php
session_start();
include("barramenu.php");

if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("conexion.php");
date_default_timezone_set('America/Guayaquil');

$sec=$_POST['sec']; 

/// Para MySQL
// $sql = "SELECT * FROM covidsales  where secuencia = '$sec' ";
// $result = mysqli_query($con, $sql);
// $count=mysqli_num_rows($result);
// echo "Coincidencias:".$count;

$sql1 = "select * from covidsales where secuencia = '$sec' ";
//echo "<br><br><br>".$sql1."<br><br><br>";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);
$count=mysqli_num_rows($result1);
//echo "Coincidencias:".$count."<br>";

$nombre=$row1['nombres']; 
$cedula=$row1['cedula']; 
$celular=$row1['celular']; 
$ciudad=$row1['ciudad'];  
$direccion=trim($row1['direccion']); 
$referencia=trim($row1['referencias']); 
$compra=trim($row1['venta']); 
$pago=$row1['formapago']; 
$ordenweb=$row1['ordenweb'];
$mail=$row1['mail'];
$vendedor=$row1['vendedor'];
$total=$row1['total'];
$canal=$row1['canal'];
$valorcuotas=$row1['valorcuotas'];
$numcuotas=$row1['numcuotas'];
$estado=$row1['estado'];
$valortotal=$row1['valortotal'];
$fecha=$row1['fecha'];
$pickup=$row1['pickup'];
$comentarios=trim($row1['comentarios']);
// die($valorcuotas);
$sql2 = "
insert into covidsales (`cedula`,`nombres`,`celular`, `ciudad`,`direccion`,`referencias`,`venta`,`formapago`,`ordenweb`,`fecha`,`estado`,`vendedor`,`mail`,`valortotal`,`numcuotas`,`valorcuotas`,`canal`,`comentarios`,`pickup`) 
VALUES ('$row1[cedula]','$nombre','$celular','$ciudad','$direccion','$referencia','$compra','$pago','$ordenweb','$fecha','$estado','$vendedor','$mail','$valortotal','$numcuotas','$valorcuotas','$canal','$comentarios','$pickup')
" ;
 mysqli_query($con, $sql2); 

$sql3 = "
select * from covidsales where `cedula` = '$cedula' and `nombres`='$nombre' and `celular`='$celular' and `ciudad`='$ciudad' and
`direccion` like '%$direccion%' and `referencias` like '%$referencia%' and `venta` like '%$compra%' and `formapago`='$pago' and `ordenweb`= '$ordenweb' 
and `fecha`='$fecha' and `estado`='$estado' and `vendedor`= '$vendedor' and `mail`='$mail' and `valortotal`='$valortotal' and 
`numcuotas`='$numcuotas' and `valorcuotas`= '$valorcuotas' and `canal`='$canal' and `comentarios` like '%$comentarios%' and `pickup`='$pickup' ORDER BY secuencia asc" ;
$result = mysqli_query($con, $sql3); 
 echo "<br><br><br><h3>Ordenes duplicadas: ";
 while($row = mysqli_fetch_array($result)) {
  $sec=$row['secuencia'];
  echo $sec." - ";
}
echo "</h3>";
 mysqli_close($con);



// die($sql1."<br><br>".$sql2."<br><br>".$sql3."<br><br>");
 
//echo $sql;


die();
header("Location: indexcaja.php");
die();

