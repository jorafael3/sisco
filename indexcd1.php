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
//echo "<br><br>";
$nivel = $_SESSION["nivel"];


// Creates string of comma-separated variables(*) for unset.
$all_vars = implode(', $', array_keys(get_defined_vars()));
unset($all_vars);





echo "<H2>Listado de Ventas con documentación de crédito pendiente:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;



// $sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega,
//  a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,
//  b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 , b.completo
//  FROM `covidsales` as a  left join  covidcredito as b on a.secuencia = b.transaccion where a.estado ='Enviar Docs.' and a.anulada<>'1' and
//  (isnull(b.completo) or b.completo<>'SI' and (a.canal<>'1' or (a.canal ='1' and a.aprobadocc='' )) ) ";

// $sql = " SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega, a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,a.aprobadocc, a.canal, b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 , b.completo FROM `covidsales` as a left join covidcredito as b on a.secuencia = b.transaccion
// where
// a.estado ='Enviar Docs.' and
// a.anulada<>'1' and
// ((isnull(b.completo) or b.completo<>'SI')  and (a.canal ='1' and isnull(a.aprobadocc) )order by secuencia desc ";
if ($_SESSION["canal_id"] > 2) {

	
	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega, a.formapago, a.vendedor,
	a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,a.aprobadocc, a.canal, b.transaccion, b.doc1, b.doc2, b.doc3,
	b.doc4, b.doc5 , b.completo 
	FROM `covidsales` as a 
	left join covidcredito as b on a.secuencia = b.transaccion
	where a.estado ='Enviar Docs.' and a.canal = ".$_SESSION["canal_id"]."
	and a.anulada<>'1' and ( (isnull(b.completo) or b.completo<>'SI') and ((a.aprobadocc<>'' and a.canal in (1,0,2)) ) ) and a.fecha >='2020-09-30'order by a.secuencia";
  
} else {

	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb, a.bodega, a.formapago, a.vendedor,
	a.estado, a.factura, a.fechafact, a.despacho, a.bultos, a.estado, a.anulada,a.aprobadocc, a.canal, b.transaccion, b.doc1, b.doc2, b.doc3,
	b.doc4, b.doc5 , b.completo 
	FROM `covidsales` as a 
	left join covidcredito as b on a.secuencia = b.transaccion
	where a.estado ='Enviar Docs.'
	and a.anulada<>'1' and ( (isnull(b.completo) or b.completo<>'SI') and ((a.aprobadocc<>'' and a.canal in (1,0,2)) ) ) and a.fecha >='2020-09-30'order by a.secuencia";
}

// lo del (a.canal ='1' and isnull(a.aprobadocc) es para que no se listen las que son de callcenter a credito directo no aprobadas
//echo $sql;

$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
echo "Coincidencias:" . $count;
//$row = mysqli_fetch_array($result);

// echo '<pre>'; print_r($row); echo '</pre>';
// if ($row['doc1']){echo "1";} else {echo "2";}
// die();

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

	//if(isset$row['doc1']) {$doc1 = $row['doc1'];} else {$doc1='No';}

	//echo "<td>".$doc1."</td>";
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