<?php

session_start();

require("conexion.php");

// username and password sent from form 
$myusername = $_POST['myusername'];
$mypassword = MD5($_POST['mypassword']);
//$mypassword=md5($mypassword); 

//echo "Usr: ". $myusername."<br>";
//echo "pass: ". $mypassword."<br>";


//echo $mypassword; Solo para mostrar el password con MD5

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);
$sql = "SELECT * FROM covidusuarios WHERE usuario='$myusername' and clave='$mypassword' and activo='1' ";
//echo "Sql:".$sql."<br>";
$result = mysqli_query($con, $sql);


while ($row = mysqli_fetch_array($result)) {
      echo "<pre>";
      print_r($row);
      echo "</pre>";

      $nivel = $row['nivel'];
      $usuario = $row['usuario'];
	//*** AGREGAR PROVEEDOR */

      $ca = (int)$row["canal"];
      // // $canal = "asdasd";
      if ($ca == 1) {
            $ca = "CallCenter";
      } else if ($ca == 2) {
            $ca = "WEB";
      } else if ($ca == 0) {
            $ca = "OnLine";
      } else if ($ca == 3) {
            $ca = 'Proveedor1';
      } else if ($ca == 4) {
            $ca = 'Proveedor2';
      } else if ($ca == 5) {
            $ca = 'Proveedor3';
      }else if ($ca == 6) {
		$ca = 'Rappi';
	}

      $_SESSION["nivel"] = $nivel;
      $_SESSION["usuario"] = $usuario;
      $_SESSION["canal"] = $ca;
      echo  $_SESSION["canal"];
      $_SESSION["canal_id"] = $row['canal'];
}

// Mysql_num_row is counting table row
$count = mysqli_num_rows($result);


if ($count == 1) {
      // Login good, create session variables
      $_SESSION["susername"] = $myusername;

      // Redirect to member page

      if ($nivel == "40") {
            Header("Location: usuarios/usuarios1.php");
      } else {
            Header("Location: index1.php");
      }
} else {
      // Login not successful
      Header("Location: index.php");
      die("Información incorrecta...");
}

die();
