<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>

<script type="text/javascript">
function setfocus()
{
document.getElementById("myusername").focus();
}
</script>


<BODY onload="setfocus()">

<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
//include("barramenu.php");

include("conexion.php");
include("conexion_mssql.php");

date_default_timezone_set('America/Guayaquil');


if (!mssql_select_db('COMPUTRONSA', $link)) 
{ 
die('Unable to select database!');
} 
$sec=$_GET['sec']; 
$fid=$_GET['fid']; 
$sid=$_GET['sid']; 
$aid=$_GET['aid']; 
$cod=$_GET['cod']; 
$can=$_GET['can']; 
$pname=str_replace("_"," ",$_GET['pname']); 

// $sql = "SELECT * FROM SERIES where  FACTURA = '$fid' and SECUENCIA = '$sid'and ARTICULO = '$aid'  ";
// //echo "<br><br><br><br>".$sql;
// $result = mssql_query(utf8_decode($sql));
// // echo "--".mssql_num_rows($result);
// $d=0;
// while ($row = mssql_fetch_array($result)) {
// $serie[$d]=$row['SERIE'];
// $d++;
// }

echo "<center>";
echo "<br><br><br><br><br>";
echo "<table border=1 cellpadding=5 cellspacing=0 width=300>";


echo "<td colspan =2 ><br><Center><h3>Ingreso de series </h3></Center></td><tr>";
echo "<td colspan =2 ><Center>$pname</Center></td><tr>";

echo "<Form Action=\"tomaserie3.php\" Method=\"post\">";

    for ($x = 1; $x <= $can; $x++) {
   //$fil = $x+1;
	echo "<td><left><strong><center>".$x."</center></strong></td>";
	echo "<td><Center><Input Size = 30 Maxlenght=100 name='serie[]' value='".$serie[$x]."' type=text required ></Center></td></tr>";
	}
	echo "<Input Type=hidden Name='sec' value='$sec'>";
	echo "<Input Type=hidden Name='fid' value='$fid'>";
	echo "<Input Type=hidden Name='sid' value='$sid'>";
	echo "<Input Type=hidden Name='aid' value='$aid'>";
	echo "<Input Type=hidden Name='can' value='$can'>";
	echo "<Input Type=hidden Name='cod' value='$cod'>";

	echo "<td colspan =2><Center><Input Type=Submit Value=\"INGRESAR\"></Center></td></tr>";
		
echo "</Form>";


echo "</td><tr>";

?>




</BODY>
</HTML>