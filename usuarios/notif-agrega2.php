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

$mail=$_POST['mail']; 
$sms=$_POST['sms']; 
if (isset($_POST['bodega'])){$bodega = $_POST['bodega'];} else {$bodega ='';}
if (isset($_POST['provincia'])){$provincia = $_POST['provincia'];} else {$provincia ='';}
if (!isset($_SESSION["usuario"])) {header("Location: usuarios1.php");}

$sql = "select * from covidprovincia where idgrupo = '$provincia' ";
$result = mysqli_query($con, $sql); /// Para MySQL 
$row = mysqli_fetch_array($result);
$provincia = $row['provincia'];

//die($mail." - ".$sms." - ".$bodega." - ".$provincia);
include("../barramenu.php");


$sqlCrea = "insert  into  covidnotificaciones (provincia, local, mail, sms) 
Values ('$provincia', '$bodega', '$mail', '$sms')";
$result = mysqli_query($con, $sqlCrea); /// Para MySQL 
mysqli_close($con);
echo "<br><br><h3>Registro creado correctamente...</h3>";

header("URL=notificaciones.php");
?>

</body>
</p>
</html>