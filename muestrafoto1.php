<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>
<?php
include("barramenu.php");


session_start();

$code=$_GET['sec'];

echo "<br><br><br><center><table border=1 cellpadding=0 cellspacing=0  height=0>";
echo "  <th colspan = 2>";

echo "<strong><center>Imagen: </strong> ".$code;
echo "  </center></th>";

if (isset($_GET['a'])) 
{	$geteo=$_GET['a'];
   if ($geteo=='1') {$nom = $code."-soli.pdf";}
   if ($geteo=='2') { $nom = $code."-amor.pdf";}
   if ($geteo=='3') {$nom = $code."-paga.pdf";}
   if ($geteo=='4') {$nom = $code."-cont.pdf";}
   if ($geteo=='5') {$nom = $code."-impo.pdf";}
//echo "<center><tr><td><img src=\"http://app.compu-tron.net/siscocredito/".$nom."\" /></td>";
echo "<embed src=\"http://app.compu-tron.net/siscocredito/".$nom."#toolbar=0&navpanes=0&scrollbar=0\" type=\"application/pdf\" width=\"100%\" height=\"800px\" /></td>";

}
else
{

if (file_exists("../siscopdf/".$code))
  {
  //echo "<center><tr><td><img src=\"http://app.compu-tron.net/siscopdf/".$code."\" /></td>";
  echo "<embed src=\"http://app.compu-tron.net/siscopdf/".$code."#toolbar=0&navpanes=0&scrollbar=0\" type=\"application/pdf\" width=\"100%\" height=\"800px\" /></td>";

  }
  else
  {die("<br><br><br><br>La guía seleccionada no existe!");}
}


//echo "<iframe src=\"http://app.compu-tron.net/siscopdf/".$code.\" width=\"100%\" style=\"height:100%\"></iframe>";

 

echo "  </td>";

echo "</table>";
echo "Para imprimir, haga click alterno en la imagen y selecciones IMPRIMIR";

?>
