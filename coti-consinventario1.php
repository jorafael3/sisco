<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>Consultas CARTIMEX - Inventario</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="boton.css">
</head>
<body>
<?php
include("conexion_mssql.php");

session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
// if (!isset($_SESSION["susername"])) {header('Location: http://app.compu-tron.net/inventario');}
//$access = $_SESSION["sacceso"] ;

$nombre = $_SESSION['snombre'];

// To protect MySQL injection (more detail about MySQL injection)
$nombre = stripslashes($nombre);
//$nombre = mysql_real_escape_string($nombre);


// if ( $access == 5 || $access == 4) {echo  ""; } else { die("<br>Acceso no autorizado!");}



echo "<H2>Listado de productos que contienen : ".$nombre."<br></H2>";


$sql = "WEB_Select_Productos_Cartimex_Like '".strtoupper($nombre)."', ' ' ";
$result = mssql_query(utf8_decode($sql));
echo $sql;

echo 'Registros encontrados: ' . mssql_num_rows($result) . '<br>';
$count=mssql_num_rows($result);


echo "<table border=1 cellpadding=5 cellspacing=0 width=95% height=1>

<tr>
<th align=center  height=0>Codigo </th>
<th align=center  height=0>Producto </th>
<th align=center  height=0>Precio</th>
<th align=center  height=0>C 18</th>
<th align=center  height=0>C 24</th>
<th align=center  height=0>Stock </th>
<th align=center  height=0>Stock Otros</th>

</tr>
 ";

// <th align=center  height=0>Costo 12</th>
// <th align=center  height=0>Costo 18</th>
// <th align=center  height=0>Costo 24</th>





while ($row = mssql_fetch_array($result)) {
//

$ccoodd = $row[utf8_decode('Codigo')];

echo "<td align='right'>" ."<a href=\"coti-cotiza.php?code=$ccoodd\"  >" .$ccoodd .  "</td>";

echo "<td align='left'>"  .$row[utf8_decode('Producto')]."</td>";
echo "<td align='right'>"  .number_format($row['Precio'],2,',','.')."</td>";
echo "<td align='right'>"  .number_format($row['C18'],2,',','.')."</td>";
echo "<td align='right'>"  .number_format($row['C24'],2,',','.')."</td>";
echo "<td align='right'>"  .number_format($row['Stock'],2,',','.')."</td>";
if ($row['Stock'] <1 )
{
  echo "<td align='right'>No disponible</td>";
}
if ($row['Stock'] >=1 and $row['Stock']<=5)
{
  echo "<td align='right'>Entre 1  y 5</td>";
}
if ($row['Stock'] >5 )
{
  echo "<td align='right'>Mas de 5 unid.</td>";
}

// echo "<td align='right'>"  .number_format($row['C12'],2,',','.')."</td>";
echo " </tr>";
}


echo " </tr>";
// echo "</table>";


// 		echo "<table border=0 cellpadding=0 cellspacing=0 width=50% height=0>";
//         echo "<tr colspan=10>";
		echo "<Form Action='coti-inicio.php' Method='post'>";
        echo "<td colspan=11><br><center><input type=\"submit\" name=\"Submit\" value=\"Regresar Pantalla Anterior\" class=\"btn btn-sm btn-primary\"></form><center></td>";
	    echo "</table>";


?>

</body>
</html>
