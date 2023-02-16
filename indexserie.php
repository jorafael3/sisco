
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
echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
$nivel = $_SESSION["nivel"];


 // Creates string of comma-separated variables(*) for unset.
 $all_vars = implode(', $', array_keys(get_defined_vars()));
 unset($all_vars);
 




echo "<H2>Listado facturas por tomar series:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant= $year-1;





$sql = "SELECT * FROM covidsales where despacho ='' and despachofinal ='' and anulada <>'1' 
 and factura <>'' and estado ='Facturado' and preparada<>'' order by secuencia desc ";
//echo "<br><br><br>sql:".$sql;

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
<th align=center width= 5% >Total</th>
<th align=center width= 10% >Orden<br>WEB</th>
<th align=center width= 10% >Bodega</th>
<th align=center width= 10% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>
<th align=center width=  5% >Fecha<br>Factura</th>
<th align=center width=  5% >Info.</th>
<th align=center width=  5% >Ver</th><tr>";
while($row = mysqli_fetch_array($result)) {
  $sec=$row['secuencia'];
if ($row['pickup']==1) {$dataentrega ='Pickup';} else {$dataentrega ='Envío';}

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
echo "<td>".$row['valortotal']."</td>";
echo "<td>".$row['ordenweb']."</td>";
echo "<td>".$row['bodega']."<br>".$dataentrega."</td>";
echo "<td>".$row['formapago']."</td>";
echo "<td>".$row['vendedor']."</td>";
echo "<td>".$row['fecha']."</td>";


////or ($row['estado']=="Facturado" and $row['estado']=="") 

//solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito 
//if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" or $row['estado']=="Enviar Docs." or $row['estado']=="Facturado") and ($nivel == "20" and $row['factura']==""))
{
	echo "<td> <a href=formp1.php?sec=$sec>".$row['estado']."</td>";
}
else
	{
		if (( $row['estado']=="Verif. pago" or $row['estado']=="Enviar Docs."  ) and $nivel == "20"){
			echo "<td> <a href=formpay1.php?sec=$sec>".$row['estado']."</td>";
		}
		else
		{
			echo "<td>".$row['estado']."</td>";
		}
			
	}

$factura = $row['factura'];


// si existe factura y soy despachador (nivel 30) se actuva el link para ingresar datos despacho solo si no hay despacho ingresado
if ( $nivel == "30" )
{
echo "<td><a href=tomaserie1.php?sec=$sec&numfac=$factura>".$row['factura']."</td>";
}
else
{
echo "<td>".$row['factura']."</td>";
}

if (($row['factura']<>'') and ($nivel == "30" )and ($row['despachofinal']=='') and ($row['bultos']<>''))
{
echo "<td><a href=detallefacturaent.php?sec=$sec&numfac=$factura>".$row['fechafact']."</td>";
}
else
{
echo "<td>".$row['fechafact']."</td>";
}

echo "<td><a href=despcoment1.php?sec=$sec>".$row['comentlogi']."</td>";


// si no hay factura veo verorden1, si ya hay factura veo verorden2
if ($row['factura']==""){
echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
}
else
{
echo "<td align=center  ><a href=verorden1.php?sec=$sec>  <img src='images/icon_preview.png' alt='Vista Previa' border='0' height='24' width='24'></td></tr>";
}

}



die();





 ?>





</html>
