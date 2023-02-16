<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?php
include("barramenu.php");


session_start();
include("conexion.php");
$code=$_GET['sec']; 
$i=$_GET['a']; 


$sql = "select * from covidtransferencias where transaccion ='$code' ";

$result = mysqli_query($con, $sql); 
$row = mysqli_fetch_array($result);
//echo "<br><br><br>row:".$sql;
// 
if ($i=='1') {$img = $row['doc1'];}
// if ($i=='2') {$img = $row['doc2'];}
// if ($i=='3') {$img = $row['doc3'];}

//die("<br><br><br>".$img."<br>".$i);
echo "<br><br><br>Imagen:".$img;
if (file_exists("../siscodocumentos/".$img))
  {
  //echo "<center><tr><td width='38' align='left' valign='left'><img src=\"http://img.cartimex.com/v2/upload/".$foto2."\" width='520' height='360' alt='' name='FOTO'/></td>";

  echo "<center><tr><td><img src=\"http://app.compu-tron.net/siscodocumentos/".$img."\" /></td>";
  }
  else
  {die("<br><br><br><br>La imagen seleccionada no existe!");}


//echo "<iframe src=\"http://app.compu-tron.net/siscopdf/".$code.\" width=\"100%\" style=\"height:100%\"></iframe>";

 

echo "  </td>";

echo "</table>";


?>
<form><br>
<input type="button" value="IMPRIMIR" onClick="window.print()">
</form>