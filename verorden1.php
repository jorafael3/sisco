<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<style type="text/css">
.zoom {
	transition:transform .5s;
	}
.zoom:hover{
	transform: scale(8);
	}
</style>

<!-- 
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
 -->
<meta name="viewport" content="width=device-width, height=device-height">
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas.css">

</head>

<?php include "connectdb.php"; ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#ddlcredito").change(function () {
                if ($(this).val() == "Directo") {
                    $("#dvcredito").show();
                } else {
                    $("#dvcredito").hide();
                }
            });
        });
    </script>
<?php
session_start();
require("conexion.php");
//echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");

$sec= $_GET['sec'] ;
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
// $sql1 = "SELECT * FROM covidsales where secuencia = $sec ";

$sql1 = "
SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb,a.comentarios,a.anuladapor,
 a.bodega,a.fecha, a.pdf, a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.l2p,a.fechaanulada as fa,
 a.bultos, a.estado, a.fechadesp, a.anulada, a.pickup, a.mail, a.valorcuotas, a.numcuotas,a.l2pcodigo,
 a.direccion, a.referencias, b.orden, b.provincia, b.bodega ,c.provincia , d.doc1 as soli,d.doc2 as amor,
 d.doc3 as paga,d.doc4 as cont,d.doc5 AS impo, e.doc1 , f.doc1 as ced, f.doc2 as tarj, f.doc3 as vou, l.comentario as come
FROM `covidsales` as a 
left join covidpickup as b on a.secuencia = b.orden 
left join covidprovincia as c on b.provincia= c.idgrupo 
left join covidcredito as d on a.secuencia= d.transaccion 
left join covidtransferencias as e on a.secuencia= e.transaccion 
left join coviddocumentos as f on a.secuencia = f.transaccion
left join covidlogistica as l on l.transaccion= a.secuencia
where a.secuencia =$sec
";

$result = mysqli_query($con, $sql1);
$row1= mysqli_fetch_array($result);

$anulada = $row1['anulada'];
$comentariosa = $row1['comentarios'];
$anuladapor = $row1['anuladapor'];
$fechaanulada= $row1['fa'];

$nombre = $row1['nombres'];
$cedula = $row1['cedula'];
$celular = $row1['celular'];
$ciudad = $row1['ciudad'];
$direccion = $row1['direccion'];
$referencias = $row1['referencias'];
$venta = $row1['venta'];
$formapago = $row1['formapago'];
$ordenweb = $row1['ordenweb'];
$mail = $row1['mail'];
$vtotal = $row1['valortotal'];
$valcuotas = $row1['valorcuotas'];
$numcuotas = $row1['numcuotas'];
$pickup = $row1['pickup'];
$provincia = $row1['provincia'];
$bodega = $row1['bodega'];
$l2pcodigo = $row1['l2pcodigo'];
$l2plink = $row1['l2p'];
$come = $row1['come'];
if (isset($row1['soli'])){$solicitud=$row1['soli'];} else {$solicitud='';}
if (isset($row1['amor'])){$amortizacion=$row1['amor'];} else {$amortizacion='';}
if (isset($row1['paga'])){$pagare=$row1['paga'];} else {$pagare='';}
if (isset($row1['cont'])){$contrato=$row1['cont'];} else {$contrato='';}
if (isset($row1['impo'])){$importante=$row1['impo'];} else {$importante='';}

if (isset($row1['doc1'])){$transfer=$row1['doc1'];} else {$transfer='';}
if (isset($row1['ced'])){$docced=$row1['ced'];} else {$docced='';}
if (isset($row1['tarj'])){$doctarj=$row1['tarj'];} else {$doctarj='';}
if (isset($row1['vou'])){$docvou=$row1['vou'];} else {$docvou='';}
$comentarios= $row1['tccobra'];
if ($row1['facturador'] == ' ') { $facturador = $row1['facturador'];} else {$facturador =' &nbsp ';}
if ($row1['estado'] <> ' ') { $estado = $row1['estado'];} else {$estado =' &nbsp ';}
if ($row1['despacho'] <> ' ') { $despacho = $row1['despacho'];} else {$despacho =' &nbsp ';}
$despachofinal = $row1['despachofinal'];
$fechafinal = $row1['fechafinal'];
$factura = $row1['factura'];



