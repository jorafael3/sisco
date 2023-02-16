
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
    <!-- Font Awsome https://fontawesome.com-->  
  	<script src="https://kit.fontawesome.com/1c253b40c1.js" crossorigin="anonymous"></script>



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
$nivel = $_SESSION["nivel"];
if (!isset($_SESSION["usuario"])) {die("Haga login para iniciar");}
include("../barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}


echo "<H2>Listado de usuarios :</H2>";
//echo "N:".$nivel;

include("../conexion.php");
$sql = "SELECT a.activo, a.bodega, a.canal, a.celular, a.nombres, a.usuario,a.mail, a.nivel, a.usuario, a.secuencia,
b.idgrupo, b.provincia
 FROM covidusuarios  as a
 left join covidprovincia as b on b.idgrupo = a.provincia 
 where activo =1";
//$sql = "SELECT * FROM covidusuarios where activo =1";
$result = mysqli_query($con, $sql); /// Para MySQL
$count = mysqli_num_rows($result);
$color1="#5ffea0";

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
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Usuario </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Función </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=5% height=0><B>Canal </B></th>";

	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Nombres </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Correo </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=5% height=0><B>Celular </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Provincia </B></th>";
	        echo "<th bgcolor='$color1' align=center  width=10% height=0><B>Bodega </B></th>";


            echo "<th bgcolor='$color1' align=center  width=5%  height=0><B><center>Activo</center></B></th>";
            if ($nivel =="40" or $nivel =="28")
            {
            echo "<th bgcolor='$color1' align=center  width=5%  height=0><B><center>Acción</center></B></th>";
            }

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

	  $idn = $row['secuencia'];
	  
	  switch ($row['nivel']) {
	      case "10":
	          $niveld = "Vendedor";
	          break;
	      case "20":
	          $niveld = "Cajero";
	          break;
	      case "24":
	          $niveld = "Cobros Tarjeta Crédito";
	          break;
	      case "26":
	          $niveld = "Crédito Directo";
	          break;
	      case "28":
	          $niveld = "Aprobación Call Center";
	          break;
	      case "30":
	          $niveld = "Despacho";
	          break;
	      case "99":
	          $niveld = "Ver";
	          break;

	      default:
	          $niveld = "Vendedor";
	  }
	  
	  $sec = $row['secuencia'];
	 echo "<td>" . $row['secuencia'] . "</td>";
	  echo "<td>" . $row['usuario'] . "</td>";
	  echo "<td>" . $niveld . "</td>";
	  if ($row['canal']==1 )
		{
			echo "<td>CallCenter</td>";
		} 
	  else 
		{
			if ($row['canal']==2 )
				{
					echo "<td>WEB</td>";
				}
			else
				{	
					echo "<td>Online</td>";
				}	
		}

	  echo "<td>" . $row['nombres'] . "</td>";
	  echo "<td>" . $row['mail'] . "</td>";
	  echo "<td>" . $row['celular'] . "</td>";
	  echo "<td>" . $row['provincia'] . "</td>";
	  echo "<td>" . $row['bodega'] . "</td>";
	  
	  
	  echo "<td><center>" . $row['activo'] . "</center></td>";
	  if ($nivel =="40" or $nivel =="28")
    	{
	  	echo "<td><center><a href=modifica1.php?sec=$sec><i class=\"far fa-edit\"></i></a><br><br><a href=elimina.php?sec=$sec><i class=\"far fa-trash-alt\"></i></a></center></i></td>";
		}
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
