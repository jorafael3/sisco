<html>
<body>
<link rel="stylesheet" type="text/css" href="../css/boton.css">
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?php
include("../conexion.php");
session_start();

$usuario=strtoupper($_GET['usr']); 
$password=$_GET['pass']; 
$nivel=$_GET['nivel']; 
$c=$_GET['c']; 

$nombres=$_GET['nombres']; 
$mail=$_GET['mail']; 
$celular=$_GET['celular']; 
$bodega=$_GET['bodega']; 
$provincia=$_GET['provincia']; 


if (!isset($_SESSION["usuario"])) {header("Location: usuarios1.php");}
include("../barramenu.php");


echo "<br><br><br><br>";
$sqlconsulta = "select * from covidusuarios where ucase(usuario)='$usuario' ";
//echo $sqlconsulta."<br>";

$result1 = mysqli_query($con, $sqlconsulta);

// if ($incompleto ==0)
// {
// if (mysqli_num_rows($result1)>0)
// 	{
// 	echo "<h3>Error: Usuario ya existente...</h3>";
// 	}
// 	else
// 	{
// 	//----- Aqui grabo en la base los datos del usuario nuevo ---//
// 	$sqlCrea = "insert  into  covidusuarios (usuario, clave, nivel, activo, canal, nombres, celular, mail, provincia, bodega) 
// 	Values ('$usuario', '$password', '$nivel', '1' , '$c','$nombres', '$celular', '$mail', '$provincia' , '$bodega')";

// 	$result = mysqli_query($con, $sqlCrea); /// Para MySQL 
// 	mysqli_close($con);
// 	echo "<h3>Usuario creado correctamente...</h3>";
// 	}
// }

//die("fin");
//header("Location: usuarios1.php");	
header("Location: index1.php");
?>

</body>
</p>
</html>