<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menus.css">
<script type="text/Javascript">
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
</script>

</head>
<html>
<body>
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
                if ($(this).val() == "Tarjeta") {
                    $("#dvtarjeta").show();
                } else {
                    $("#dvtarjeta").hide();
                }
                if ($(this).val() == "LinkToPay") {
                    $("#linktopay").show();
                } else {
                    $("#linktopay").hide();
                }

            });
        });
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#ddldespacho").change(function () {
                if ($(this).val() == "Pickup") {
                    $("#dvdespacho").show();
                } else {
                    $("#dvdespacho").hide();
                }
            });
        });
    </script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "get_state.php",
	data:'idgrupo='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});
}

function showMsg()
{

	$("#msgC").html($("#country-list option:selected").text());
	$("#msgS").html($("#state-list option:selected").text());
	return false;
}
</script>

<?php
session_start();

if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
        // Popular el Dropdown de Vendedores:
        $marcasdd = array( );
        $sqln = "SELECT * FROM covidusuarios where nivel ='10' and activo ='1' order by usuario   ";
		$resultn = mysqli_query($con, $sqln);
		$countn = mysqli_num_rows($resultn);
		$i=0;
		while($rown = mysqli_fetch_array($resultn)) {
		$i=$i+1;
		$mostrar[]=$rown['usuario'];
		$marcas[]= $rown['secuencia'];
		}
		$zz=count($marcas) - 1;

        // Popular el Dropdown de tarjetas:
        $tarjetasdd = array( );
        $sqlt = "SELECT * FROM covidtarjetas  order by nombre   ";
		$resultt = mysqli_query($con, $sqlt);
		$countt = mysqli_num_rows($resultt);
		$i=0;
		while($rowt = mysqli_fetch_array($resultt)) {
		$i=$i+1;
		$mostrart[]=$rowt['nombre'];
		$secuenciat[]= $rowt['secuencia'];
		}
		$zzt=count($secuenciat) - 1;


echo "<br><br><br>";
$sec= $_GET['sec'] ;
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());
$sql = "SELECT * FROM covidsales where secuencia = $sec ";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nombre = $row['nombres'];
$cedula = $row['cedula'];
$celular = $row['celular'];
$ciudad = $row['ciudad'];
$direccion = $row['direccion'];
$referencias = $row['referencias'];
$comentarios = $row['comentarios'];
$venta = $row['venta'];
$formapago = $row['formapago'];
$ordenweb = $row['ordenweb'];
$mail = $row['mail'];
$vendedor = $row['vendedor'];
$total = $row['valortotal'];
$valcuotas = $row['valorcuotas'];
$numcuotas = $row['numcuotas'];
$tipotarjeta = $row['tipotarjeta'];
$linktopay = $row['l2p'];
$comollego = $row['comollego'];
$pickup = $row ['pickup'];
?>


<Form Action="form2a.php" Method="post" >

<center><table border=0 cellpadding=0 cellspacing=0 ></center>
<tr> 
<Th colspan =2><h2>Formulario de creación de pedidos</h2></th>
</tr>
 
<td >Nombre:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>" > </td></tr>


<td >Cedula / RUC:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>"></td></tr>


<td>Celular:</td>
<td ><Input Type=Text Size = 10 Maxlenght=10 Name="celular" id="celular" value="<?php echo $celular?>"></td></tr>
</tr>
<td>Mail:</td>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="mail" id="mail" value="<?php echo $mail?>"></td></tr>
</tr>
<td>Ciudad:</td>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="ciudad" id="ciudad" value="<?php echo $ciudad?>"></td></tr>
</tr>

<td >Dirección:</td>
<td ><textarea name="direccion" rows="4" cols="80" > <?php echo $direccion ?>
</textarea></td>
</tr>

<td >Referencia:</td>
<td> <textarea name="referencia" rows="4" cols="80" > <?php echo $referencias ?>
</textarea></td></tr>

