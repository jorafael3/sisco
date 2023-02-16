<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas.css">

</head>

<?PHP
// listo las facturas anuladas

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

//echo "<br><br>";
$nivel = $_SESSION["nivel"];

include("barramenu.php");

 // Creates string of comma-separated variables(*) for unset.
 $all_vars = implode(', $', array_keys(get_defined_vars()));
 unset($all_vars);
 

$id= $_POST['id'] ;



echo "<H2>Ventas Anuladas</H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant= $year-1;




if ($_SESSION["canal_id"] > 2) {
    $sql = "SELECT * FROM covidsales 
    where anulada ='1' and canal = ".$_SESSION["canal_id"]."
    order by secuencia desc";

}else{
    $sql = "SELECT * FROM covidsales where anulada ='1' order by secuencia desc";

}


$result = mysqli_query($con, $sql);
$count=mysqli_num_rows($result);
echo "Coincidencias:".$count;


echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center'><tr>
<th align=center width=  5% >#</th>
<th align=center width=  5% >Cédula</th>
<th align=center width= 10% >Nombre</th>
<th align=center width=  5% >Teléfono</th>
<th align=center width=  5% >Ciudad</th>
<th align=center width= 30% >Venta</th>
<th align=center width= 10% >Orden<br>WEB</th>
<th align=center width= 10% >Bodega</th>
<th align=center width= 10% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>
<th align=center width=  5% >Fecha<br>Factura</th>
<th align=center width=  5% >Comentario<br>Anulacióm</th>
<th align=center width=  5% >Anulada<br>Por</th>
<th align=center width=  5% >Fecha<br>Anulacióm</th>
<th align=center width=  5% >Ver</th>
<tr>";

while($row = mysqli_fetch_array($result)) 
{
$sec=$row['secuencia'];
//echo "<td><a href=anula2.php?sec=$sec> ANULAR:&nbsp".$sec."</td>";
echo "<td>".$sec."</td>";
echo "<td>".$row['cedula']."</td>";
echo "<td>".$row['nombres']."</td>";
echo "<td>".$row['celular']."</td>";
echo "<td>".$row['ciudad']."</td>";
echo "<td>".$row['venta']."</td>";
echo "<td>".$row['ordenweb']."</td>";
echo "<td>".$row['bodega']."</td>";
echo "<td>".$row['formapago']."</td>";
echo "<td>".$row['vendedor']."</td>";
echo "<td>".$row['fecha']."</td>";
echo "<td>".$row['estado']."</td>";
			

$factura = $row['factura'];
echo "<td>".$row['factura']."</td>";
echo "<td>".$row['fechafact']."</td>";

echo "<td>".$row['comentarios']."</td>";
echo "<td>".$row['anuladapor']."</td>";
echo "<td>".$row['fechaanulada']."</td>";


echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";


}






 ?>


