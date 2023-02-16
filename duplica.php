<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>

<script type="text/javascript">
function setfocus()
{
document.getElementById("myusername").focus();
}
</script>

<?php
session_start();
$usuario=$_POST['usuario'];
$password=$_POST['password'];
$nivel=$_POST['nivel'];
$sec=$_POST['sec'];
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

?>

<TITLE>Duplicar órdenes</TITLE>
</HEAD>
<BODY>
</br>


<BODY onload="setfocus()">


<center>
<br><br><br><br><br>
<table border=1 cellpadding=5 cellspacing=1 width=400>


<td><Center><img src="logo.png" height="100" width="220"></Center></td> <td><h3>Duplicar <br>Orden </h3></td><tr>

<Form Action="duplica2.php" Method="post">
	<td><left><strong>Orden:</strong></td>
	<td><Center><Input Size = 10 Maxlenght=10 readonly name="sec" type="text" id="sec" value = "<?php echo $sec?>"></Center></td></tr>


	<Input Type=hidden Name='sec' value='<?php echo $sec ?>'>
<!-- 	<Input Type=hidden Name='p1' value='<?php echo $password ?>'>
	<Input Type=hidden Name='n1' value='<?php echo $nivel ?>'>
 -->

	<td></td><td><Center><Input Type=Submit Value="Continuar"></Center></td></tr>
		
</Form>


</td><tr>





</BODY>
</HTML>