

<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas.css">

</head>
<!-- 
<style>
tbody tr td {color:black;border-right:1px solid;width:100px;}
</style>
 -->

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
$nivel = $_SESSION["nivel"];



 // Creates string of comma-separated variables(*) for unset.
 $all_vars = implode(', $', array_keys(get_defined_vars()));
 unset($all_vars);
 




echo "<H2>Listado despachos sin PDF:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant= $year-1;





$sql = "SELECT * FROM covidsales  where ((despachofinal ='Urbano' or despachofinal ='Servientrega' or despachofinal ='Tramaco')and pdf ='' and anulada <>'1') order by secuencia desc ";

$result = mysqli_query($con, $sql);
$count=mysqli_num_rows($result);
echo "Coincidencias:".$count;


echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center'  class=\"table\"><tr>
<th align=center width=  5% >#</th>
<th align=center width=  5% >Cédula</th>
<th align=center width= 10% >Nombre</th>
<th align=center width=  5% >Teléfono</th>
<th align=center width=  5% >Ciudad</th>
<th align=center width= 30% >Venta</th>

<th align=center width= 10% >Bodega</th>

<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>
<th align=center width=  5% >Fecha<br>Factura</th>
<th align=center width= 10% >Guia</th>
<th align=center width= 5% >Bultos</th>
<th align=center width=  5% >Fecha<br>Guia</th>
<th align=center width= 5% >Despacho</th>
<th align=center width=  5% >Fecha<br>Despacho</th>
<th align=center width=  5% >Info.</th>
<th align=center width=  5% >PDF</th><tr>";
while($row = mysqli_fetch_array($result)) {
  $sec=$row['secuencia'];

// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
if ($row['factura']=='' and $nivel<>'99')
{
echo "<td><a href=form1a.php?sec=$sec>".$sec."</td>";}
else
{echo "<td>".$sec."</td>";}
echo "<td>".$row['cedula']."</td>";
echo "<td>".$row['nombres']."</td>";
echo "<td>".$row['celular']."</td>";
echo "<td>".$row['ciudad']."</td>";
echo "<td>".$row['venta']."</td>";

echo "<td>".$row['bodega']."</td>";

echo "<td>".$row['fecha']."</td>";



echo "<td>".$row['estado']."</td>";

$factura = $row['factura'];

echo "<td>".$row['factura']."</td>";


echo "<td>".$row['fechafact']."</td>";
echo "<td>".$row['despacho']."</td>";
echo "<td>".$row['bultos']."</td>";

if ($row['fechadesp']=='0000-00-00'){echo "<td></td>";} 
else {echo "<td>".$row['fechadesp']."</td>";}

echo "<td>".$row['despachofinal']."</td>";
if ($row['fechafinal']=='0000-00-00'){echo "<td></td>";}
else {echo "<td>".$row['fechafinal']."</td>";}
echo "<td><a href=despcoment1.php?sec=$sec>".$row['comentlogi']."</td>";

// si no hay factura veo verorden1, si ya hay factura veo verorden2
if ($row['factura']==""){
echo "<td align=center  ><a href=pdf1.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
}
else
{
echo "<td align=center  ><a href=pdf1.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
}

}



die();





 ?>





</html>
