<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas100.css">
</head>

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("Ymd", time());
$hora = date("H:i:s", time());

//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
//echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";


$lote= $_POST['lote'] ;
$autorizacion= $_POST['autorizacion'] ;
$valor= $_POST['valor'] ;



echo "<H2>Buscar Voucher</H2>";


include("conexion.php");


$sql = "PER_Select_Voucher '20200401', '$fecha', '$lote','$valor', '$autorizacion'  ";

//echo $sql;

$result = mssql_query(utf8_decode($sql));
$count=mssql_num_rows($result);
echo "Coincidencias:".$count;


echo "<br><table border=2 cellpadding=10 cellspacing=0 width = 90% align='center'><tr>
<th align=center width=  10% >Fecha</th>
<th align=center width= 30% >Nombres</th>
<th align=center width=  10% >Factura</th>
<th align=center width=  20% >Banco</th>
<th align=center width= 10% >Valor</th>
<th align=center width= 10% >Autorización</th>
<th align=center width= 10% >Lote</th>
<th align=center width=  5% >Ver</th>
<tr>";
while ($row = mssql_fetch_array($result)) {

$fac=$row['FACT'];
//echo "<td> -- </td>";
echo "<td>".substr($row['Fecha'],0,-14)."</td>";
echo "<td>".$row['Nombre']."</td>";
//echo "<td>".utf8_encode($row['Código])."</td>";
echo "<td>".$row['FACT']."</td>";
echo "<td>".$row['Banco']."</td>";
echo "<td>".$row['VALOR']."</td>";
echo "<td>".$row['Autorizacion']."</td>";
echo "<td>".$row['Lote']."</td>";
echo "<td align=center  ><a href=verconvert.php?fac=$fac>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";


echo "<tr>";
}






 ?>


