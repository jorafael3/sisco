<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>Consultas CARTIMEX - Inventario</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
</head>
<body>

<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

//$code=$_GET['code'];

session_start();
// $nombre = $_POST['nombre'];
// $nombre = $_SESSION["nombre"];
// $cedula = $_SESSION["cedula"] ;
// $phone  = $_SESSION["celular"];
// $ciudad = $_SESSION["ciudad"];
// $subregion = $_SESSION["subregion"];



unset($_SESSION['datosarreglos']);
unset($_SESSION['sseguro']);
unset($_SESSION['sentrada']);
unset($_SESSION['sentrada']);
unset($_SESSION["snombre"]);
unset($_SESSION["scedula"]);
unset($_SESSION["scelular"]);
unset($_SESSION["sciudad"]);
unset($_SESSION["sreferencias"]);
unset($_SESSION["snombrecli"]);
unset($_SESSION["smail"]);
unset($_SESSION["sdireccion"]);
unset($_SESSION["sreferencia"]);
unset($_SESSION["pagoforma"]);



// $_SESSION["nombre"] = $nombre;
// $_SESSION["cedula"] = $cedula;
// $_SESSION["celular"] = $phone;
// $_SESSION["ciudad"] = $ciudad;
// $_SESSION["subregion"] = $subregion;


//echo  $_SESSION["nombre"]." ".$_SESSION["cedula"]." ".$_SESSION["celular"];



echo "<br><br><h1>Eliminando items de la lista...</h1>";
 header("Refresh: 1 ; URL=coti-inicio.php");


?>

</body>
</html>
