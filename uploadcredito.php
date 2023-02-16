<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>

<?php
session_start();
include("conexion.php");
$sec= $_POST['sec'] ;
$despacho= $_POST['despacho'] ;



include("barramenu.php");
echo "<br><br><br>";

// primero debo revisar si ya existe el registro en covidcredito. Si existe hago update, si no hago insert
$sql = "select * from  `covidcredito` where transaccion = $sec" ;
//echo $sql;
$result = mysqli_query($con, $sql); 
$count=mysqli_num_rows($result);
//echo "Count: ".$count."<br>";

// if count=0 debo cfear el registro en covid
if ($count == 0) { 
$sqlins = "INSERT INTO `covidcredito`( `transaccion`) VALUES ($sec)";
$result = mysqli_query($con, $sqlins); 
} 

date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;


// Script written by Adam Khoury for the following video exercise:
// http://www.youtube.com/watch?v=7fTsf80RJ5w
if(isset($_FILES['file_array'])){
    $name_array = $_FILES['file_array']['name'];
    $tmp_name_array = $_FILES['file_array']['tmp_name'];
    $type_array = $_FILES['file_array']['type'];
    $size_array = $_FILES['file_array']['size'];
    $error_array = $_FILES['file_array']['error'];

    $fileNameCmps = explode(".", $name_array);
    $fileExtension = strtolower(end($fileNameCmps));

    $name_array[0] = $sec .'-soli'. '.' . strtolower(end(explode(".", $name_array[0])));
    $name_array[1] = $sec .'-amor'. '.' . strtolower(end(explode(".", $name_array[1])));
    $name_array[2] = $sec .'-paga'. '.' . strtolower(end(explode(".", $name_array[2])));
    $name_array[3] = $sec .'-cont'. '.' . strtolower(end(explode(".", $name_array[3])));
    $name_array[4] = $sec .'-impo'. '.' . strtolower(end(explode(".", $name_array[4])));

   // for($i = 0; $i < count($tmp_name_array); $i++){
    for($i = 0; $i <= 4; $i++){
    $j=$i+1;
   //echo $i." Archivos subidos".count($tmp_name_array)."<br>"; 
        if(move_uploaded_file($tmp_name_array[$i], "../siscocredito/".$name_array[$i])){
            echo $name_array[$i]." Procesado correctamente<br>";
            $sqlup = "UPDATE `covidcredito` SET `doc".$j."` = '$name_array[$i]' where transaccion = $sec";
            mysqli_query($con, $sqlup); 
            echo $sqlup."<br>";
        } else {
            //echo "Ha ocurrido un error en archivo ".$name_array[$i]."<br>";
        }
    }
// // ahora verifico si todos los documentos estan y lo marco como completo = SI	 
$sqlb = "select * from  `covidcredito` where transaccion = '$sec' " ;
echo $sqlb;
$resultb = mysqli_query($con, $sqlb); 
$count=mysqli_num_rows($resultb);
echo "Coincidencias:".$count;
while($rowb = mysqli_fetch_array($resultb)) {
  if ($rowb['doc1'] and $rowb['doc2'] and $rowb['doc3'] and $rowb['doc4'] and $rowb['doc5'])
  {
 $sqlup2 = "UPDATE `covidcredito` SET `completo` = 'SI' , `fechacompleto` = '$fh' where transaccion = $sec";
 echo "<br>".$sqlup2;
 mysqli_query($con, $sqlup2); 
// mysqli_close($con);
  }	 
}

	 
   mysqli_close($con);

}
// fin del Script del Parser



die();
header("Location: fer.php");