<td >Compra:</td>
<td>
<textarea name="compra" rows="4" cols="80"  > <?php echo $venta ?>
</textarea></td></tr>

<td >Comentario:</td>
<td>
<textarea name="comentario" rows="4" cols="80"  > <?php echo $comentarios ?>
</textarea></td></tr>

<td >Valor total de la compra:</td>
<td ><Input Type=Text Size = 10 Maxlenght=10 Name="total" id="total"  value="<?php echo $total?>"  onkeyup="checkDec(this)"> </td></tr>


<td><span>Forma de pago:</span></td>
<td>
<select name="pago" id = "ddlcredito" onchange = "ShowHideDiv()">
<?php 
if ($formapago == "Paymentez") {
  echo "<option value='Paymentez' selected>Paymentez</option>"; } else {
  echo "<option value='Paymentez' >Paymentez</option>"; }
if ($formapago == "Tarjeta") {
  echo "<option value='Tarjeta' selected>Tarjeta</option>"; } else {
  echo "<option value='Tarjeta' >Tarjeta</option>"; }

if ($formapago == "Tienda") {
  echo "<option value='Tienda' selected>Tienda</option>"; } else {
  echo "<option value='Tienda' >Tienda</option>"; }
  
if ($formapago == "Transferencia") {
  echo "<option value='Transferencia' selected>Transferencia</option>"; } else {
  echo "<option value='Transferencia' >Transferencia</option>"; }
 if ($formapago == "Directo") {
  echo "<option value='Directo' selected>C. Directo</option>";  } else {
  echo "<option value='Directo' >C. Directo</option>"; }
 if ($formapago == "LinkToPay") {
  echo "<option value='LinkToPay' selected>Link To Pay</option>";  } else {
  echo "<option value='LinkToPay' >Link To Pay</option>"; }

  ?>
 <!-- 
  <script>jQuery(document).ready(function(){ ShowHideDiv(Directo)});</script>
 
 --> 
</select></td></tr>

<?php if ($numcuotas<>'' or $valcuotas<>'') { ?>;
<td></td><td><div id="dvcredito" style="display: inline">
<?php } else { ?>
 <td></td><td><div id="dvcredito" style="display: none">
<?php } ?>
    <b>Número de cuotas: </b>
    <input type="text" Size = 5 Maxlenght=5 id="numcuotas" name="numcuotas" value="<?php echo $numcuotas?>" />
    <b>Valor de cuota: </b>
    <input type="text" Size = 5 Maxlenght=5 id="valcuotas" name="valcuotas" value="<?php echo $valcuotas?>"/>
</div></td></tr>

<?php if ($linktopay<>'' ) { ?>;
<td></td><td><div id="linktopay" style="display: inline">
<?php } else { ?>
<td></td><td><div id="linktopay" style="display: none">
<?php } ?>
    <b>Código LINKTOPAY: </b>
    <input type="text" Size = 40 Maxlenght=70 id="linktopay" name="linktopay" value = "<?php echo $linktopay?>" />
</div></td></tr>


<?php if ($tipotarjeta<>'') { ?>;
<td></td><td><div id="dvtarjeta" style="display: inline">
<?php } else { ?>
 <td></td><td><div id="dvtarjeta" style="display: none">
<?php } ?>
<select name="tipotarjeta" id="tipotarjeta" ;">
<?php
global $zzt;
 for ($x = 0; $x <= $zzt; $x++) {
   if($tipotarjeta ==$mostrart[$x])
   { echo "<option value= '$mostrart[$x]' selected >$mostrart[$x]</option>";}
   else
   { echo "<option value= '$mostrart[$x]'  >$mostrart[$x]</option>";}
   
}
?>
</select></div>

</td></tr>

<?php
session_start();
$nivel=$_SESSION["nivel"];

if ($nivel >= 20 or strlen($ordenweb)>=1)
{
echo "<td >Orden WEB:</td>";
echo "<td ><Input Type=Text Size = 12 Maxlenght=12 Name='ordenweb' id='ordenweb' value = $ordenweb></td></tr>";
}
else
{
echo "<Input Type=hidden Name='ordenweb' value=''>";
}
echo "<Input Type=hidden Name='sec' value='$sec'>";

