

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("../barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
$nivel = $_SESSION["nivel"];



 // Creates string of comma-separated variables(*) for unset.
 $all_vars = implode(', $', array_keys(get_defined_vars()));
 unset($all_vars);
 

$id= $_POST['id'] ;



echo "<br><br><br><br><H2>ANULACIÓN DE VENTA</H2>";


include("../conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant= $year-1;


if ($_SESSION["canal_id"] > 2) {
    $sql = "SELECT * FROM covidsales 
    where secuencia ='$id' 
    and canal = ".$_SESSION["canal_id"]."
    and anulada <>'1' ";


}else{
    $sql = "SELECT * FROM covidsales where secuencia ='$id' and anulada <>'1' ";

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
<th align=center width= 10% >Guia</th>
<th align=center width= 5% >Bultos</th>
<th align=center width=  5% >Fecha<br>Guia</th>
<th align=center width= 5% >Despacho</th>
<th align=center width=  5% >Fecha<br>Despacho</th><tr>";

while($row = mysqli_fetch_array($result)) 
{
$sec=$row['secuencia'];
echo "<td><a href=anula1a.php?sec=$sec> ANULAR:&nbsp".$sec."</td>";
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
echo "<td>".$row['despacho']."</td>";
echo "<td>".$row['bultos']."</td>";

echo "<td>".$row['fechadesp']."</td>";

echo "<td>".$row['despachofinal']."</td>";
echo "<td>".$row['fechafinal']."</td>";


}






 ?>


