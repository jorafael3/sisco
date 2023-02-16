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
if (!isset($_SESSION["usuario"])) {
	header("Location: index1.php");
}
include("barramenu.php");

//echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
$nivel = $_SESSION["nivel"];


// Creates string of comma-separated variables(*) for unset.
$all_vars = implode(', $', array_keys(get_defined_vars()));
unset($all_vars);





echo "<H2>Listado de Ventas con documentación de crédito aprobada :<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

if ($_SESSION["canal_id"] > 2) {
	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega,a.fecha, 
	a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,  
	b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 , b.completo 
	FROM `covidsales` as a  left join  covidcredito as b on a.secuencia = b.transaccion 
	where  a.formapago ='Directo' 
	and a.anulada<>'1' 
	and a.canal = ".$_SESSION["canal_id"]."
	and a.fecha>='2020/05/01' and b.completo ='SI'
	order by secuencia desc ";
} else {
	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega,a.fecha, 
	a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,  
	b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 , b.completo 
	FROM `covidsales` as a  left join  covidcredito as b on a.secuencia = b.transaccion 
	where  a.formapago ='Directo' 
	and a.anulada<>'1' 
	and a.fecha>='2020/05/01' and b.completo ='SI'
	 order by secuencia desc ";
}


//$sql ="select * from covidsales where secuencia ='6105' ";



mysqli_free_result($result);
//echo $sql."<br>";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
echo "Coincidencias:" . $count;

echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center' class=\"table\"><tr>
<th align=center width=  5% >#</th>
<th align=center width=  5% >Cédula</th>
<th align=center width= 10% >Nombre</th>
<th align=center width=  5% >Teléfono</th>
<th align=center width=  5% >Ciudad</th>
<th align=center width= 30% >Venta</th>
<th align=center width= 5% >Total</th>
<th align=center width= 10% >Orden<br>WEB</th>
<th align=center width= 10% >Bodega</th>
<th align=center width= 10% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>
<th align=center width=  5% >Solic.</th>
<th align=center width=  5% >Tabla<br>amort.</th>
<th align=center width=  5% >Pagaré</th>
<th align=center width=  5% >Cont.<br>venta</th>
<th align=center width=  5% >Otro</th>
<th align=center width=  5% >Ver</th><tr>";


while ($row = mysqli_fetch_array($result)) {
	$sec = $row['secuencia'];


	//echo "<td><a href=form1a.php?sec=$sec>".$sec."</td>";
	echo "<td>" . $sec . "</td>";
	echo "<td>" . $row['cedula'] . "</td>";
	echo "<td>" . $row['nombres'] . "</td>";
	echo "<td>" . $row['celular'] . "</td>";
	echo "<td>" . $row['ciudad'] . "</td>";
	echo "<td>" . $row['venta'] . "</td>";
	echo "<td>" . $row['valortotal'] . "</td>";
	echo "<td>" . $row['ordenweb'] . "</td>";
	echo "<td>" . $row['bodega'] . "</td>";
	echo "<td>" . $row['formapago'] . "</td>";
	echo "<td>" . $row['vendedor'] . "</td>";
	echo "<td>" . $row['fechafact'] . "</td>";
	echo "<td>" . $row['estado'] . "</td>";
	echo "<td>" . $row['factura'] . "</td>";

	if ($row['doc1']) {
		echo "<td align=center  ><a href=muestrafoto1.php?sec=$sec&a=1>  <img src='images/pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	} else {
		echo "<td align=center  ><a href=credito.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	}
	if ($row['doc2']) {
		echo "<td align=center  ><a href=muestrafoto1.php?sec=$sec&a=2>  <img src='images/pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	} else {
		echo "<td align=center  ><a href=credito.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	}
	if ($row['doc3']) {
		echo "<td align=center  ><a href=muestrafoto1.php?sec=$sec&a=3>  <img src='images/pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	} else {
		echo "<td align=center  ><a href=credito.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	}
	if ($row['doc4']) {
		echo "<td align=center  ><a href=muestrafoto1.php?sec=$sec&a=4>  <img src='images/pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	} else {
		echo "<td align=center  ><a href=credito.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	}
	if ($row['doc5']) {
		echo "<td align=center  ><a href=muestrafoto1.php?sec=$sec&a=5>  <img src='images/pdf.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	} else {
		echo "<td align=center  ><a href=credito.php?sec=$sec>  <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
	}


	echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
}




die();





?>





</html>