?>

<td>Vendedor:</td>
<td>
 <select name="vendedor" id="vendedor">
<?php 

global $zz;

  for ($x = 0; $x <= $zz; $x++) {
		if($mostrar[$x] == $vendedor)
		{
		echo "<option value= '$mostrar[$x]' selected>$mostrar[$x]</option>";
		}
		else
		{
		echo "<option value= '$mostrar[$x]'>$mostrar[$x]</option>";
		}
  } 

?>
</select>
</td></tr>
<tr><td>Forma de ingreso del <br> cliente:</td>
<td>
 <select name="ingresocli" id="ingresocli">
<?php 
	if ($comollego == "Web") {
	  echo "<option value='Web' selected>Web</option>"; } else {
	  echo "<option value='Web' >Web</option>"; }
	if ($comollego == "Chat") {
	  echo "<option value='Chat' selected>Chat</option>"; } else {
	  echo "<option value='Chat' >Chat</option>"; }

	if ($comollego == "Whatsapp") {
	  echo "<option value='Whatsapp' selected>Whatsapp</option>"; } else {
	  echo "<option value='Whatsapp' >Whatsapp</option>"; }
	  
	if ($comollego == "Aplicacion de Credito Online") {
	  echo "<option value='Aplicacion de Credito Online' selected>Aplicacion de Credito Online</option>"; } else {
	  echo "<option value='Aplicacion de Credito Online' >Aplicacion de Credito Online</option>"; }
	 if ($comollego == "Call Inbound") {
	  echo "<option value='Call Inbound' selected>Call Inbound</option>";  } else {
	  echo "<option value='Call Inbound' >Call Inbound</option>"; }
	 if ($comollego == "Call Outbound") {
	  echo "<option value='Call Outbound' selected>Call Outbound</option>";  } else {
	  echo "<option value='Call Outbound' >Call Outbound</option>"; }
	 if ($comollego == "Redes") {
	  echo "<option value='Redes' selected>Redes</option>";  } else {
	  echo "<option value='Redes' >Redes</option>"; }
	 if ($comollego == "Otro") {
	  echo "<option value='Otro' selected>Otro</option>";  } else {
	  echo "<option value='Otro' >Otro</option>"; }

  ?>
</select></td></tr>

<tr><td>Forma de despacho:</td>
<td><select name="despacho" id="ddldespacho" onchange = "ShowHideDiv2()" >
<?php 
	if ($pickup== 1 ){ $pickup= "Pickup" ;} else { $pickup= "Envio"; }
	if ($pickup  == "Pickup") {
	  echo "<option value='Pickup' selected>Pickup</option>"; } else {
	  echo "<option value='Pickup' >Pickup</option>"; }
	if ($pickup == "Envio") {
	  echo "<option value='Envio' selected>Envio</option>"; } else {
	  echo "<option value='Envio' >Envio</option>"; }
  ?>
</select></td></tr>
<td> Computron desde donde retira el cliente:</td>
<td><div id="dvdespacho" style="display: none">
	<strong>Provincia:<strong>
		<select name="provincia" id="country-list" class="demoInputBox"  onChange="getState(this.value);">
		<option value="">Seleccione provincia</option>
			<?php
		$sql1="SELECT * FROM covidprovincia";
         $results=$dbhandle->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["idgrupo"]; ?>"><?php echo $rs["provincia"]; ?></option>
		<?php
		}
		?>
		</select>
	<strong>&nbsp&nbsp&nbspBodega:<strong>
		<select id="state-list" name="bodega"   >
		<option value="">Seleccione bodega</option>
		</select></td ></tr>
</div></td></tr>
<tr> 
<td ></td><td><Center><Input Type=Submit Value="Actualizar Información" class="btn btn-sm btn-primary"></Center></td>
</tr>
</table>


</form>