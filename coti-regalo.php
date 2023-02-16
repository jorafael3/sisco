<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>COMPUTRON CUOTAS</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
</head>
<body>

<?php
include("conexion.php");

session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

$code=$_GET['sec'];
echo "sec:`".$code;


session_start();
// $nombre = $_POST['nombre'];
$arreglo = $_SESSION['datosarreglos']; // Cargo el arreglo de la memoria
//unset($arreglo[$code]);
	$arreglo[$code][3] = 0;
    $arreglo[$code][4] = 0;
    $arreglo[$code][5] = 0;
    $arreglo[$code][6] = 0;
    $arreglo[$code][7] = 0;
    $arreglo[$code][8] = 0;
    $arreglo[$code][9] = 0;
    $arreglo[$code][10] = 0;

$arreglo = array_values($arreglo);

echo "<pre>";
echo print_r($arreglo);
echo "</pre>";

$_SESSION['datosarreglos'] = $arreglo;
$_SESSION['regalo'] = 1;

// echo "<Form Action='consultarinventario.php' Method='post'>";
// echo "<td colspan=11><br><center><input type=\"submit\" name=\"Submit\" value=\"Agregar artículo\" class=\"btn btn-sm btn-primary\"></form><center></td></tr>";
// echo "<Form Action='elimina.php' Method='post'>";
// echo "<td colspan=11><br><center><input type=\"submit\" name=\"Submit\" value=\"Borrar todo\" class=\"btn btn-sm btn-primary\"></form><center></td>";
// echo "</table>";


header("Location: coti-inicio.php");


?>

</body>
</html>
