<meta name="viewport" content="width=device-width, height=device-height">
<html>

<head>
	<title>Sistema SISCO</title>
	<link rel="stylesheet" type="text/css" href="css/tablas.css">
</head>

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {
	header("Location: index1.php");
}
include("barramenu.php");
//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
echo "<h3>Usuario: " . $_SESSION["usuario"] . "</h3>";
$nivel = $_SESSION["nivel"];



// Creates string of comma-separated variables(*) for unset.
$all_vars = implode(', $', array_keys(get_defined_vars()));
unset($all_vars);


$id = strtoupper($_POST['id']);



echo "<H2>Buscar venta</H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;



if ($_SESSION["canal_id"] > 2) {

	$sql = "SELECT a.*, d.bodega as bodegaret FROM covidsales as a
	left join covidpickup as d on d.orden= a.secuencia 
	where a.canal = " . $_SESSION["canal_id"] . " 
	and (a.secuencia like '%$id%' or a.factura like '%$id%' or a.despacho like '%$id%' or upper(a.nombres) like '%$id%' or a.cedula like '%$id%' or a.ordenweb like '%$id%')  ";
} else {
	$sql = "SELECT a.*, d.bodega as bodegaret FROM covidsales as a
	left join covidpickup as d on d.orden= a.secuencia 
	where (a.secuencia like '%$id%' or a.factura like '%$id%' or a.despacho like '%$id%' or upper(a.nombres) like '%$id%' or a.cedula like '%$id%' or a.ordenweb like '%$id%')  ";
}


// $sql = "SELECT * FROM covidsales where (secuencia like '%$id%' or factura like '%$id%' or despacho like '%$id%' or upper(nombres) like '%$id%' or cedula like '%$id%' or ordenweb like '%$id%') and anulada<>'1' ";

//echo $sql;
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
echo "Coincidencias:" . $count;


echo "<br><table border=2 cellpadding=10 cellspacing=0 width = 90% align='center'><tr>
<th align=center width=  5% >#</th>
<th align=center width=  5% >Cédula</th>
<th align=center width= 10% >Nombre</th>
<th align=center width=  5% >Teléfono</th>
<th align=center width=  5% >Ciudad</th>
<th align=center width= 30% >Venta</th>
<th align=center width= 5% >Total</th>
<th align=center width= 10% >Orden<br>WEB</th>
<th align=center width= 10% >Bodega <br> Retiro</th>
<th align=center width= 10% >Bodega <br> Facturacion</th>
<th align=center width= 10% >Comentarios</th>
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
<th align=center width=  5% >Fecha<br>Despacho</th>
<th align=center width=  5% ><center>Facturado<br>por</center></th>
<th align=center width=  5% >Ver</th>
<th align=center width=  5% >Forma Ingreso</th>
<th align=center width=  5% >PDF Factura</th>
<tr>";

while ($row = mysqli_fetch_array($result)) {
	$sec = $row['secuencia'];
	if ($nivel == '30') {
		echo "<td><a href=mod1.php?sec=$sec>" . $sec . "</td>";
	} else {
		echo "<td >" . $row['secuencia'] . "</td>";
	}
	if ($row['anulada'] == 1) {
		echo "<td style=\"color:red;\">" . $row['cedula'] . "</td>";
	} else {
		echo "<td>" . $row['cedula'] . "</td>";
	}

	//echo "<td style=\"color:red;\">".$row['cedula']."</td>";
	echo "<td>" . $row['nombres'] . "</td>";
	echo "<td>" . $row['celular'] . "</td>";
	echo "<td>" . $row['ciudad'] . "</td>";
	echo "<td>" . $row['venta'] . "</td>";
	echo "<td>" . $row['valortotal'] . "</td>";
	echo "<td>" . $row['ordenweb'] . "</td>";
	echo "<td>" . $row['bodegaret'] . "</td>";
	echo "<td>" . $row['bodega'] . "</td>";
	echo "<td>" . $row['comentarios'] . "</td>";
	echo "<td>" . $row['formapago'] . "</td>";
	echo "<td>" . $row['vendedor'] . "</td>";
	echo "<td>" . $row['fecha'] . "</td>";
	echo "<td>" . $row['estado'] . "</td>";


	$factura = $row['factura'];
	echo "<td>" . $row['factura'] . "</td>";
	echo "<td>" . $row['fechafact'] . "</td>";
	echo "<td>" . $row['despacho'] . "</td>";
	echo "<td>" . $row['bultos'] . "</td>";

	echo "<td>" . $row['fechadesp'] . "</td>";

	echo "<td>" . $row['despachofinal'] . "</td>";
	echo "<td>" . $row['fechafinal'] . "</td>";
	echo "<td>" . $row['facturador'] . "</td>";

	// if ($row['pdf']<>'')
	// {
	// $pdf = $row['pdf'];
	// echo "<td align=center  ><a href=muestrafoto1.php?sec=$pdf>  <img src='pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	// }
	// else
	// {
	// echo "<td> </td>";
	// }
	echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	echo "<td>" . $row['comollego'] . "</td>";

	$link = mssql_connect("10.5.1.3:1433", "jairo", "qwertys3gur0");
	if (!mssql_select_db('COMPUTRONSA', $link)) {
		die('Unable to select database!');
	}
	$sql5 = "select ruta = Autorización from ven_facturas with(nolock) where secuencia= '$factura'";
	$resultcli = mssql_query(utf8_decode($sql5));
	$rowcli = mssql_fetch_array($resultcli);
	$ruta = $rowcli['ruta'];
	//echo $ruta; 
	echo "<td> <a href=pdffactura.php?aut=$ruta >" . Factura . "</a></td></tr>";
	echo "<tr>";
}






?>