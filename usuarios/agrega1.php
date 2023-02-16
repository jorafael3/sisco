<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/menumin.css">

<?php include "../connectdb.php"; ?>

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
<script type="text/Javascript">
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
</script>



<body>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("../barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}


?>

 
  <Form Action="agrega1a.php" Method="POST"><br>
  <center><table border=1 cellpadding=5 cellspacing=1 width=600><th><img src="../logo.png" height="auto" width="80%"></th> <th><br><h3>Crear usuario: </h3></th><tr>

   <th><left>Usuario:</th><td><Input Type=Text  Size = 15 Maxlenght=15  Name="usuario" id="usuario" style='text-transform:uppercase' required>     </left><br>(*) debe ser único<br></td></tr>
   <th><left>Nombres:</th><td><Input Type=Text  Size = 25 Maxlenght=25  Name="nombres" id="nombres" style='text-transform:uppercase' placeholder='Apellido y nombre' required>     </left></td></tr>

   <th><left>Contraseña:</th><td><Input Type=Text  Size = 10 Maxlenght=10  Name="password" placeholder="Contraseña">      </left><br></td><tr>
   <Br><Br>
   <th><b>
   Niveles de ACCESO: </b></th><td>
   <select name='nivel' id='nivel' >
   <option value="10">Vendedor</option>
   <option value="22">Vendedor Web</option>
   <option value="20">Cajero</option>
   <option value="24">Cobros Tarjeta Crédito</option>
   <option value="26">Crédito Directo</option>
   <option value="28">Aprobación Call Center</option>
   <option value="30">Despacho</option>
   <option value="40">Administrador</option>
   <option value="99">Solo VER</option>
   </select></td></tr>
   <th><b>
      Canal de Venta: </b></th><td>
   <select name='canal' id='canal' >
   <option value=0>OnLine</option>
   <option value=1>CallCenter</option>
   <option value=2>Web</option>
   <option value=3>proveedor1</option>
   <option value=4>proveedor2</option>
   <option value=5>proveedor3</option>
   </select></td></tr>
   <th><left>Mail:</th><td>    
<!-- 
<Input Type="email"  Size = 35 Maxlenght=25  Name="mail" id="mail" style='text-transform:lowercase' required>
 -->
<input type="email" name="email" Size = 35 Maxlenght=35 pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder='Dirección de correo electrónico'>
 </left></td></tr>

   <th><left>Celular:</th><td><Input Type=Text  Size = 10 Maxlenght=10  Name="celular" id="celular"  onkeyup="checkDec(this)" placeholder='# celular'>     </left></td></tr>

<th ><strong>Recibir notificaciones de:</strong></th>
<td ><strong>Provincia:<strong>
<select name="provincia" id="country-list" class="demoInputBox"  onChange="getState(this.value);">		
<option value="">Seleccione provincia</option>
<?php
$sql1="SELECT * FROM covidprovincia";
$results=$dbhandle->query($sql1); 
while($rs=$results->fetch_assoc()) {  ?>
<option value="<?php echo $rs["idgrupo"]; ?>"><?php echo $rs["provincia"]; ?></option>
<?php } ?>
</select><br><strong>&nbsp&nbsp&nbspBodega:<strong>
<select id="state-list" name="bodega"   >
<option value="">Seleccione bodega</option>
</select></td ></tr>


<th>Opciones:<center></th><td><center><Input Type=Submit Value="Crear" class="btn btn-sm btn-primary"></center>
</Form>


</td></tr>
</p>
</body>
</html>