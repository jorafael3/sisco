
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menumin.css">

</head>
<?php
// para aplicar el pago a las que son Paymentez, credito directo o transferencias

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
$sec= $_GET['sec'] ;
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$sql = "SELECT * FROM covidsales where secuencia = $sec ";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nombre = $row['nombres'];
$cedula = $row['cedula'];
$celular = $row['celular'];
$ciudad = $row['ciudad'];
$direccion = $row['direccion'];
$referencias = $row['referencias'];
$venta = $row['venta'];
$formapago = $row['formapago'];
$ordenweb = $row['ordenweb'];
$total = $row['valortotal'];


?>


<Form Action="cobratc2.php" Method="post" >



<center><table border=0 cellpadding=0 cellspacing=0 ></center>
<tr> 
<Th colspan=2><h2>Verificar pagos en compras con tarjeta de crédito</h2></th>

</tr>

<!-- 
</table>



<table border=0 cellpadding=1 cellspacing=3 width=65%>
 -->
 
<th >Nombre:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>" > </td></tr>


<th >Cedula / RUC:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>"></td></tr>


<th>Celular:</th>
<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>"></td></tr>
</tr>
<th >Valor total de la compra:</th>
<td ><Input Type=Text Size = 10 Maxlenght=10 Name="total" id="total" value="<?php echo $total?>" readonly></td></tr>

<th >Comentarios:</th>
<td ><textarea name="comentarios" rows="4" cols="100" required> 
</textarea></td>
</tr>


<Input Type=hidden Name='sec' value='<?php echo $sec;?>' >

<td ></td ><td ><Center><br><Input Type=Submit Value="CONFIRMAR PAGO DE TARJETA" class="btn btn-sm btn-primary"></Center></td>
</table>


</form>