echo "<Form Action=\"index1.php\" Method=\"post\" >";



echo "<table border=0 cellpadding=1 cellspacing=3 width=65%>";
if ($anulada ==1)
{
	echo "<th colspan =4><h3>Detalle de factura: * * * ANULADA * * *</h3></th></tr> ";
	
}
else 
{
	echo "<th colspan =4><h3>Detalle de factura:</h3></th></tr> ";
	
}

?>
<th >Nombre:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>"  readonly> </td>


<th >Cedula / RUC:</th>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>" readonly></td></tr>


<th>Celular:</th>
<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>" readonly></td>
<th>Mail:</th>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="celular" id="mail" value="<?php echo $mail?>" readonly></td></tr>
<th>Ciudad:</th>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="ciudad" id="ciudad" value="<?php echo $ciudad?>" readonly></td><th></th><td></td></tr>


<th >Dirección:</th>
<td ><textarea readonly name="direccion" rows="8" cols="50" > <?php echo $direccion ?>
</textarea></td>


<th >Referencia:</th>
<td> <textarea readonly name="referencia" rows="8" cols="50" > <?php echo $referencias ?>
</textarea></td></tr>

<th ><br>Compra:</th>
<td colspan =4><br>
<table border=2 cellpadding=0 cellspacing=0 style="background-color: #ff0000;" >
<?php echo $venta ?></table></td></tr>
<th><br>Comentarios:</th>
<td colspan =2><br>
<table border=2 cellpadding=0 cellspacing=0 style="background-color: #ff0000;" >
<?php echo $comentarios ?></table>
<td><b>Transferencia:<b></td><td><a href=muestraimagent.php?sec=$sec&a=1><?php $transfer ?></td></tr>

<!-- 
<textarea readonly name="compra" rows="8" cols="50"  > <?php echo $venta ?>
</textarea>
 -->
</td></tr>
<th ><br>Valor total de la compra:</th>
<td ><br><Input Type=Text Size = 10 Maxlenght=10 Name="total" id="total" value="<?php echo $vtotal?>" readonly></td>
<?php //Fecho "</td><td><b>Cédula:<b></td><td><a href=muestraimagen.php?sec=$sec&a=1>$docced</td></tr>";?>

</tr><th>Forma de pago:</th>
<td>
<select name="pago" disabled>
<?php 
if ($formapago == "Paymentez") {
  echo "<option value='Paymentez' selected>Paymentez</option>"; } else {
  echo "<option value='Paymentez' >Paymentez</option>"; }
if ($formapago == "Tarjeta") {
  echo "<option value='Tarjeta' selected>Tarjeta</option>";} else {
  echo "<option value='Tarjeta' >Tarjeta</option>"; }
if ($formapago == "Transferencia") {
  echo "<option value='Transferencia' selected>Transferencia</option>"; } else {
  echo "<option value='Transferencia' >Transferencia</option>"; }
 if ($formapago == "Directo") {
  echo "<option value='Directo' selected>C. Directo</option>"; } else {
  echo "<option value='Directo' >C. Directo</option>"; }
 if ($formapago == "LinkToPay") {
  echo "<option value='LinkToPay' selected>Link To Pay</option>";  } else {
  echo "<option value='LinkToPay' >Link To Pay</option>"; }
  
echo "</select>";
 if ($formapago == "LinkToPay") { echo "<b> &nbsp&nbsp&nbspLink:</b>".$l2plink." <b>código:</b> ".$l2pcodigo; }
 if ($formapago == "Tarjeta") {echo "&nbsp&nbsp&nbspVer aprobación<a href=vercct1.php?sec=$sec>".$sec;}
