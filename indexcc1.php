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
echo "<br><br>";
$nivel = $_SESSION["nivel"];


// Creates string of comma-separated variables(*) for unset.
$all_vars = implode(', $', array_keys(get_defined_vars()));
unset($all_vars);





echo "<H2>Listado tarjetas aprobar:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;


if ($_SESSION["canal_id"] > 2) {
	$sql = "

 SELECT a.secuencia, a.`nombres`, a.cedula,a.celular,a.ciudad, a.venta,a.direccion, a.referencias,a.formapago, a.vendedor,a.fecha,a.estado,
 a.aprobadocc,a.valortotal,a.tipotarjeta, c.doc1,c.doc2,c.doc3,
 COUNT(b.transaccion) AS llamadas FROM covidsales as a 
 left JOIN covidcobranzas as b 
 	on a.secuencia = b.transaccion 
 left JOIN coviddocumentos as c 
 	on a.secuencia = c.transaccion 
    
 where a.canal = ".$_SESSION["canal_id"]." and a.factura ='' and a.estado='Tarjeta' and a.anulada <>'1' and a.tcusuario ='' 
 and a.aprobadocc='' and a.fecha >='2020-09-30'
 GROUP BY a.secuencia,a.`nombres` order by a.secuencia desc 
 ";
} else {
	$sql = "

 SELECT a.secuencia, a.`nombres`, a.cedula,a.celular,a.ciudad, a.venta,a.direccion, a.referencias,a.formapago, a.vendedor,a.fecha,a.estado,
 a.aprobadocc,a.valortotal,a.tipotarjeta, c.doc1,c.doc2,c.doc3,
 COUNT(b.transaccion) AS llamadas FROM covidsales as a 
 left JOIN covidcobranzas as b 
 	on a.secuencia = b.transaccion 
 left JOIN coviddocumentos as c 
 	on a.secuencia = c.transaccion 
    
 where a.factura ='' and a.estado='Tarjeta' and a.anulada <>'1' and a.tcusuario ='' 
 and a.aprobadocc='' and a.fecha >='2020-09-30'
 GROUP BY a.secuencia,a.`nombres` order by a.secuencia desc 
 ";
}






//echo $sql;
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
echo "Coincidencias:" . $count;


echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center' class=\"table\"><tr>
<th align=center width=  5% >#</th>
<th align=center width=  5% >Cédula</th>
<th align=center width= 10% >Nombre</th>
<th align=center width=  5% >Teléfono</th>
<th align=center width=  5% >Ciudad</th>
<th align=center width= 10% >Venta</th>
<th align=center width= 5% >Total</th>
<th align=center width= 5% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 5% >Estado</th>
<th align=center width= 3% >llamadas<br>cobranzas</th>
<th align=center width= 3% >Cédula</th>
<th align=center width= 3% >Tarjeta</th>
<th align=center width= 3% >Voucher</th>

<th align=center width=  5% >Ver</th><tr>";
while ($row = mysqli_fetch_array($result)) {
	$sec = $row['secuencia'];

	// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
	//if ($row['factura']=='' and $nivel<>'99')
	//{echo "<td><a href=form1a.php?sec=$sec>".$sec."</td>";} else {
	echo "<td>" . $sec . "</td>";
	//}
	echo "<td>" . $row['cedula'] . "</td>";
	echo "<td>" . $row['nombres'] . "</td>";
	echo "<td>" . $row['celular'] . "</td>";
	echo "<td>" . $row['ciudad'] . "</td>";
	echo "<td>" . $row['venta'] . "</td>";
	echo "<td>" . $row['valortotal'] . "</td>";
	if ($row['formapago'] == 'Tarjeta') {
		echo "<td>" . $row['formapago'] . "<br>(" . $row['tipotarjeta'] . ")</td>";
	} else {
		echo "<td>" . $row['formapago'] . "</td>";
	}

	echo "<td>" . $row['vendedor'] . "</td>";
	echo "<td>" . $row['fecha'] . "</td>";


	if ($nivel == "10") {
		echo "<td> <a href=apruebacct1.php?sec=$sec> Ver llamadas<br>el cobro</td>";
	} else {

		//solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito 
		//if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
		if (($row['estado'] == "Paymentez" or $row['estado'] == "Tarjeta" or $row['estado'] == "Transferencia") and ($nivel == "20" and $row['factura'] == "")) {
			// si es tarjeta y no tiene factura y soy nivel 20 y es del callcenter y no esta aprobada por callcenter entro aqui:
			if ($row['estado'] == "Tarjeta"  and $row['aprobadocc'] == "") {
				echo "<td> <a href=apruebacct1.php?sec=$sec> Falta aprobar<br>el cobro</td>";
			} else {
				echo "<td> <a href=formp1.php?sec=$sec>" . $row['estado'] . "</td>";
			}
		} else {
			if (($row['estado'] == "Verif. pago") and $nivel == "20") {
				echo "<td> <a href=formpay1.php?sec=$sec>" . $row['estado'] . "</td>";
			} else {
				echo "<td>" . $row['estado'] . "</td>";
			}
		}
	}


	echo "<td>" . $row['llamadas'] . "</td>";
	if ($row['doc1']) {
		echo "<td align=center  ><a href=muestraimagen.php?sec=$sec&a=1> <center> <img src='images/cedula.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	} else {
		echo "<td align=center  ><a href=cargadocumentos.php?sec=$sec> <center> <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	}
	if ($row['doc2']) {
		echo "<td align=center  ><a href=muestraimagen.php?sec=$sec&a=2> <center> <img src='images/tarjeta.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	} else {
		echo "<td align=center  ><a href=cargadocumentos.php?sec=$sec> <center> <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	}
	if ($row['doc3']) {
		echo "<td align=center  ><a href=muestraimagen.php?sec=$sec&a=3> <center> <img src='images/voucher.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	} else {
		echo "<td align=center  ><a href=cargadocumentos.php?sec=$sec> <center> <img src='images/documents.png' alt='Vista Previa' border='0' height='24' width='24'></center></td>";
	}

	// si no hay factura veo verorden1, si ya hay factura veo verorden2
	if ($row['factura'] == "") {
		echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
	} else {
		echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
	}
}



die();





?>





</html>