

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
echo "<br><br><br>Usuario: ".$_SESSION['usuario']."(".$_SESSION['nivel'].")";
$nivel = $_SESSION["nivel"];


 // Creates string of comma-separated variables(*) for unset.
 $all_vars = implode(', $', array_keys(get_defined_vars()));
 unset($all_vars);
 




echo "<H2>Listado de Ventas con tarjeta por cobrar:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant= $year-1;





$sql = "SELECT * FROM covidsales where factura ='' and estado ='Tarjeta'  and anulada <>'1' order by secuencia desc ";

//$sql = "
//  SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.direccion, a.referencias, a.formapago,
//  a.fecha,a.factura, a.ordenweb, a.despacho,a.estado, a.fechafact,a.fechadesp, a.vendedor, a.facturador, a.bultos, a.despachofinal, 
//  a.fechafinal, a.usuariofinal, a.paymentez, a.apruebapayz, a.despachador, a.mail, a.provincia, a.anulada, a.anuladapor, a.canal, a.aprobadocc, 
//  a.fechaanulada, a.valortotal, a.pdf, a.cierrefecha, a.cierreusuario, a.bodega, a.numcuotas, a.valorcuotas, 
//  b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5  
//  FROM `covidsales` as a  left join  covidcredito as b on a.secuencia = b.transaccion 
//  where (a.factura ='' or (a.factura <>'' and a.estado ='Verif. pago'  ) ) and a.estado <>'Facturado' and a.anulada <>'1' order by a.secuencia desc
// ";

//echo $sql;
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
<th align=center width= 10% >Guia</th>
<th align=center width= 5% >Bultos</th>
<th align=center width=  5% >Fecha<br>Guia</th>
<th align=center width= 5% >Despacho</th>
<th align=center width=  5% >Fecha<br>Despacho</th>
<th align=center width=  5% >Ver</th><tr>";
while($row = mysqli_fetch_array($result)) {
  $sec=$row['secuencia'];

// solo permito modificar mientras no este facturado. Luego ya no puedo modificar
if ($row['factura']=='' and $nivel<>'99')
{echo "<td><a href=form1a.php?sec=$sec>".$sec."</td>";} else {echo "<td>".$sec."</td>";}
echo "<td>".$row['cedula']."</td>";
echo "<td>".$row['nombres']."</td>";
echo "<td>".$row['celular']."</td>";
echo "<td>".$row['ciudad']."</td>";
echo "<td>".$row['venta']."</td>";
echo "<td>".$row['valortotal']."</td>";
echo "<td>".$row['ordenweb']."</td>";
echo "<td>".$row['bodega']."</td>";
echo "<td>".$row['formapago']."</td>";

if ($row['canal']==0){ echo "<td>".$row['vendedor']."<br>(Online)</td>";} else { echo "<td>".$row['vendedor']."<br>(Callcenter)</td>";}
echo "<td>".$row['fecha']."</td>";

$docsok = 0;
if ($row['doc1']<>''){$docsok = $docsok + 1 ;} 
if ($row['doc2']<>''){$docsok = $docsok + 1 ;} 
if ($row['doc3']<>''){$docsok = $docsok + 1 ;} 
if ($row['doc4']<>''){$docsok = $docsok + 1 ;} 
if ($row['doc5']<>''){$docsok = $docsok + 1 ;} 
// if (is_null($row['doc2'])){$docsok = $docsok + 1 ;} 
// if (is_null($row['doc3'])){$docsok = $docsok + 1 ;} 
// if (!is_null($row['doc4'])){$docsok = $docsok + 1 ;} 
// if (!is_null($row['doc5'])){$docsok = $docsok + 1 ;} 

////or ($row['estado']=="Facturado" and $row['estado']=="") 


//solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito 
//if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia"  ) and ($nivel == "20" and $row['factura']==""))
{
   // si es tarjeta y no tiene factura y soy nivel 20 y es del callcenter y no esta aprobada por callcenter entro aqui:
   if ($row['estado']=="Tarjeta" and $row['canal']=="1" and $row['aprobadocc']=="" )
   {echo "<td> Falta aprobar<br>Callcenter</td>";} else
	{echo "<td> <a href=cobratc1.php?sec=$sec>".$row['estado']."</td>";}
}
else
	{
		if (( $row['estado']=="Verif. pago"  ) and $nivel == "20"){
			echo "<td> <a href=formpay1.php?sec=$sec>".$row['estado']."</td>";
		}
		else
		{
			echo "<td>".$row['estado']."</td>";
		}
			
	}

//and $docsok =5

	if ($row['estado']=="Enviar Docs."  and $docsok < 5 )
	{

	echo "<td>";
  	if (($row['doc1']<>''))
  	{echo "<img src='images/001_06.png' border='0' height='12' width='12'>";}
  	else 
  	{echo "<img src='images/001_05.png' border='0' height='12' width='12'>";}
  	if (($row['doc2']<>''))
  	{echo "<img src='images/001_06.png' border='0' height='12' width='12'>";}
  	else 
  	{echo "<img src='images/001_05.png' border='0' height='12' width='12'>";}
  	if (($row['doc3']<>''))
  	{echo "<img src='images/001_06.png' border='0' height='12' width='12'>";}
  	else 
  	{echo "<img src='images/001_05.png' border='0' height='12' width='12'>";}
  	if (($row['doc4']<>''))
  	{echo "<img src='images/001_06.png' border='0' height='12' width='12'>";}
  	else 
  	{echo "<img src='images/001_05.png' border='0' height='12' width='12'>";}
  	if (($row['doc5']<>''))
  	{echo "<img src='images/001_06.png' border='0' height='12' width='12'>";}
  	else 
  	{echo "<img src='images/001_05.png' border='0' height='12' width='12'>";}

	echo "</td>";}
	else
	{
	if($docsok == 5)
		{
		echo "<td align=center  ><a href=formp1.php?sec=$sec>  <img src='images/001_06.png' alt='Vista Previa' border='0' height='24' width='24'></td>";
		}
		else
		{
		$factura = $row['factura'];
		echo "<td>".$row['factura']."</td>";
		}
	}


echo "<td>".$row['fechafact']."</td>";

echo "<td>".$row['despacho']."</td>";
echo "<td>".$row['bultos']."</td>";

if ($row['fechadesp']=='0000-00-00'){echo "<td></td>";} 
else {echo "<td>".$row['fechadesp']."</td>";}

echo "<td>".$row['despachofinal']."</td>";
if ($row['fechafinal']=='0000-00-00'){echo "<td></td>";}
else {echo "<td>".$row['fechafinal']."</td>";}

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
