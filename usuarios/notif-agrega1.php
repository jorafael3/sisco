<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menus.css">
<script src="https://code.jquery.com/jquery-git.js"></script>
<link rel="stylesheet" type="text/css" href="../css/menumin.css">


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

</head>

<body>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("../barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("../conexion.php");
include "../connectdb.php";
?>





 
  <Form Action="notif-agrega2.php" Method="POST"><br>
  <center><table border=1 cellpadding=5 cellspacing=1 width=600><th><img src="../logo.png" height="auto" width="80%"></th> <th><br><h3>Asignar correo y SMS a local: </h3></th><tr>

   <th><b> 
	<strong>Provincia:<strong></b></th><td>
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
		</td></tr>
		<th><b>
		Bodega:</b></th></td>
		<td>
		<select id="state-list" name="bodega"  required >
		<option value="">Seleccione bodega</option>
		
		</select></td></tr>
      <th><left>Mail:</th><td><Input Type=Text  Size = 25 Maxlenght=145  Name="mail" id="mail" placeholder="Correo electrónico" required >     </left></td></tr>
   <th><left>SMS:</th><td><Input Type=Text  Size = 10 Maxlenght=10  Name="sms" placeholder="SMS" required>      </left><br></td><tr>
   <Br><Br>
   <Input Type=hidden Name='provname' value='<?php echo $rs["provincia"]; ?>'>


   <th>Opciones:<center></th><td><center><Input Type=Submit Value="Crear" class="btn btn-sm btn-primary"></center>
   </Form>


</td></tr>
</p>
</body>
</html>