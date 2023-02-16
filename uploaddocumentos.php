<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
</head>

<?php
session_start();
include("conexion.php");
$sec= $_POST['sec'] ;
//die("<br><br>aaaaa".$sec);


include("barramenu.php");
echo "<br><br><br>";

// primero debo revisar si ya existe el registro en covidcredito. Si existe hago update, si no hago insert
$sql = "select * from  `coviddocumentos` where transaccion = '$sec'" ;
//echo $sql;
$result = mysqli_query($con, $sql); 
$count=mysqli_num_rows($result);
//echo "Count: ".$count."<br>";

// if count=0 debo cfear el registro en covid
if ($count == 0) { 
$sqlins = "INSERT INTO `coviddocumentos`( `transaccion`) VALUES ($sec)";
$result = mysqli_query($con, $sqlins); 
} 

//die("<br><br>aaaaa");

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

    $name_array[0] = $sec .'-cedula'. '.' . strtolower(end(explode(".", $name_array[0])));
    $name_array[1] = $sec .'-tarjeta'. '.' . strtolower(end(explode(".", $name_array[1])));
    $name_array[2] = $sec .'-voucher'. '.' . strtolower(end(explode(".", $name_array[2])));

   // for($i = 0; $i < count($tmp_name_array); $i++){
    for($i = 0; $i <= 2; $i++){
    $j=$i+1;
   echo $i." Archivos subidos".count($tmp_name_array)."<br>"; 
        if(move_uploaded_file($tmp_name_array[$i], "../siscodocumentos/".$name_array[$i])){
            echo $name_array[$i]." Procesado correctamente<br>";
            $sqlup = "UPDATE `coviddocumentos` SET `doc".$j."` = '$name_array[$i]' where transaccion = $sec";
            mysqli_query($con, $sqlup); 
            //echo $sqlup."<br>";
        } else {
            //echo "Ha ocurrido un error en archivo ".$name_array[$i]."<br>";
        }
     } //del for
  }	 // if isset files

	 
   mysqli_close($con);

// fin del Script del Parser



die();
header("Location: fer.php");