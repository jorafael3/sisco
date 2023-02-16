<meta name="viewport" content="width=device-width, height=device-height">
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menus.css">

</head>
<?php
session_start();
require("conexion.php");
echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");

$sec= $_GET['sec'] ;
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$sql1 = "SELECT * FROM covidsales where secuencia = $sec ";

$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);
$nombre = $row1['nombres'];
$cedula = $row1['cedula'];
$celular = $row1['celular'];
$ciudad = $row1['ciudad'];
$direccion = $row1['direccion'];
$referencias = $row1['referencias'];
$venta = $row1['venta'];
$factura = $row1['factura'];
$formapago = $row1['formapago'];
$ordenweb = $row1['ordenweb'];
$mail = $row1['mail'];
$vtotal = $row1['valortotal'];

if ($row1['facturador'] == ' ') { $facturador = $row1['facturador'];} else {$facturador =' &nbsp ';}
if ($row1['estado'] <> ' ') { $estado = $row1['estado'];} else {$estado =' &nbsp ';}
if ($row1['despacho'] <> ' ') { $despacho = $row1['despacho'];} else {$despacho =' &nbsp ';}
$despachofinal = $row1['despachofinal'];
$fechafinal = $row1['fechafinal'];

?>



<form method="POST" action="upload.php" enctype="multipart/form-data">


<center><table border=0 cellpadding=1 cellspacing=3 width=65%></center>
 <th colspan =4><h3>Adjuntar PDF de guía a orden</h3></th><tr>
<td >Nombre:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>"  readonly> </td>


<td >Cedula / RUC:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>" readonly></td></tr>


<td>Celular:</td>
<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>" readonly></td>
<td>Mail:</td>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="celular" id="mail" value="<?php echo $mail?>" readonly></td></tr>
<td>Ciudad:</td>
<td colspan =3><Input Type=Text Size = 40 Maxlenght=40 Name="ciudad" id="ciudad" value="<?php echo $ciudad?>" readonly></td></tr>


<?php
session_start();
$nivel=$_SESSION["nivel"];


echo " <tr><td>Orden WEB:</td>";
echo "<td colspan =3><Input Type=Text Size = 12 readonly Maxlenght=12 Name='ordenweb'  value = $ordenweb ></td><tr>";

echo " <td>Facturado por:</td>";
echo "<td colspan =3> <Input Type=Text Size = 12 Maxlenght=12 Name='facturador' value = $facturador readonly></td><tr>";
echo " <tr><td>Estado:</td>";
echo "<td colspan =3>". $estado." </td><tr>";

echo " <td>Despacho:</td>";
echo "<td colspan =3>". $despacho."</td><tr>";

echo " <td>Entrega:</td>";
echo "<td colspan =3>". $despachofinal."</td><tr>";
echo " <td>Fecha Entrega:</td>";
echo "<td colspan =3>". $fechafinal."</td><tr>";
//         ////////////////////////////////////////////////////////
include("conexion.php");
date_default_timezone_set('America/Guayaquil');
echo "<Input Type=hidden Name='sec' value='$sec'>";
echo "<Input Type=hidden Name='despacho' value='$despacho'>";


?>
<td><br>Archivo PDF:</td><td><br>
   <input type="file" name="uploadedFile" />
</td><td></td><td></td></tr>

<td colspan =13><br><Center><Input Type=Submit Value="Continuar" class="btn btn-sm btn-primary"></Center></td>
</table>


</form>