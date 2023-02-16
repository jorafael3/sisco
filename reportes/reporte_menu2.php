<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!DOCTYPE html>
<head>

<script type="text/javascript" src="excellentexport.min.js"></script>

</head>


<html>
<body>


<?php

session_start();

include("../conexion.php");
// $color1="#5ffea0";

$myfecha1=$_POST['fecha1'];
$myfecha2=$_POST['fecha2'];


echo "<FORM METHOD='POST' ACTION='reporte_menu1.php'>";
echo "<input type='submit' name='Buscar' value='Menu Reportes'></td><tr></Form>";

// RO es la variable si viene del programa de users
if ($_SESSION["sacceso"]<>"1" and $_SESSION["sacceso"]<>"2" and  $_SESSION["sacceso"]<>"3" )
        {
        // User not logged in, redirect to login page
        Header("Location: index.php");
        }
if (isset($_POST['selec_marca']) ){
// Recibo:
// Selec_marca = Ver que menu corro
// marcaSeleccionada = numero de solar
// texto = placa ingresada




if (!empty($_POST['marcaSeleccionada'])) {
$mymarcaSeleccionada=$_POST['marcaSeleccionada'];}


if (!empty($_POST['texto'])) {
$mytexto=strtoupper($_POST['texto']);}

if (!empty($_POST['NOMBRE'])) {
$mynombre=strtoupper($_POST['NOMBRE']);}


$myseleccion1=$_POST['selec_marca'];


$where = 0;

echo "Seleccion ".$myseleccion1."<br>";
if (isset($mymarcaSeleccionada)){Echo "Solar:" .$mymarcaSeleccionada."<br>"; $where = 1;}
if (isset($mytexto)){Echo "Con Texto:" .$mytexto."<br>"; $where = 1;}
if (isset($myfecha1)){Echo "Rango fechas: &nbsp" .$myfecha1."&nbsp&nbsp al &nbsp&nbsp" . $myfecha2."<br>"; $where = 1;}

if ($myseleccion1 == 1)
{
echo "<FORM METHOD='POST' ACTION='rep_villa.php' id='formid1'>";
echo "<input type = 'hidden' name='villa' type='text' id='villa' value ='$mymarcaSeleccionada' >";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid1").submit(); 
</script>
<?php
}

if ($myseleccion1 == 2)
{
echo "<FORM METHOD='POST' ACTION='rep_placa.php' id='formid2'>";
echo "<input type = 'hidden' name='placa' type='text' id='placa' value ='$mytexto' >";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid2").submit(); 
</script>
<?php
}

if ($myseleccion1 == 3)
{
echo "<FORM METHOD='POST' ACTION='rep_vecesplaca.php' id='formid3'>";
echo "<input type = 'hidden' name='placa' type='text' id='placa' value ='$mytexto' >";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid3").submit(); 
</script>
<?php
}

if ($myseleccion1 == 4)
{
echo "<FORM METHOD='POST' ACTION='rep_vecesresidencia.php' id='formid4'>";
// echo "<input type = 'hidden' name='solar' type='text' id='solar' value ='$mytexto' >";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid4").submit(); 
</script>
<?php
}

if ($myseleccion1 == 5)
{
echo "<FORM METHOD='POST' ACTION='rep_nombre.php' id='formid5'>";
echo "<input type = 'hidden' name='nombre' type='text' id='nombre' value ='$mynombre' >";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid5").submit(); 
</script>
<?php
}

if ($myseleccion1 == 6)
{
echo "<FORM METHOD='POST' ACTION='rep_ni.php' id='formid6'>";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid6").submit(); 
</script>
<?php
}


die("---fin---");
}
else
{
echo "<FORM METHOD='POST' ACTION='rep_total.php' id='formid6'>";
echo "<input type = 'hidden' name='fecha1' type='text' id='fecha1' value ='$myfecha1' >";
echo "<input type = 'hidden' name='fecha2' type='text' id='fecha2' value ='$myfecha2' >";
echo "<input type='submit' name='Buscar' value='Buscar'></td><tr>";
echo "</Form>";
?>
<script type="text/javascript">
document.getElementById("formid6").submit(); 
</script>
<?php

//die("Seleccione un tipo de reporte... Retroceda y seleccione");
}

mysqli_close($con);
?>
<br><a download="ReporteMarcasExcel.xls" href="#" onclick="return ExcellentExport.excel(this, 'datatable', 'Nombre del Excel Sheet');">Exportar a Excel

</body>
</html>