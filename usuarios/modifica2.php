<html>
<body>
<link rel="stylesheet" type="text/css" href="../css/boton.css">
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: ../index.php");}

$sec=$_POST['sec']; 
$nivel=$_POST['nivel']; 
$canal=$_POST['canal']; 
$nom=$_POST['nombres']; 
$mai=$_POST['email']; 
$cel=$_POST['celular']; 
$pro=$_POST['provincia']; 
$bod=$_POST['bodega']; 

include("../barramenu.php");
include("../conexion.php");


$sql = "UPDATE `covidusuarios` SET nivel='$nivel', canal='$canal', nombres='$nom', mail='$mai', celular='$cel', provincia='$pro', bodega='$bod' where secuencia='$sec' ";
mysqli_query($con, $sql);
mysqli_close($con);

header("Location: usuarios1.php");
?>

</body>
</html>