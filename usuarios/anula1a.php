<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="../css/boton.css">
<link rel="stylesheet" type="text/css" href="../css/menumin.css">
<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
</head>
<script type="text/javascript">
function setfocus()
{
document.getElementById("myusername").focus();
}
</script>

<?php
include("barramenu.php");

$sec=$_GET['sec'];
?>

<TITLE>Creación de clientes</TITLE>
</HEAD>
<BODY>
</br>


<BODY onload="setfocus()">


<center>
<br><br><br><br><br>
<table border=1 cellpadding=5 cellspacing=1 width=400>


<th><Center><img src="../images/logo.png" height="50" width="220"></Center></th> <th><h3>Ingrese datos de SUPERVISOR </h3></th><tr>

<Form Action="anula1b.php" Method="post">
	<th><left><strong>Transacción:</strong></th>
	<td><Center><Input Size = 10 Maxlenght=10 readonly name="sec" type="text" id="sec" value = "<?php echo $sec?>"></Center></td></tr>
	<th><left><strong>Usuario:</strong></th>
	<td><Center><Input Size = 10 Maxlenght=10 name="myusername" type="text" id="myusername"></Center></td></tr>
	<th><left><strong>Contraseña:</strong></th>
	<td><left><Center><Input Size = 10 Maxlenght=10 name="mypassword" type="password" id="mypassword"></Center></td></tr>
		<th ><strong>Comentarios:</strong></th>
		<td ><textarea   rows="5" cols="40" name="comentarios" required> 
		</textarea></td>
		</tr>
<!-- 
	<Input Type=hidden Name='ordenweb' value=''>
 -->
	<th></th><td><Center><Input Type=Submit Value="Anular" class="btn btn-sm btn-primary"></Center></td></tr>

</Form>


</td><tr>





</BODY>
</HTML>