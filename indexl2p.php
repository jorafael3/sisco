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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 -->

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {
	header("Location: index1.php");
}
include("barramenu.php");
//echo "<br><br><br>Usuario: ".$_SESSION['usuario']."(".$_SESSION['nivel'].")";
$nivel = $_SESSION["nivel"];
//echo "<br><br>";

// Creates string of comma-separated variables(*) for unset.
$all_vars = implode(', $', array_keys(get_defined_vars()));
unset($all_vars);





echo "<H2>Listado de Ventas mediante LINK TO PAY por verificar:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;





if ($_SESSION["canal_id"] > 2) {
	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.direccion, a.referencias, a.formapago, a.fecha,a.factura, a.ordenweb, 
 a.despacho,a.estado, a.fechafact,a.fechadesp, a.vendedor, a.facturador, a.bultos, a.despachofinal, a.fechafinal, a.usuariofinal, a.paymentez, 
 a.apruebapayz, a.despachador, a.mail, a.provincia, a.anulada, a.anuladapor, a.canal, a.aprobadocc, a.fechaanulada, a.valortotal, a.pdf, 
 a.cierrefecha, a.cierreusuario, a.bodega, a.numcuotas, a.valorcuotas,a.tcusuario, a.tipotarjeta, a.l2p, a.l2pconf, a.valorfactura,a.l2pcodigo,

b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 ,
c.comentario , COUNT(c.comentario) as coment
  FROM `covidsales` as a 
  left join covidcredito as b on a.secuencia = b.transaccion
  left join covidcaja as c on  a.secuencia = c.transaccion
    where a.canal = ".$_SESSION["canal_id"]." and (a.factura <>''  and a.formapago ='LinkToPay' and a.l2pconf ='' and a.l2pcodigo <>'' and a.anulada <>'1' ) 
    group by a.secuencia 
    order by a.secuencia desc
";
} else {
	$sql = "SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.direccion, a.referencias, a.formapago, a.fecha,a.factura, a.ordenweb, 
 a.despacho,a.estado, a.fechafact,a.fechadesp, a.vendedor, a.facturador, a.bultos, a.despachofinal, a.fechafinal, a.usuariofinal, a.paymentez, 
 a.apruebapayz, a.despachador, a.mail, a.provincia, a.anulada, a.anuladapor, a.canal, a.aprobadocc, a.fechaanulada, a.valortotal, a.pdf, 
 a.cierrefecha, a.cierreusuario, a.bodega, a.numcuotas, a.valorcuotas,a.tcusuario, a.tipotarjeta, a.l2p, a.l2pconf, a.valorfactura,a.l2pcodigo,
b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 ,
c.comentario , COUNT(c.comentario) as coment
  FROM `covidsales` as a 
  left join covidcredito as b on a.secuencia = b.transaccion
  left join covidcaja as c on  a.secuencia = c.transaccion
    where (a.factura <>''  and a.formapago ='LinkToPay' and a.l2pconf ='' and a.l2pcodigo <>'' and a.anulada <>'1' ) 
    group by a.secuencia 
    order by a.secuencia desc
";
}


//SELECT * FROM `covidsales`  where factura <>'' and formapago ='LinkToPay' and l2pcodigo <>'' and anulada <>'1' order by secuencia desc
//$row['estado']=="Tarjeta"  and $row['tcusuario']==""

//echo $sql;
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
echo "Coincidencias:" . $count;


echo "<div class=\"table-responsive-xl\">";
echo "  <table class=\"table table-hover table-bordered\" >";

// echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center' class=\"table\"><tr>";

echo "<th align=center width=  5% >#</th>
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
<th align=center width=  5% >Fecha<br>Factura</th>
<th align=center width=  5% >Código<br>LinkToPay</th>
<th align=center width=  5% >Ver</th><tr>";

// <th align=center width= 10% >Guia</th>
// <th align=center width= 5% >Bultos</th>
// <th align=center width=  5% >Fecha<br>Guia</th>
// <th align=center width= 5% >Despacho</th>
// <th align=center width=  5% >Fecha<br>Despacho</th>

