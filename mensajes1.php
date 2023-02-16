<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="tablas100.css">
<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
</head>
<style>
.contenedor {
	margin:auto;
	margin-top:60px;
	width: 85%;
	height: 800px;
	border: 0px solid black;

}

.div1 {
  float: left;
  postion: absolute;
  width: 35%;
  border: 0px solid black;
  height: 350px;
}

.div2 {
  float: left;
  clear: both;
  vertical-align: bottom;
  width: 35%;
  border: 0px solid black;
  height: 350px;
  display: none;
}

.div3 {
  display: inline-block;
  width: 65%;
  height: 700px;
  border: 0px solid black;
  overflow-y: scroll
  }
  
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

<?php
// para aplicar el pago a las que son Paymentez, credito directo o transferencias

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");

if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
require("conexion.php");
echo "<h3>Usuario: ".$_SESSION["usuario"]."</h3>";
$usuario= $_SESSION["usuario"] ;
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());

// Popular el Dropdown de usuarios:
$marcasdd = array( );
$sqln = "SELECT * FROM covidusuarios where activo ='1' order by usuario   ";
$resultn = mysqli_query($con, $sqln);
$countn = mysqli_num_rows($resultn);
$i=0;
while($rown = mysqli_fetch_array($resultn)) {
$i=$i+1;
$mostrar[]=$rown['usuario'];
$marcas[]= $rown['secuencia'];
}
$zz=count($marcas) - 1;
?>

<div class="contenedor">

		<div class="div1">
				<Form Action="mensajes2.php" Method="post" >
				<table border=0 cellpadding=0 cellspacing=0 >
				<tr> 
				<TD><h2>Mensaje nuevo</h2></td></tr>
				</table>
				<table border=0 cellpadding=1 cellspacing=3 width=65%> 
				<td>Destinatario:</td>
				<td>
				<select name="destinatario" id="destinatario" ;">
				<?php 
				global $zz;
					for ($x = 0; $x <= $zz; $x++) {
							echo "<option value= '$mostrar[$x]'>$mostrar[$x]</option>";
					}
				?>
				 </td></tr>
				<td >Mensaje:</td>
				<td ><textarea   rows="4" cols="70" name="mensaje" required> 
				</textarea></td>
				</tr>
				<Input Type=hidden Name='sec' value='<?php echo $sec;?>' >
				<td colspan = 2><br><Center><Input Type=Submit Value="ENVIAR" class="btn btn-sm btn-primary" name="enviar"></Center>
				</table>
				</form>

		</div>
		<div class="div2" id="div2">
			Div #2
		</div>
		<div class="div3">
				<?php
				require("conexion.php");
				$sql1 = "SELECT * FROM covidmensajes where usuariode = '$usuario' or usuariopara = '$usuario' order by secuencia desc";
				$result1 = mysqli_query($con, $sql1);
				echo "<table border=0 cellpadding=1 cellspacing=3 width='100%' ></tr>";
				echo "<th colspan = 4><center><h3>Listado de mensajes:</h3><center></th></tr>";		
				echo "<th >Fecha:</th><th >De:</th><th >Para:</th><th >Mensaje:</th></tr>";
				while($row1 = mysqli_fetch_array($result1)) {
					$fec=$row1['fechaingreso'];
					$usude=$row1['usuariode'];
					$usupara=$row1['usuariopara'];
					$com=$row1['mensaje'];
					if ($usude<>$usuario){
					echo "<td width='20%'>".$row1['fechaingreso']."</td><td width='15%'><a href=\"#\" onClick=\"document.getElementById('destinatario').value='$usude'\"><i class=\"fas fa-reply\"></i></a>".$usude."</td><td width='15%'>".$usupara."</td><td width='50%'>".$com."</td></tr>";
					} else
					{
					echo "<td width='20%'>".$row1['fechaingreso']."</td><td width='15%'>".$usude."</td><td width='15%'>".$usupara."</td><td width='50%'>".$com."</td></tr>";					
					}
// echo "<a href=\"#\" onClick=\"document.getElementById('destinatario').value='$usude'\">Responder</a>";
				}
				echo "</table>";

				$sqlmarca = "
				UPDATE `covidmensajes` set `leido` = 1 where `usuariopara` = '$usuario' " ;
				mysqli_query($con, $sqlmarca); 
				mysqli_close($con);
				?>
		  </div> 
</div>	



<script>
function habilitarDiv2() {
  var x = document.getElementById("div2");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

</body>
</html>