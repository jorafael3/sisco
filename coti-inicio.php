<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas.css">

</head>
<?PHP

session_start();
//if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}


?>
 
<HTML>

<style>
div#contenedor{
	margin:auto;
	margin-top:60px;
	width: 90%;
	height: 1200px;
	border: 0px solid black;
}
div#divLogo{
	width: 45%;
	height: 80px;
	background-color: #fafafa;
	float:left;
	border: 0px solid red;
}

div#divBuscar{
	width: 55%;
	height: 80px;
	background-color: #fafafa;
	float:left;
	border: 0px solid green;
}
div#divProductos{
	width: 100%;
	height: 300px;
	background-color: #fafafa;
	float:left;
	border: 0px solid blue;
	overflow-y: scroll

}
div#divCliente{
	width: 100%;
	height: 500px;
	background-color: #fafafa;
	float:left;
	border: 0px solid red;
}

</style>

<!-- 
<style>
table {
  border-collapse: collapse;
  border: 1px solid black;
}
</style>
 -->


<!-- 
<div id="div1" style="display:none">
<table border=1 id="t1">
<tr>
<td>i am here!</td>
</tr>
</table>
</div>
 -->


  <script type="text/javascript">
<!--
   function showMeProd (box) {
    var chboxs = document.getElementById("divProductos").style.display;
    var vis = "none";
        if(chboxs=="none"){
         vis = "block"; }
        if(chboxs=="block"){
         vis = "none"; }
    document.getElementById(box).style.display = vis;
}
  //-->
</script>

  <script type="text/javascript">
<!--
   function showMeCli (box) {
    var chboxs = document.getElementById("divCliente").style.display;
    var vis = "none";
        if(chboxs=="none"){
         vis = "block"; }
        if(chboxs=="block"){
         vis = "none"; }
    document.getElementById(box).style.display = vis;
}
  //-->
</script>


<!--
todo lo que esta arriba en <STYLE> es para dividir la pantalla en 2 y poner
una informacion en un lado y otro en el otro.
mas abajo veras un DIV CONTENEDOR que es el que contiene los 2 paneles individuales
que se llaman  divBuscar y divProductos. Se manejan como paginas separadas
-->


<HEAD>
<!-- 
<link rel="stylesheet" type="text/css" href="boton.css">
 -->

</HEAD>
<BODY>
 <?php include "connectdb.php"; ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#ddlcredito").change(function () {
                if ($(this).val() == "cd") {
                    $("#dvcredito").show();
                } else {
                    $("#dvcredito").hide();
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
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);
require("conexion.php");

session_start();
$chbxCliente = $_SESSION['coticliente'];
$chbxProducto= $_SESSION['cotiproducto'];
//echo "<br><br><br>Btn1:".$chbxCliemte."Btn2:".$chbxProducto ;
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


if (isset($_SESSION['datosarreglos']))
{
$arreglo = $_SESSION['datosarreglos']; // Cargo el arreglo de la memoria
}
else
{
$arreglo = array();
$notas = "";
$regalos = "";
$celular = 0; // esto es porque si hay celular en la lista entoinces credito maximo 18 meses
}

// session_start es para indicar que voy a leer variables que las he grabado o las grabare
// a nivel de sistema. La idea es que todas las filas que recibo de la consulta de la base de
// datos la meto en un arreglo y el arreglo lo grabo en memoria. Asi puedo manipular la infoemacion en el
// arreglo, asi puedo agrupar todos los seguros, etc.
// y los grabo en memoria porque cuando paso de una pagina a otra se pierden si es que no los
// grabo antes



// aqui hago lo mismo, pero solo para los seguros y poderlos ir totalizando



$xx = count($arreglo); //Cuento las filas del arreglo

?>
<Form Action='coti-selecboton.php' Method='post'>
<div id="contenedor">