while ($row = mysqli_fetch_array($result)) {

	// entro en el if si no se cumple: 1. que sea credito directo y no esten subidos los archivos
	// 2. si es pago con tarjeta y no esta aprovado, es decir tc usuario y tc fecha estan blancos

	// if (
	// ($row['estado']=="Tarjeta" and $row['tcusuario']=="") // quiere decir tc y aun no aprobado
	// and  ($row['estado']=="Directo"  )
	// )

	$sec = $row['secuencia'];

	// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
	if ($row['factura'] == '' and $nivel <> '99') {
		echo "<td><a href=form1a.php?sec=$sec>" . $sec . "</td>";
	} else {
		echo "<td>" . $sec . "</td>";
	}
	echo "<td>" . $row['cedula'] . "</td>";
	echo "<td>" . $row['nombres'] . "</td>";
	echo "<td>" . $row['celular'] . "</td>";
	echo "<td>" . $row['ciudad'] . "</td>";
	echo "<td>" . $row['venta'] . "</td>";
	echo "<td>" . $row['valortotal'] . "</td>";
	echo "<td>" . $row['ordenweb'] . "</td>";
	echo "<td>" . $row['bodega'] . "</td>";
	if ($row['formapago'] == 'Tarjeta') {
		echo "<td>" . $row['formapago'] . "<br>(" . $row['tipotarjeta'] . ")</td>";
	} elseif ($row['formapago'] == 'LinkToPay') {
		echo "<td>" . $row['formapago'] . "<br>(" . $row['l2p'] . ")</td>";
	} else {
		echo "<td>" . $row['formapago'] . "</td>";
	}

	if ($row['canal'] == 0) {
		echo "<td>" . $row['vendedor'] . "<br>(Online)</td>";
	} else {
		echo "<td>" . $row['vendedor'] . "<br>(Callcenter)</td>";
	}
	echo "<td>" . $row['fecha'] . "</td>";

	$docsok = 0;
	if ($row['doc1'] <> '') {
		$docsok = $docsok + 1;
	}
	if ($row['doc2'] <> '') {
		$docsok = $docsok + 1;
	}
	if ($row['doc3'] <> '') {
		$docsok = $docsok + 1;
	}
	if ($row['doc4'] <> '') {
		$docsok = $docsok + 1;
	}
	if ($row['doc5'] <> '') {
		$docsok = $docsok + 1;
	}
	// if (is_null($row['doc2'])){$docsok = $docsok + 1 ;} 
	// if (is_null($row['doc3'])){$docsok = $docsok + 1 ;} 
	// if (!is_null($row['doc4'])){$docsok = $docsok + 1 ;} 
	// if (!is_null($row['doc5'])){$docsok = $docsok + 1 ;} 

	////or ($row['estado']=="Facturado" and $row['estado']=="") 


	//solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito 
	//if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
	if (($row['estado'] == "Paymentez" or $row['estado'] == "Tarjeta" or $row['estado'] == "Transferencia" or $row['estado'] == "LinkToPay") and ($nivel == "20" and $row['factura'] == "")) {
		// si es tarjeta y no tiene factura y soy nivel 20 y es del callcenter y no esta aprobada por callcenter entro aqui:
		if ($row['estado'] == "Tarjeta"  and $row['tcusuario'] == "") {
			echo "<td> Falta aprobar<br>cobro TC</td>";
		} elseif ($row['estado'] == "LinkToPay"  and $row['l2pconf'] == "") {
			// 				if ($row['valorfactura']>=$min_link2pay and $row['l2pconf']=='')
			// 					{
			// 					echo "<td> <a href=apruebalp1.php?sec=$sec>APROBAR</td>";
			// 					}
			// 					else
			// 					{
			echo "<td> <a href=formp1.php?sec=$sec>" . $row['estado'] . "</td>";
			// 					}

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

	//and $docsok =5

	if ($row['estado'] == "Enviar Docs."  and $docsok < 5) {

		echo "<td>";
		if (($row['doc1'] <> '')) {
			echo "<img src='images/001_06.png' border='0' height='12' width='12'>";
		} else {
			echo "<img src='images/001_05.png' border='0' height='12' width='12'>";
		}
		if (($row['doc2'] <> '')) {
			echo "<img src='images/001_06.png' border='0' height='12' width='12'>";
		} else {
			echo "<img src='images/001_05.png' border='0' height='12' width='12'>";
		}
		if (($row['doc3'] <> '')) {
			echo "<img src='images/001_06.png' border='0' height='12' width='12'>";
		} else {
			echo "<img src='images/001_05.png' border='0' height='12' width='12'>";
		}
		if (($row['doc4'] <> '')) {
			echo "<img src='images/001_06.png' border='0' height='12' width='12'>";
		} else {
			echo "<img src='images/001_05.png' border='0' height='12' width='12'>";
		}
		if (($row['doc5'] <> '')) {
			echo "<img src='images/001_06.png' border='0' height='12' width='12'>";
		} else {
			echo "<img src='images/001_05.png' border='0' height='12' width='12'>";
		}

		echo "</td>";
	} else {
		if ($docsok == 5) {
			echo "<td align=center  ><a href=formp1.php?sec=$sec>  <img src='images/001_06.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
		} else {
			$factura = $row['factura'];
			echo "<td>" . $row['factura'] . "</td>";
		}
	}


	echo "<td>" . $row['fechafact'] . "</td>";

	echo "<td><a href=verifical2p1.php?sec=$sec&numfac=$factura>" . $row['l2pcodigo'] . "</a></td>";

	// si no hay factura veo verorden1, si ya hay factura veo verorden2
	if ($row['factura'] == "") {
		echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
	} else {
		echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
	}
} // fin del while

echo "  </table>";
echo "</div>";



die();





?>





</html>