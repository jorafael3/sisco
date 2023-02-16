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

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];



echo "<H2>Listado TOTAL de Ventas Rango $desde *** $hasta: <br></H2> ";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;

?>
<form name="form" action="index3.php" method="POST" width="75%">
	<table align="right">
		<tr>
			<td>
				Desde:
				<input type="date" name="desde" step="1" min="2020-01-01" max="2050-12-31" value="<?php echo date("Y-m-d"); ?>">
				Hasta:
				<input type="date" name="hasta" step="1" min="2020-01-01" max="2050-12-31" value="<?php echo date("Y-m-d"); ?>">
				Consultar
				<input name="submit" id="submit" value="Consultar" src='images/icon_preview.png' height='24' width='24' type="image">
			</td>
		</tr>
	</table>
</form>

<?php


if ($_SESSION["canal_id"] > 2) {
	$sql = " SELECT a.*, d.bodega as bodegaret FROM covidsales as a
	left join covidpickup as d on d.orden= a.secuencia  
	where canal = ".$_SESSION["canal_id"]." and convert (a.fecha,date)  between '$desde' and '$hasta' and a.anulada <>'1'  
	order by a.secuencia desc ";

} else {

	$sql = " SELECT a.*, d.bodega as bodegaret FROM covidsales as a
	left join covidpickup as d on d.orden= a.secuencia  
	where  convert (a.fecha,date)  between '$desde' and '$hasta' and a.anulada <>'1'  
	order by a.secuencia desc ";
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
<th align=center width= 30% >Venta</th>
<th align=center width= 10% >Orden<br>WEB</th>
<th align=center width= 10% >Bodega <br> Retiro</th>
<th align=center width= 10% >Bodega <br> Facturacion</th>
<th align=center width= 10% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>
<th align=center width=  5% >Fecha<br>Factura</th>
<th align=center width= 15% >Comentarios</th>
<th align=center width= 10% >Guia</th>
<th align=center width= 5% >Bultos</th>
<th align=center width=  5% >Fecha<br>Guia</th>
<th align=center width= 5% >Despacho</th>
<th align=center width=  5% >Fecha<br>Despacho</th>
<th align=center width=  5% >Valor<br>Total</th>
<th align=center width=  5% >Forma de<br>Ingreso</th>
<th align=center width=  5% >Ver</th><tr>";
while ($row = mysqli_fetch_array($result)) {
	$sec = $row['secuencia'];

	// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
	if ($row['factura'] == '') {
		echo "<td><a href=form1a.php?sec=$sec>" . $sec . "</td>";
	} else {
		echo "<td>" . $sec . "</td>";
	}
	echo "<td>" . $row['cedula'] . "</td>";
	echo "<td>" . $row['nombres'] . "</td>";
	echo "<td>" . $row['celular'] . "</td>";
	echo "<td>" . $row['ciudad'] . "</td>";
	echo "<td>" . $row['venta'] . "</td>";
	echo "<td>" . $row['ordenweb'] . "</td>";
	echo "<td>" . $row['bodegaret'] . "</td>";
	echo "<td>" . $row['bodega'] . "</td>";
	echo "<td>" . $row['formapago'] . "</td>";
	echo "<td>" . $row['vendedor'] . "</td>";
	echo "<td>" . $row['fecha'] . "</td>";


	// solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito 
	// if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
	// if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" or $row['estado']=="Enviar Docs.") and ($nivel == "20" and $row['factura']==""))
	// {
	// 	echo "<td> <a href=formp1.php?sec=$sec>".$row['estado']."</td>";
	// }
	// else
	// 	{
	// 		if (( $row['estado']=="Verif. pago" or $row['estado']=="Enviar Docs.") and $nivel == "20"){
	// 			echo "<td> <a href=formpay1.php?sec=$sec>".$row['estado']."</td>";
	// 		}
	// 		else
	// 		{
	echo "<td>" . $row['estado'] . "</td>";
	// 		}
	// 			
	// 	}

	$factura = $row['factura'];


	// si existe factura y soy despachador (nivel 30) se actuva el link para ingresar datos despacho solo si no hay despacho ingresado
	// if ($row['factura']<>'' and $nivel == "30" and $row['despacho']=='' and ($row['estado']<>'Verif. pago'))
	// {
	// echo "<td><a href=detallefactura.php?sec=$sec&numfac=$factura>".$row['factura']."</td>";
	// }
	// else
	// {
	echo "<td>" . $row['factura'] . "</td>";
	// }

	// if (($row['factura']<>'') and ($nivel == "30" )and ($row['despachofinal']=='') and ($row['bultos']<>''))
	// {
	// echo "<td><a href=detallefacturaent.php?sec=$sec&numfac=$factura>".$row['fechafact']."</td>";
	// }
	// else
	// {
	echo "<td>" . $row['fechafact'] . "</td>";
	// }
	echo "<td>" . $row['comentarios'] . "</td>";
	echo "<td>" . $row['despacho'] . "</td>";
	echo "<td>" . $row['bultos'] . "</td>";

	if ($row['fechadesp'] == '0000-00-00') {
		echo "<td></td>";
	} else {
		echo "<td>" . $row['fechadesp'] . "</td>";
	}

	echo "<td>" . $row['despachofinal'] . "</td>";
	if ($row['fechafinal'] == '0000-00-00') {
		echo "<td></td>";
	} else {
		echo "<td>" . $row['fechafinal'] . "</td>";
	}

	//echo "<td>".$row['valortotal']."</td>";
	//echo number_format("1000000",2)."<br>";
	echo "<td style=\"text-align:right\">" . number_format($row['valortotal'], 2) . "</td>";


	echo "<td>" . $row['comollego'] . "</td>";


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