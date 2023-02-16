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





echo "<H2>Listado de Ventas por facturar o aprobar:<br></H2>";


include("conexion.php");


date_default_timezone_set('America/Guayaquil');

$year = date("Y");
$yearant = $year - 1;





//$sql = "SELECT * FROM covidsales where (factura ='' or (factura <>'' and estado ='Verif. pago'  ) ) and estado <>'Facturado' and anulada <>'1' order by secuencia desc ";
if ($_SESSION["canal_id"] > 2) {
  $sql = "
  SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.direccion, a.referencias, a.formapago, a.fecha,
  a.factura, a.ordenweb, a.despacho,a.estado, a.fechafact,a.fechadesp, a.vendedor, a.facturador, a.bultos, a.despachofinal,
  a.fechafinal, a.usuariofinal, a.paymentez, a.apruebapayz, a.despachador, a.mail, a.provincia, a.anulada, a.anuladapor,
  a.fechaanulada, a.valortotal, a.pdf, a.cierrefecha, a.cierreusuario, a.bodega, a.numcuotas, a.valorcuotas,a.canal,
  a.aprobadocc, b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 FROM `covidsales` as a left join covidcredito as b
  on a.secuencia = b.transaccion 
  where a.factura ='' and a.estado='Enviar Docs.' 
  and a.anulada <>'1' 
  and a.aprobadocc='' and a.canal = ".$_SESSION["canal_id"]." order by secuencia desc ";
} else {
  $sql = "
  SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.direccion, a.referencias, a.formapago, a.fecha,
  a.factura, a.ordenweb, a.despacho,a.estado, a.fechafact,a.fechadesp, a.vendedor, a.facturador, a.bultos, a.despachofinal,
  a.fechafinal, a.usuariofinal, a.paymentez, a.apruebapayz, a.despachador, a.mail, a.provincia, a.anulada, a.anuladapor,
  a.fechaanulada, a.valortotal, a.pdf, a.cierrefecha, a.cierreusuario, a.bodega, a.numcuotas, a.valorcuotas,a.canal,
  a.aprobadocc, b.transaccion, b.doc1, b.doc2, b.doc3, b.doc4, b.doc5 FROM `covidsales` as a left join covidcredito as b
  on a.secuencia = b.transaccion where a.factura ='' and a.estado='Enviar Docs.' and a.anulada <>'1' and a.canal in ('1','0','2')
  and a.aprobadocc='' order by secuencia desc ";
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
<th align=center width= 5% >Orden<br>WEB</th>
<th align=center width= 5% >Bodega</th>
<th align=center width= 5% >Pago</th>
<th align=center width=  5% >Vendedor</th>
<th align=center width=  5% >Fecha<br>Venta</th>
<th align=center width= 10% >Estado</th>
<th align=center width= 10% >Factura</th>

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
  echo "<td>" . $row['ordenweb'] . "</td>";
  echo "<td>" . $row['bodega'] . "</td>";
  echo "<td>" . $row['formapago'] . "</td>";
  echo "<td>" . $row['vendedor'] . "</td>";
  echo "<td>" . $row['fecha'] . "</td>";


  //solo permito que cajero aplique factura y solo cuando los metodos de pago  Tarjeta de credito
  //if ( ($row['estado']=="Paymentez" or $row['estado']=="Tarjeta" or $row['estado']=="Transferencia" ) and ($nivel == "20" and $row['factura']==""))
  if ($row['canal'] == '0') {
    $canal = 'Online';
  } else {
    if ($row['canal'] == '1') {
      $canal = 'CallCenter';
    } else {
      $canal = 'WEB';
    }
  }
  if (($row['estado'] == "Enviar Docs.") and (($nivel == "20" or  $nivel == "28" or  $nivel == "40") and $row['factura'] == "" and $row['aprobadocc'] == "")) {
    echo "<td> <a href=apruebacccd1.php?sec=$sec> Falta aprobar<br> $canal </td>";
  } else {
    echo "<td>" . $row['estado'] . "</td>";
  }

  echo "<td>" . $row['factura'] . "</td>";
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