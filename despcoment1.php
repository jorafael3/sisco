<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/tablas.css">
<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
</head>
<style>
div#contenedor{
	margin:auto;
	margin-top:60px;
	width: 90%;
	height: 800px;
	border: 0px solid black;
}
div#izquierda{
	width: 45%;
	height: 800px;
	background-color: #fafafa;
	float:left;
}

div#derecha{
	width: 55%;
	height: 800px;
	background-color: #fafafa;
	float:left;
}

</style>
<body>
<?php
// para aplicar el pago a las que son Paymentez, credito directo o transferencias

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
$sec= $_GET['sec'] ;
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$sql = "SELECT * FROM covidsales where secuencia = $sec ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$nombre = $row['nombres'];
$cedula = $row['cedula'];
$celular = $row['celular'];
$cuenta = $row['comentlogi'];
$cuenta = $cuenta +1;
?>

<div id="contenedor">
	<div id="izquierda">

		<Form Action="despcoment2.php" Method="post" >



		<table border=0 cellpadding=0 cellspacing=0 >
		<tr> 
		<TD><h2>Comentarios de órdenes o despachos</h2></td>

		</tr>

		</table>



		<table border=0 cellpadding=1 cellspacing=3 width=65%>
 
		<td >Nombre:</td>
		<td ><Input Type=Text Size = 40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre?>" > </td></tr>


		<td >Cedula / RUC:</td>
		<td ><Input Type=Text Size = 40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula?>"></td></tr>


		<td>Celular:</td>
		<td ><Input Type=Text Size = 13 Maxlenght=13 Name="celular" id="celular" value="<?php echo $celular?>"></td></tr>
		</tr>

		<td >Comentarios:</td>
		<td ><textarea   rows="4" cols="70" name="comentarios" required> 
		</textarea></td>
		</tr>


		<Input Type=hidden Name='sec' value='<?php echo $sec;?>' >
        <Input Type=hidden Name='cuenta' value='<?php echo $cuenta;?>' >
		<td colspan = 2><br><Center><Input Type=Submit Value="Guardar" class="btn btn-sm btn-primary"></Center>

		</table>
		</form>
	</div>
	<div id="derecha">
		<?php
		require("conexion.php");
		$sql1 = "SELECT * FROM covidlogistica where transaccion = '$sec' ";
		$result1 = mysqli_query($con, $sql1);
		echo "<table border=0 cellpadding=1 cellspacing=3 width=65%></tr>";
		echo "<th colspan = 3><center><h3>Comentarios anteriores:</h3><center></th></tr>";		
		echo "<th >Fecha:</th><th >Usuario:</th><th >Comentario:</th></tr>";
		while($row1 = mysqli_fetch_array($result1)) {
 			$fec=$row1['fecha'];
 			$usu=$row1['usuario'];
 			$com=$row1['comentario'];
 			echo "<td>".$row1['fecha']."</td><td>".$usu."</td><td width='70%'>".$com."</td></tr>";
 		}
		echo "</table>";

		
		
		?>
	</div>
	
	
</div>
	
</body>
</html>