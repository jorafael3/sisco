
<html>
<head>  

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 -->



<!-- 
<title>Sistema SISCO</title>
</head>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/boton.css">
<meta name="viewport" content="width=device-width, height=device-height">
 -->
<link rel="stylesheet" type="text/css" href="../css/tablas.css">

<title>Sistema SISCO</title>
</head>


<?php

session_start();
$susername= $_POST['susername'];

if (!isset($_SESSION["usuario"])) {die("Haga login para iniciar");}
include("../barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}


echo "<br><br><H2>Notificaciones :</H2>";

include("../conexion.php");
$sql = "SELECT * FROM covidnotificaciones where anulado <> 1 ";
$result = mysqli_query($con, $sql); /// Para MySQL
$count = mysqli_num_rows($result);
$color1="#5ffea0";


?>
<FORM METHOD="POST" ACTION="notif-agrega1.php">
<input type="submit" name="agregar" value="Agregar" class="btn btn-sm btn-primary"></td><tr>
</Form>

<?php
echo '<div class="container">';

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==0)
{
  echo "No hay registros! ";
  
}
 else
{

   echo "<table border=1 cellpadding=0 cellspacing=0 width=60%  class=\"table\">";

	echo "<tr>";
            echo "<th bgcolor='$color1' align=center  width=5% height=0><B>Secuencia </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Provincia </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Almacén </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Correo </B></th>";
            echo "<th bgcolor='$color1' align=center  width=5%  height=0><B>SMS</B></th>";
            echo "<th bgcolor='$color1' align=center  width=5%  height=0><B> </B></th>";
            

	echo "<tr>";

$cambio=0;

	while($row = mysqli_fetch_array($result)) {
		  if ($cambio==0)
	  { 
		echo "<tr bgcolor='dddddd'>";
	   } else
	   {
	   	  echo "<tr >";
	
	   }
	  if ($cambio==0){$cambio=1;} else {$cambio=0;}

	  $sec = $row['secuencia'];
	  
	  
	  
echo "<td>" . $row['secuencia'] . "</td>";
echo "<td>" . $row['provincia'] . "</td>";
echo "<td>" . $row['local'] . "</td>";
echo "<td>" . $row['mail'] . "</td>";
echo "<td>" . $row['sms'] . "</td>";
echo "<td align=center  ><a href=notif-elimina.php?sec=$sec><center>  <img src='../images/remove-80.png' alt='Vista Previa' border='0' height='24' width='24'></center></td></tr>";
	  
	  
	  // echo "<td align=center  width=50   ><a href=modifica1.php?sec=$idn>  <img src='../icons/icon_edit.png' alt='Modificar' border='0' height='18' width='18'></td>";
	  // echo "<td align=center  width=50   ><a href=elimina1.php?sec=$idn>  <img src='../icons/cancelar.png' alt='Eliminar este usuario' border='0' height='18' width='18'></td>";
	  echo "</tr>";
	  //if ($i==1){$i=2;} else {$i=1;}
	}



   echo "</table>";

}
   


echo '</div>';
  
?>

</html>