echo "</td></tr>";
//echo "<td><b>Tarjeta:<b></td><td><a href=muestraimagen.php?sec=$sec&a=2> $doctarj </td><tr>";

 if ($numcuotas<>'' or $valcuotas<>'') { ?>;
<td colspan =4><div id="dvcredito" style="display: inline">
<?php } else { ?>
 <td colspan =4><div id="dvcredito" style="display: none">
<?php } ?>
    <b>Número de cuotas: </b>
    <input type="text" Size = 5 Maxlenght=5 id="numcuotas" name="numcuotas" value="<?php echo $numcuotas?>" />
    <b>Valor de cuota: </b>
    <input type="text" Size = 5 Maxlenght=5 id="valcuotas" name="valcuotas" value="<?php echo $valcuotas?>"/><br>
    <?php 	echo "<u><b>Documentos crédito:<b></u><b> Pagaré: <b><a href=muestrapagare.php?sec=$pagare>$pagare</a>";
   	 		echo "<b> Amortización: <b><a href=muestrapagare.php?sec=$amortizacion>$amortizacion</a>";
   	 		echo "<b> Solicitud: <b><a href=muestrapagare.php?sec=$solicitud>$solicitud</a>";
   	 		echo "<b> Contrato: <b><a href=muestrapagare.php?sec=$contrato>$contrato</a>";
   	 		echo "<b> Comunicado: <b><a href=muestrapagare.php?sec=$importante>$importante</a>";
    ?>
    
</td></tr></div>

 <?php if ($docced<>'' or $doctarj<>'' or $docvou<>'') { ?>;
<td colspan =2><div id="dvdocumentos" style="display: inline">
<?php } else { ?>
 <td colspan =2><div id="dvdocumentos" style="display: none">
<?php } ?>
	<table border=0 cellpadding=1 cellspacing=3 width=65%>
    <?php 	
	echo "<th><strong>Documentos:</strong></th><td></td>";
	echo "<td colspan=2><img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/".$docced."' height='50' width='100'/></td>";
	echo "<td><img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/".$doctarj."' height='50' width='100'/></td>";
 	echo "<td><img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/".$docvou."' height='50' width='100'/></td></tr></table>";
    ?>
    
</td></tr></div>

<?php
session_start();
$nivel=$_SESSION["nivel"];


echo " <tr><th>Orden WEB:</th>";
echo "<td><Input Type=Text Size = 12 readonly Maxlenght=12 Name='ordenweb'  value = $ordenweb ></td><tr>";

echo " <th>Facturado por:</th>";
echo "<td> <Input Type=Text Size = 12 Maxlenght=12 Name='facturador' value = $facturador readonly></td></td>";
echo " <tr><th>Estado:</th>";
echo "<td>". $estado." </td></td><tr>";

echo " <th> Guia #:</th>";
echo "<td>". $despacho."</td><tr>";
echo " <th> Comentario <br>Despacho:</th>";
echo "<td>". $come."</td><tr>";

echo " <th>Entrega:</th>";
echo "<td>". $despachofinal."</td><tr>";
echo " <th>Fecha Entrega:</th>";
echo "<td>". $fechafinal."</td><tr>";

if ($anulada ==1)
{
	echo " <th>Anulada:</th>";
	echo "<td>". $comentariosa."</td><tr>";
	echo " <th>Fecha anulada:</th>";
	echo "<td>". $fechaanulada."</td><tr>";
	echo " <th>Anulada Por:</th>";
	echo "<td>". $anuladapor."</td><tr>";	
}
//         ////////////////////////////////////////////////////////
include("conexion.php");
date_default_timezone_set('America/Guayaquil');


if (!mssql_select_db('COMPUTRONSA', $link)) 
{ 
die('Unable to select database!');
} 

$numfac = trim($factura);
$cuenta =1;
$datamail = '';
//$datamail .=  "<H2>Detalle de factura :<br></H2>";