<!-- 
<select disabled  name="pagodisabled" id = "ddlcredito" onchange = "ShowHideDiv()" >
 -->



	<div id="divLogo">
    	<center><img src="images/logo.png" alt="Computron"><center>
    </div>

	<div id="divBuscar" >
	&nbsp&nbsp&nbsp
	<?php
	if ($chbxProducto == 1)
	{ echo "<script>showMeProd('divProductos')</script>";
	echo "<input type=\"checkbox\" name=\"cotiproducto\" value=\"1\" checked=\"checked\" onchange=\"showMeProd('divProductos')  \"><label for=\"cotiproducto\"> Mostrar Cotizador</label>";
	} else {
	echo "<input type=\"checkbox\" name=\"cotiproducto\" value=\"1\" onchange=\"showMeProd('divProductos')\"><label for=\"cotiproducto\"> Mostrar Cotizador</label>";
   	}
	if ($chbxCliente == 1)
	{echo "<script>showMeProd('divCliente')</script>";
	echo "<input type=\"checkbox\" name=\"coticliente\" checked=\"checked\" value=\"1\" onchange=\"showMeCli('divCliente')  \"><label for=\"cliente\"> Mostrar datos del cliente</label>";
	} else {
	echo "<input type=\"checkbox\" name=\"coticliente\"  value=\"1\" onchange=\"showMeCli('divCliente')  \"><label for=\"cliente\"> Mostrar datos del cliente</label>";
	 }
	       
				//echo "<br>";
				if (!isset($_SESSION['sentrada'])) // solo muestro el casillero de buscar productos si no hjay entrada
				{
				//echo "<Form Action=\"coti-consinventario1.php\" Method=\"post\">";
				echo "<br><table border=0 cellpadding=2 cellspacing=2 align='center' >";
				echo "<td><Center>Buscar: <Input Type=Text Size = 30 Maxlenght=30 Name=\"nombre\" id=\"nombre\" autofocus></td>";

				echo "<td><Input Type=Submit Value=\"Consultar\" name='busca' class=\"btn btn-sm btn-primary\"></Center></td></tr>";
				//echo "</Form>";
				}
				//echo "<Form Action='coti-elimina.php' Method='post'>";
				//echo "<td><center><input type='submit' name='elimina' value='Borrar todo' class='btn btn-sm btn-primary'></form><center></td></tr>";
				echo "<td colspan = 3><center>( Puede buscar mas de una palabra utilizando el % )</td></tr>";
				echo "</table>";

			?>

  	</div>
	<?php
	if ($chbxProducto == 1){ 
	echo "<div id=\"divProductos\" style=\"display:inline\" >";
	} else {
	echo "<div id=\"divProductos\" style=\"display:none\" >";
	}
				
				echo "<br><table border=1 cellpadding=10 cellspacing=0 width = 90% align='center'><tr><th align=center width = 5% ><Center>#</Center></th>
				<th align=center  >Producto </th> <th align=center  ><Center>Valor a <br> Financiar </Center></th>
				<th align=center  ><Center>Cuota<br>3 </Center></th><th align=center  ><Center>Cuota<br>6 </Center></th>
				<th align=center  ><Center>Cuota<br>9 </Center></Center></th>
				<th align=center  ><Center>Cuota<br>12 </Center></th>
				<th align=center  >Cuota<br>18 </Center></th>
				<th align=center  ><Center>Cuota<br>24 </Center></th>
				<th align=center  ><Center>Precio<br>Tarjeta </Center></th>
				<th align=center  ><Center>Acción</Center><br></th>
				<th align=center  ><Center>Acción</Center><br></th></tr>";

				$tnormal = 0;
				$tprecio = 0;
				$t12 = 0;
				$t18 = 0;
				$t24 = 0;
				$t3 = 0;
				$t6 = 0;
				$t9 = 0;

				// determino cual es el valor minimo de la lista
				$minimo=(float)$arreglo[0][3];
				for ($re = 0; $re <= $xx-1; $re++) {
				  if ((float)$arreglo[$re][3]< $minimo)
				  {$minimo=(float)$arreglo[$re][3];}
				}
				//echo $minimo;


				if ($xx > 0){
					for ($re = 0; $re <= $xx-1; $re++) {
					echo "<td><Center>".$re."</Center></td>";
					echo "<td>".$arreglo[$re][2]."</td>";
					if (substr($arreglo[$re][2],0,7)== "CELULAR") {$celular = 1;}
					echo "<td align='right'>".number_format($arreglo[$re][3],2,",",".")."</td>";

					echo "<td align='right'>".number_format($arreglo[$re][7],2,",",".")."</td>";
					echo "<td align='right'>".number_format($arreglo[$re][8],2,",",".")."</td>";
					echo "<td align='right'>".number_format($arreglo[$re][9],2,",",".")."</td>";

					echo "<td align='right'>".number_format($arreglo[$re][4],2,",",".")."</td>";
					echo "<td align='right'>".number_format($arreglo[$re][5],2,",",".")."</td>";
					echo "<td align='right'>".number_format($arreglo[$re][6],2,",",".")."</td>";
					echo "<td align='right'>".number_format($arreglo[$re][10],2,",",".")."</td>";
					//echo floatval($arreglo[$re][3]);
					if ( (float)$arreglo[$re][3]<=50 and $_SESSION['regalo']<>1 and (float)$arreglo[$re][3]==$minimo)
					{
			            echo "<td align=center  ><a href=coti-regalo.php?sec=$re><img src='images/gift.png' border='0' height='18' width='18'></a></td>";
					} else {echo "<td></td>";}
		            echo "<td align=center  ><a href=coti-elimcol1.php?sec=$re><img src='images/remove-80.png' border='0' height='24' width='24'></a></td></tr>";


                    $tnormal = $tnormal + $arreglo[$re][10] ;
                    $tprecio = $tprecio + $arreglo[$re][3] ;
					$t12 = $t12 + $arreglo[$re][4];
					$t18 = $t18 + $arreglo[$re][5];
					$t24 = $t24 + $arreglo[$re][6];
					$t3 = $t3 + $arreglo[$re][7];
					$t6 = $t6 + $arreglo[$re][8];
					$t9 = $t9 + $arreglo[$re][9];
					}

				}

				echo "<td><Center>--</Center></td><td align='right'><strong> TOTAL ---> </td><td align='right'>".number_format($tprecio,2,",",".")."</td>";

				echo "<td align='right'>".number_format(floatval($t3),2,",",".")."</td>";
				echo "<td align='right'>".number_format($t6,2,",",".")."</td>";
				echo "<td align='right'>".number_format($t9,2,",",".")."</td></strong>";

				echo "<td align='right'>".number_format(floatval($t12),2,",",".")."</td>";
				echo "<td align='right'>".number_format($t18,2,",",".")."</td>";
				echo "<td align='right'>".number_format($t24,2,",",".")."</td></strong>";
				echo "<td align='right'>".number_format($tnormal,2,",",".")."</td></strong>";

				// Aqui verifico si hay alguna entrada
				if (isset($_SESSION['sentrada'])) // veo si existe el arreglo de seguros
    			{
        			$entrada = $_SESSION['sentrada']; // Cargo el arreglo de la memoria
    			}
    			else
    			{
        			$entrada = array();
    			}
    			$conteo = count($entrada);

				if (isset($_SESSION['sentrada']))
				{
					$zz=0;
					while ($zz <= $conteo-1) {
					echo "<td>--</td><td align='right'><strong> ".$entrada[$zz][1]."</td>";
					echo "<td align='right'>".number_format($entrada[$zz][5],2,",",".")."</td>";
					echo "<td align='right'>".number_format($entrada[$zz][2],2,",",".")."</td>";
					echo "<td align='right'>".number_format($entrada[$zz][3],2,",",".")."</td>";
					echo "<td align='right'>".number_format($entrada[$zz][4],2,",",".")."</td></tr>";

					$zz = $zz+1;
					}
				}

                echo "</table>";
                $_SESSION['stprecio'] = $tprecio;

     			if (count($arreglo)>= 1)
     			{
                //echo "<br>";
                //echo "<Form Action=\"entrada.php\" Method=\"post\">";
                //echo "<Center>Entrada: <Input Type=Text Size = 10 Maxlenght=10 Name=\"ent\" id=\"ent\">";

                //echo "<Input Type=Submit Value=\"Calcular\" class=\"btn btn-large btn-primary\"></Center>";
                //echo "</Form>";
                }



				//echo  "<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
				//echo "<b>Cédula: </b>".$_SESSION["cedula"] ."<b>Celular: </b>".$_SESSION["celular"] ."<b> Nombre: </b>".$_SESSION["nombre"];

			?>
					<!-- 
