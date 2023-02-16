<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>COMPUTRON CUOTAS</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
</head>
<body>

<?php
include("conexion_mssql.php");

session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

$code=$_GET['code'];

session_start();
// $nombre = $_POST['nombre'];
if (isset($_SESSION['datosarreglos'])) // veo si existe el arreglo de los items
{
$arreglo = $_SESSION['datosarreglos']; // Cargo el arreglo de la memoria
}
else
{
$arreglo = array();
}




$xx = count($arreglo); //Cuento las filas del arreglo
$sql = "WEB_Select_Productos_Cartimex '$code','' ";
echo $sql."<br>".$xx."<br>";
// echo $sql;
$result = mssql_query(utf8_decode($sql));

die();

while ($row = mssql_fetch_array($result)) {
echo $row['Producto']."<br>";
echo $row['ProductoID']."<br>";
    $arreglo[$xx][1] = $row[utf8_decode('Codigo')];
    $arreglo[$xx][2] = $row['Producto'];
    $arreglo[$xx][3] = floatval($row['PrecioFinal']);
    $arreglo[$xx][4] = floatval($row['C12']);
    $arreglo[$xx][5] = floatval($row['C18']);
    $arreglo[$xx][6] = floatval($row['C24']);
    $arreglo[$xx][7] = floatval($row['C3']);
    $arreglo[$xx][8] = floatval($row['C6']);
    $arreglo[$xx][9] = floatval($row['C9']);
    $arreglo[$xx][10] = floatval($row['PrecioNormal']);
    $arreglo[$xx][99] = $row['ProductoId'];


$xx++ ;
}

$tnormal = 0;
$tprecio = 0;
$t12 = 0;
$t18 = 0;
$t24 = 0;
$t3 = 0;
$t6 = 0;
$t9 = 0;

for ($re = 0; $re <= $xx; $re++) {
$tprecio = $tprecio + $arreglo[$re][3] ;
$t12 = $t12 + $arreglo[$re][4];
$t18 = $t18 + $arreglo[$re][5];
$t24 = $t24 + $arreglo[$re][6];
$t3  = $t3  + $arreglo[$re][7];
$t6  = $t6  + $arreglo[$re][8];
$t9  = $t9  + $arreglo[$re][9];
$tfinal  = $tfinal  + $arreglo[$re][10];
}




$_SESSION['datosarreglos'] = $arreglo;
$_SESSION['sseguro'] = $seguro;


echo "abc";
header("Location: coti-inicio.php");

// header("Location: coti-inicio.php");


?>

</body>
</html>
