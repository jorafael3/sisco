<!DOCTYPE html>
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


//$sql1 = "SELECT * FROM covidsales where secuencia = $sec ";
$sql1 = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.direccion, a.referencias, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega,
 a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.ordenweb, a.mail, a.bultos, a.estado, a.anulada,  a.valortotal, 
 a.facturador, a.despachofinal, a.fechafinal,
 b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 
 FROM `covidsales` as a  left join  covidcredito as b on a.secuencia = b.transaccion where a.secuencia = $sec and a.anulada<>'1' ";
//echo "<br><br><br>".$sql;
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



<form method="POST" action="uploaddocumentos.php" enctype="multipart/form-data">


<center><table border=0 cellpadding=1 cellspacing=3 width=65%></center>
 <th colspan =4><h3>Adjuntar documentación del cliente</h3></th><tr>
 <th >Registro:</th>
<td ><Input Type=Text Size = 5 Maxlenght=5 Name="reg" id="reg" value="<?php echo $sec?>"  readonly> </td>
<th >Cedula / RUC:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>" readonly></td></tr>

<th >Nombre:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>"  readonly> </td>
<th>Mail:</th>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="celular" id="mail" value="<?php echo $mail?>" readonly></td></tr>




<th>Celular:</th>
<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>" readonly></td>
<th>Ciudad:</th>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="ciudad" id="ciudad" value="<?php echo $ciudad?>" readonly></td><td colspan =2></td></tr>


<?php
session_start();
$nivel=$_SESSION["nivel"];


echo " <tr><th>Orden WEB:</th>";
echo "<td><Input Type=Text Size = 12 readonly Maxlenght=12 Name='ordenweb'  value = $ordenweb ></td><td colspan =2></td><tr>";

echo " <th>Facturado por:</th>";
echo "<td> <Input Type=Text Size = 12 Maxlenght=12 Name='facturador' value = $facturador readonly></td><td colspan =2></td><tr>";
echo " <tr><th>Estado:</th>";
echo "<td>". $estado." </td><td colspan =2></td><tr>";

echo " <th>Despacho:</th>";
echo "<td>". $despacho."</td><td colspan =2></td><tr>";

echo " <th>Entrega:</th>";
echo "<td > ". $despachofinal."</td><td colspan =2></td><tr>";
echo " <th>Fecha Entrega:</td>";
echo "<td>". $fechafinal."</td><td colspan =2></td><tr>";
//         ////////////////////////////////////////////////////////
include("conexion.php");
date_default_timezone_set('America/Guayaquil');
echo "<Input Type=hidden Name='sec' value='$sec'>";
echo "<Input Type=hidden Name='despacho' value='$despacho'>";


//echo "<br>";

//echo "<table border=1 cellpadding=3 cellspacing=1 width=80%>";
if ($row1['doc1']){echo "  <br><th>Cédula: </th><td colspan =2>".$row1['doc1']."<td><tr>";} else {echo "  <br><th>Cédula: </th><td colspan =2><input type=\"file\" name=\"file_array[0]\"  ><td><tr>";}
if ($row1['doc2']){echo "  <br><th>Tarjeta: </th><td colspan =2>".$row1['doc2']."<td><tr>";} else {echo "  <br><th>Tarjeta: </th><td colspan =2><input type=\"file\" name=\"file_array[1]\"  ><td><tr>";}
if ($row1['doc3']){echo "  <br><th>Voucher: </th><td colspan =2>".$row1['doc3']."<td><tr>";} else {echo "  <br><th>Voucher: </th><td colspan =2><input type=\"file\" name=\"file_array[2]\"  ><td><tr>";}
// echo " <p>Tabla de amortización:<input type=\"file\" name=\"file_array[]\"></p>";
// echo "  <p>Pagaré:<input type=\"file\" name=\"file_array[]\"></p>";
// echo " <p>Contrato de venta:<input type=\"file\" name=\"file_array[]\"></p>";
echo "</table>";

?>
<!-- 
<td><br>Archivo PDF:</td><td><br>
   <input type="file" name="uploadedFile" />
</td></tr>
 -->

<td colspan =13><br><Center><Input Type=Submit Value="Continuar" class="btn btn-sm btn-primary"></Center></td>
</table>


</form>