<Form Action='coti-grabar.php' Method='post'>
					
 -->
 
</div> 

<?php
	if ($chbxCliente == 1){ 
	echo "<div id=\"divCliente\" style=\"display:inline\" >";
	} else {
	echo "<div id=\"divCliente\" style=\"display:none\" >";
	}

echo "<center><table border=0 cellpadding=0 cellspacing=0 ></center><tr> <br>";
echo "<Th colspan =4><h2>Datos del cliente:</h2></th></tr>";

 
 session_start();
echo "<th >Nombre:</th>";
if (isset($_SESSION['snombrecli']))
{echo "<td ><Input Type=Text Size = 40 Maxlenght=100 Name='nombrecli' id='nombrecli'  value = '".$_SESSION['snombrecli']."'> </td>";}
else
{echo "<td ><Input Type=Text Size = 40 Maxlenght=100 Name=\"nombrecli\" id=\"nombrecli\" > </td>";}


echo "<th >Cedula / RUC:</th>";
if (isset($_SESSION['scedula']))
{echo "<td ><Input Type=Text Size = 40 Maxlenght=100 Name=\"cedula\" id=\"cedula\"  value = '".$_SESSION['scedula']."'></td></tr>";}
else {echo "<td ><Input Type=Text Size = 40 Maxlenght=100 Name=\"cedula\" id=\"cedula\" ></td></tr>";}


