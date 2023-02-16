<?php 
session_start();
$usuario = $_SESSION['usuario'];

include("conexion.php");

  	$result = mysqli_query($con, "SELECT * FROM covidmensajes WHERE usuariopara = '$usuario' and leido= 0 ");
	$count=mysqli_num_rows($result);
//   while($row = mysqli_fetch_array($result)) {
		if ($count >=1)
		{
        echo "<a href=mensajes1.php?usu=$usuario><h3 style=\"color:red\"><center>".$usuario." tiene ".$count." mensaje(s) nuevo(s) </center></h3></a>";
		}
		//<a href=form1a.php?sec=$sec>
//$file="alarm.mp3";
//echo "<iframe width=\"854\" height=\"480\" style=\"display:none;\"  src=\"alarm.mp3\" frameborder=\"0\" allowfullscreen></iframe>";
// }


?>