$sql2="PER_Detalle_Facturas '".$numfac."' ";
//echo $sql2;
$result2 = mssql_query(utf8_decode($sql2));
				  				                    
    while ($row = mssql_fetch_array($result2)) {
 				if ($row['Section']=='HEADER')
				{
						$datamail .=  "<br><br><table border=1  cellspacing=0 width=80% >";
						$datamail .=  "<tr>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Fecha</B></th>";
						$datamail .=  "<td align='left'>"  .substr($row['Fecha'],0,-14).  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Secuencia</B></th>";
						$datamail .=  "<td align='left'>"  .$row['Secuencia'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Nombre</B></th>";
						$datamail .=  "<td align='left' colspan =2>"  .$row['Nombre'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Vendedor</B></th>";
						$datamail .=  "<td align='left' colspan =2>"  .$row['Vendedor'].  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Otro</B></th>";
						$datamail .=  "<td align='left'>".$row['Sucursal'].  "</td><tr>";
						
						$SubTotal = $row['SubTotal'];
						$Descuento = $row['Descuento'];
						$Financiamiento = $row['Financiamiento'];
						$Impuestos = $row['Impuestos'];
						$Total = $row['Total'];
						$RentUSD = $row['RentUSD'];
						$Rent = $row['Rent'];
						$RentUSD2 = $row['RentUSD2'];
						$Rent2 = $row['Rent2'];
						$RetEsperada = $row['RetEsperada'];
						$Sucursal = $row['Sucursal'];
						$RecargoTC = $row['RecargoTC'];
						
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>SubTotal</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($SubTotal,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Descuento</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Descuento,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Financiamiento</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Financiamiento,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0><B>Impuesto</B></th>";
						$datamail .=  "<td align='left'>$"  .number_format($Impuesto,2,",",".").  "</td>";
						$datamail .=  "<th bgcolor='$color1' align=center height=0 colspan =2><B>Total</B></th>";
						$datamail .=  "<td align='left' colspan =2>$"  .number_format($Total,2,",",".").  "</td><tr>";


				$SubTotalt = 0;
				$Impuestot = 0;
				$Totalt = 0;
				$datamail .=  "<br><br><table border=1  cellpadding=3 cellspacing=0 width=80% >";
				$datamail .=  "<tr>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Código</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Descripción</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Cant.</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Precio</B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>SubTotal </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Descuento </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Impuesto </B></th>";
				$datamail .=  "<th bgcolor='$color1' align=center   height=0><B>Total </B></th>";
				$datamail .= "<tr>";
				$SubTotalt = $row['SubTotal'];
				$Impuestot =  $row['Impuesto'];
				$Totalt =  $row['Total'];	
				$SubTotalt2 =  $row['SubTotal'];
				$TotFin =  $row['Financiamiento'];
				$Impuestot2 =  $row['Impuesto'];
				$Totalt2 = $row['Total'];
				}
				else  // del if ($row['Section']=='HEADER')
				{				
					$datamail .=  "<td align='left'>"  .$row[utf8_decode('Código')].  "</td>";
					$datamail .=  "<td align='left'>"  .utf8_encode($row['Nombre']) .  "</td>";	  
					$datamail .=  "<td align='right'>"  .number_format($row['Cantidad'],2,",",".")  .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Precio'],2,",",".")  .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['SubTotal'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Descuento'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Impuesto'],2,",",".")   .  "</td>";
					$datamail .=  "<td align='right'>$"  .number_format($row['Total'],2,",",".")   .  "</td>";
					$datamail .= "<tr>";
				} // del if ($row['Section']=='HEADER')				    
     }
$datamail .=  "<tr>";
echo $datamail ;
?>
<Form Action='index1.php' Method='post'>
<!-- 
<td colspan =10><Center><Input Type=Submit Value="Regresar" class="btn btn-sm btn-primary"></Center></td>
 -->
</table>


</form>