echo "<th>Celular:</th>";
if (isset($_SESSION['scelular']))
{echo "<td ><Input Type=Text Size = 10 Maxlenght=10 Name=\"celular\" id=\"celular\"  value = '".$_SESSION['scelular']."'></td>";}
else{echo "<td ><Input Type=Text Size = 10 Maxlenght=10 Name=\"celular\" id=\"celular\" ></td>";}



echo "<th>Mail:</th>";
if (isset($_SESSION['smail']))
{echo "<td ><Input Type=Text Size = 40 Maxlenght=40 Name=\"mail\" id=\"mail\"  value = '".$_SESSION['smail']."'></td></tr>";}
else
{echo "<td ><Input Type=Text Size = 40 Maxlenght=40 Name=\"mail\" id=\"mail\" ></td></tr>";}



echo "<th>Ciudad:</th>";
if (isset($_SESSION['sciudad']))
{echo "<td ><Input Type=Text Size = 40 Maxlenght=40 Name=\"ciudad\" id=\"ciudad\"  value = '".$_SESSION['sciudad']."'></td>";}
else {echo "<td ><Input Type=Text Size = 40 Maxlenght=40 Name=\"ciudad\" id=\"ciudad\" ></td>";}
echo "<th></th></tr>";

echo "<th >Dirección:</th>";
if (isset($_SESSION['sdireccion']))
{echo "<td ><textarea name=\"direccion\" rows=\"4\" cols=\"40\" >".$_SESSION['sdireccion']."</textarea></td>";}
else {echo "<td ><textarea name=\"direccion\" rows=\"4\" cols=\"40\" ></textarea></td>";}


echo "<th >Referencia:</th>";
if (isset($_SESSION['sreferencia']))
{ echo "<td> <textarea name=\"referencia\" rows=\"4\" cols=\"40\">".$_SESSION['sreferencia']."</textarea></td></tr>";}
else {echo "<td> <textarea name=\"referencia\" rows=\"4\" cols=\"40\"></textarea></td></tr>";}

?>

<th>Comentarios:</th>
<td>
<textarea name="comentarios" rows="2" cols="40" > 
</textarea>
</td>

<th><br>Vendedor:</th>
<td><br>
 
<select name="vendedor" id="vendedor" ;">
<?php 
$nivel=$_SESSION["nivel"];

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

<th><br>Forma de pago</th>
<td ><br>
<select name="pagoforma" id = "ddlcredito" onchange = "ShowHideDiv()" >
  <option value="">Seleccione forma de pago</option>
   <option value="tc">Tarjeta</option>
  <option value="cd">C. Directo</option>
</select></td>
<td></td><td><div id="dvcredito" style="display: none">
					<br>Plazo:
					<input type="radio" name="plazo" value="3"> 3
					<input type="radio" name="plazo" value="6"> 6
					<input type="radio" name="plazo" value="9" > 9
					<input type="radio" name="plazo" value="12"> 12
					<?php if ($celular == 0) {
						echo   "<input type=\"radio\" name=\"plazo\" value=\"18\"> 18";
						echo   "<input type=\"radio\" name=\"plazo\" value=\"24\" checked> 24" ;
					} else {
						echo   "<input type=\"radio\" name=\"plazo\" value=\"18\" checked> 18";
					}
					echo "<br>";
					?>				
</td></tr></div>





<th><span>Forma de ingreso del cliente:</span></th>
<td colspan =3>
<select name="ingresocli" id = "ingresocli" >
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

<th><span>Forma de despacho:</span></th>
<td>
<select name="despacho" id = "ddldespacho" onchange = "ShowHidedivProductos()" >
  <!-- <option value="">Seleccione forma de despacho</option> -->
  <option value="Pickup">Pickup</option>
  <option value="Envio" selected>Envío</option>
</select>
</td>
<td colspan =2>
<div id="dvdespacho" style="display: none">
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
		</select><strong>&nbsp&nbsp&nbspBodega:<strong>
		<select id="state-list" name="bodega"   >
		<option value="">Seleccione bodega</option>
		
		</select></td ></tr>
</div>





					<br><td colspan =4><br><center><input type="submit" name="grabadatos" value="GRABAR DATOS" class="btn btn-sm btn-primary"></center><br></td></tr>

					<td colspan =4><center><input type='submit' name='elimina' value='Borrar todo' class='btn btn-sm btn-primary'><center></td></tr>


				</form>



	</div>



</div>
</div>


</BODY>
</HTML>
