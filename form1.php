<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
<title>Sistema SISCO</title>
<script src="https://code.jquery.com/jquery-git.js"></script>
<link rel="stylesheet" type="text/css" href="css/menus.css">

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) ||
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

//-->
</SCRIPT>



<script type="text/Javascript">
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
</script>

</head>
<HTML>
<style>
textarea {
/*
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
 */
    width: 100%;
    }
</style>

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
                    $("#tarjeta").show();
                } else {
                    $("#tarjeta").hide();
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
function getState1(val) {
	$.ajax({
	type: "POST",
	url: "get_state.php",
	data:'idgrupo='+val,
	success: function(data){
		$("#state-list1").html(data);
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

/// esta es para crear una venta nueva

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
// echo "<br><br><br>";

        // Popular el Dropdown de Vendedores:
        $marcasdd = array( );
        $sqln = "SELECT * FROM covidusuarios where (nivel ='10' or nivel ='22') and activo ='1' order by usuario   ";
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

?>

<Form Action="form2.php" Method="post" >



<center><table border=0 cellpadding=0 cellspacing=0 ></center>
<tr>
<Th colspan =2><h2>Formulario de creación de pedidos</h2></th>
</tr>

<td >Nombre:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" required> </td></tr>


<td >Cedula / RUC:</td>
<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" required onKeyPress="return numbersonly(this, event)" ></td></tr>


<td>Celular:</td>
<td ><Input Type=Text Size = 10 Maxlenght=10 Name="celular" id="celular" required onKeyPress="return numbersonly(this, event)"></td></tr>
</tr>
<td>Mail:</td>
<td ><Input Type=Text Size = 40 Maxlenght=40 Name="mail" id="mail" required></td></tr>
</tr>
<td>Ciudad:</td>
<td >
  <select name="listciudad" id="listciudad" class="demoInputBox">

  <option value="">--Seleccionar Ciudad--</option>
  <?php
  $sql8="SELECT * FROM covidciudadeslista";
       $result8=$dbhandle->query($sql8);
  while($rs8=$result8->fetch_assoc()) {
  ?>
  <option value="<?php echo $rs8["ciudad"]; ?>"><?php echo $rs8["ciudad"]; ?></option>
  <?php
  }
  ?>
  </select>
</td>
</tr>
</tr>

<td >Dirección:</td>
<td ><textarea name="direccion" rows="4" cols="100" required>
</textarea></td>
</tr>

<td >Referencia:</td>
<td> <textarea name="referencia" rows="4" cols="100">
</textarea></td></tr>

<td><strong> Computron desde donde se factura:<strong></td><td><div id="ordenbodegaf" >
	<strong>Provincia:<strong>
		<select name="provincia" id="country-list" class="demoInputBox"  onChange="getState1(this.value);">

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
		</select><strong>&nbsp&nbsp&nbspBodega:<strong>
		<select id="state-list1" name="bodega1"   >
		<option value="">Seleccione bodega</option>

		</select></td ></tr>
</td></tr></div>

<td >Compra:</td>
<td>
<textarea name="compra" rows="4" cols="100" required>
</textarea>
</td>
</tr>
<td >Comentarios:</td>
<td>
<textarea name="comentarios" rows="2" cols="100" required>
</textarea>
</td>
</tr>

<td >Valor total de la compra:</span></td>
<td >
<Input  Type="text" Size = 10 Maxlenght=10 Name="total" id="total" onkeyup="checkDec(this) ;">
</td></tr>
<td><span>Forma de pago:</span></td>
<td>
<select name="pago" id = "ddlcredito" onchange = "ShowHideDiv()" required>
  <option value="">Seleccione forma de pago</option>
  <option value="Paymentez">Paymentez</option>
  <option value="Tarjeta">Tarjeta</option>
  <option value="Transferencia">Transferencia</option>
  <option value="LinkToPay">Link To Pay</option>
  <option value="Directo">Crédito Directo</option>
  <option value="Tienda">Pago en tienda </option>
</select>
</td></tr>
<td></td><td>
<div id="dvcredito" style="display: none">
    <b>Número de cuotas: </b>
    <input type="text" Size = 5 Maxlenght=5 id="numcuotas" name="numcuotas" />
    <b>Valor de cuota: </b>
    <input type="text" Size = 5 Maxlenght=5 id="valcuotas" name="valcuotas" />
</div>

<div id="linktopay" style="display: none">
    <b>Enlace LINKTOPAY: </b>
    <input type="text" Size = 40 Maxlenght=70 id="linktopay" name="linktopay" />
</div>


<div id="tarjeta" style="display: none">
<b>Tipo de tarjeta de crédito: </b>
<select name="tipotarjeta" id="tipotarjeta" ;">
<?php
global $zzt;
 for ($x = 0; $x <= $zzt; $x++) {
	echo "<option value= '$mostrart[$x]' >$mostrart[$x]</option>";
}
?>
</select>
</div>

</td></tr>

<?php
session_start();
$nivel=$_SESSION["nivel"];

if ($nivel >= 20 )
{
echo "<td >Orden WEB:</td>";
echo "<td ><Input Type=Text Size = 12 Maxlenght=12 Name='ordenweb' id='ordenweb'></td></tr>";
}
else
{
echo "<Input Type=hidden Name='ordenweb' value=''>";
}


?>


<td>Vendedor:</td>
<td>

<select name="vendedor" id="vendedor" ;">
<?php
global $zz;
if ($nivel>=20)
{
  for ($x = 0; $x <= $zz; $x++) {
		if($marcas[$x] == "5")
		{
		echo "<option value= '$mostrar[$x]' selected>$mostrar[$x]</option>";
		}
		else
		{
		echo "<option value= '$mostrar[$x]'>$mostrar[$x]</option>";
		}
  }
}
else
{
  for ($x = 0; $x <= $zz; $x++) {
		if($mostrar[$x] == $_SESSION["usuario"])
		{
		echo "<option value= '$mostrar[$x]' selected>$mostrar[$x]</option>";
		}
		else
		{
		echo "<option value= '$mostrar[$x]'>$mostrar[$x]</option>";
		}
  }
}
?>
</select>

</td></tr>


<td><span>Forma de ingreso del cliente:</span></td>
<td>
<select name="ingresocli" id = "ingresocli" required>
  <option value="">Seleccione una opción...</option>
  <option value="Web">Web</option>
  <option value="Chat">Chat</option>
  <option value="Whatsapp">Whatsapp</option>
  <option value="Aplicacion de Credito Online">Aplicación de Crédito Online</option>
  <option value="Call Inbound">Call Inbound</option>
  <option value="Call Outbound">Call Outbound</option>
  <option value="Redes">Redes</option>
  <option value="Otro">Otro</option>
</select>
</td></tr>

<td><span>Forma de despacho:</span></td>
<td>
<select name="despacho" id = "ddldespacho" onchange = "ShowHideDiv2()" required>
  <!-- <option value="">Seleccione forma de despacho</option> -->
  <option value="Pickup">Pickup</option>
  <option value="Envio" selected>Envío</option>
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
</td></tr></div>


<td></td><td><Center><Input Type=Submit Value="Ingresar venta" class="btn btn-sm btn-primary"></Center></td>
</table>


</form>

</body>

</html>
