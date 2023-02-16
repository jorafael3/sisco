<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/menumin.css">
<script type="text/Javascript">
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
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


<script>
function submitForm() {
  return confirm('Revise sus cambios!\nPara continuar presione Aceptar');
}</script>

<body>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: ../index.php");}
include("../barramenu.php");
require("../conexion.php");
include "../connectdb.php"; 

//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
$sec=$_GET['sec'];

$sql = " select * from covidusuarios where secuencia = '$sec' ";
//echo $sql."<br>";
$result = mysqli_query($con, $sql); 
$row = mysqli_fetch_array($result);

$usuario = $row['usuario'];
$nivel = $row['nivel'];
$canal = $row['canal'];

$nombres = $row['nombres'];
$celular = $row['celular'];
$mail = $row['mail'];
$provincia = $row['provincia'];
$bodega = $row['bodega'];
$sqlp = " select * from covidprovincia where idgrupo = '$provincia' ";

$resultp = mysqli_query($con, $sqlp); 
while($rowp = mysqli_fetch_array($resultp)) 
{ $provincianame = $rowp['provincia']; }

?>

 
  <Form Action="modifica2.php" Method="POST" onsubmit="return submitForm(this);"><br>
  <center><table border=1 cellpadding=5 cellspacing=1 width=700><th width=300><img src="../logo.png" height="auto" width="90%"></th> <th><br><h3>Modificar usuario: </h3></th><tr>

   <th><left>Usuario:</th><td><Input Type=Text  Size = 15 Maxlenght=15  Name="usuario" id="usuario" style='text-transform:uppercase' value = '<?php echo $usuario?>' readonly>     </left></td></tr>
	<th><left>Nombres:</th><td><Input Type=Text  Size = 25 Maxlenght=25  Name="nombres" id="nombres" style='text-transform:uppercase' value = '<?php echo $nombres?>' placeholder='Apellido y nombre' required>     </left></td></tr>
   <th><left>Celular:</th><td><Input Type=Text  Size = 11 Maxlenght=10  Name="celular" id="celular"  value = '<?php echo $celular?>' onkeyup="checkDec(this)" placeholder='# celular' required>     </left></td></tr>
   <th><left>Correo:</th><td>     
<input type="email" name="email" Size = 35 Maxlenght=35 value = '<?php echo $mail?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder='Dirección de correo electrónico' required>
</left></td></tr>
   <Br><Br>
   <th><b>
   Niveles de ACCESO: </b></th><td>
   <select name='nivel' id='nivel' >
   <?php 
	if ($nivel == "10") {
  	echo "<option value=\"10\" selected>Vendedor</option>"; } else {
  	echo "<option value=\"10\" >Vendedor</option>"; }
	if ($nivel == "22") {
  	echo "<option value=\"22\" selected>Vendedor WEB</option>"; } else {
  	echo "<option value=\"22\" >Vendedor WEB</option>"; }
	if ($nivel == "20") {
  	echo "<option value=\"20\" selected>Cajero</option>"; } else {
  	echo "<option value=\"20\" >Cajero</option>"; }
	if ($nivel == "24") {
  	echo "<option value=\"24\" selected>Cobros Tarjeta Crédito</option>"; } else {
  	echo "<option value=\"24\" >Cobros Tarjeta Crédito</option>"; }
	if ($nivel == "26") {
  	echo "<option value=\"26\" selected>Crédito Directo</option>"; } else {
  	echo "<option value=\"26\" >Crédito Directo</option>"; }
	if ($nivel == "28") {
  	echo "<option value=\"28\" selected>Aprobación Call Center</option>"; } else {
  	echo "<option value=\"28\" >Aprobación Call Center</option>"; }
	if ($nivel == "30") {
  	echo "<option value=\"30\" selected>Despacho</option>"; } else {
  	echo "<option value=\"30\" >Despacho</option>"; }
	if ($nivel == "40") {
  	echo "<option value=\"40\" selected>Administrador</option>"; } else {
  	echo "<option value=\"40\" >Administrador</option>"; }
	if ($nivel == "99") {
  	echo "<option value=\"99\" selected>Solo VER</option>"; } else {
  	echo "<option value=\"99\" >Solo VER</option>"; }
   ?>
   </select></td></tr>
   <th><b>
      Canal de Venta: </b></th><td>
   <select name='canal' id='canal' >
      <?php 
	if ($canal == 0) {
  	echo "<option value=0 selected>OnLine</option>"; } else {
  	echo "<option value=0 >OnLine</option>"; }
	if ($canal == 1) {
  	echo "<option value=1 selected>CallCenter</option>"; } else {
  	echo "<option value=1 >CallCenter</option>"; }
	if ($canal == 2) {
  	echo "<option value=2 selected>WEB</option>"; } else {
  	echo "<option value=2 >WEB</option>"; }
   ?>

   </select></td></tr>
	<Input Type=hidden Name='sec' value='<?php echo $sec ?>'>

<th ><strong>Recibir notificaciones de:</strong></th>

<td >
<?php echo $provincianame ." - " .$bodega."<br>"  ?>
<strong>Provincia:<strong>
<select name="provincia" id="country-list" class="demoInputBox"  onChange="getState(this.value);">		
<option value="">Seleccione provincia</option>
<?php
$sql1="SELECT * FROM covidprovincia";
$results=$dbhandle->query($sql1); 
while($rs=$results->fetch_assoc()) {  ?>
	<option value="<?php echo $rs["idgrupo"]; ?>" ><?php echo $rs["provincia"]; ?></option>

<?php } ?>
</select><br><strong>&nbsp&nbsp&nbspBodega:<strong>
<select id="state-list" name="bodega"   >
<option value="">Seleccione bodega</option>
</select></td ></tr>




   <th>Opciones:<center></th><td><center>
   <Input Type=Submit Value="Aplicar cambios" class="btn btn-sm btn-primary">
   </center>
   </Form>


</td></tr>
</p>
</body>
</html>