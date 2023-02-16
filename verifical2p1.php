<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- 
<link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
 -->
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menus.css">
</head>
<?PHP
// aqui ingreso numero de guia y bultos
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");

include("conexion.php");
date_default_timezone_set('America/Guayaquil');



// Recibo el ID de la factura
if (!empty($_POST['numfac'])) { $numfac=$_POST['numfac'];}  else {$numfac=$_GET['numfac'];}
$sec=$_GET['sec'];

$sql="select * from covidsales where secuencia ='$sec' ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nombre = $row['nombres'];
$cedula = $row['cedula'];
$fecha = $row['fechafact'];
$factura = $row['factura'];
$link = $row['l2p'];
$cod = $row['l2pcodigo'];
$total = $row['valorfactura'];

$datamail = '';
$datamail .=  "<Form Action='verifical2p2.php' Method='post'>";
$datamail .=  "<center><table border=0 cellpadding=0 cellspacing=0 ></center>";
$datamail .=  "<tr> ";
$datamail .=  "<Th colspan =2><H2>Verificación de pago Link To Pay :</H2></th>";
$datamail .=  "</tr>";
 
$datamail .=  "<td >Transacción:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$sec\" > </td></tr>";
$datamail .=  "<td >Nombre:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$nombre\" > </td></tr>";
$datamail .=  "<td >Cedula / RUC:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$cedula\"></td></tr>";
$datamail .=  "<td >Fecha factuta:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$fecha\"></td></tr>";
$datamail .=  "<td >Factura:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$factura\"></td></tr>";
$datamail .=  "<td >Total:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=".number_format($total,2,",",".")."></td></tr>";
$datamail .=  "<td >Enlace Link To Pay:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$link\"></td></tr>";
$datamail .=  "<td >Código Link To Pay:</td>";
$datamail .=  "<td ><Input Type=Text Size = 40 Maxlenght=100  value=\"$cod\"></td></tr>";



$datamail .= "<Input Type=hidden Name='numfac' value='$numfac'>";
$datamail .= "<Input Type=hidden Name='sec' value='$sec'>";

$datamail .=  "<td colspan =10><br><center>Pago aprobado<input type=\"checkbox\"  onchange=\"document.getElementById('grabar').disabled = !this.checked;\" />";
$datamail .=  "<br><br><center><input type=\"submit\" name=\"Submit\" disabled=\"disabled\" value=\"Aprobar el pago\" class=\"btn btn-sm btn-primary\"  id=\"grabar\"></form><br><br></td>";

echo $datamail ;

 ?>

