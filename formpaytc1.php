<meta name="viewport" content="width=device-width, height=device-height">
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?php
// para cobros a tarjetas


session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
echo "<br><br>";
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


<Form Action="formpaytc2.php" Method="post" >



<table border=0 cellpadding=0 cellspacing=0 >
<tr> 
<TD><h2>Cobro a tarjeta de crédito</h2></td>

</tr>

</table>



<table border=0 cellpadding=1 cellspacing=3 width=65%>
 
<td >Nombre:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>" > </td></tr>


<td >Cedula / RUC:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>"></td></tr>


<td>Celular:</td>
<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>"></td></tr>
</tr>
<td >Valor total de la compra:</td>
<td ><Input Type=Text Size = 10 Maxlenght=10 Name="total" id="total" value="<?php echo $total?>" readonly></td></tr>


<Input Type=hidden Name='sec' value='<?php echo $sec;?>' >

<td ><Center><Input Type=Submit Value="CONFIRMAR COBRO A TARJETA" class="btn btn-sm btn-primary"></Center></td>
</table>


</form>