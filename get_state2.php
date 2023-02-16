<?php
session_start();
$xxx = $_SESSION["ciudadidoriginal"];
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["country_id"])) {
	$query ="SELECT * FROM ciudades WHERE idgrupo = '" . $_POST["country_id"] . "'";
	$results = $db_handle->runQuery($query);
	echo "<option value=''>Seleccione una Ciudad</option>";

	foreach($results as $state) {

   if ($xxx == $state[idciudad])
   {
	echo "<option value= '$state[idciudad]' selected>".utf8_encode($state[ciudad])."</option>";
   }
   else
   {
	echo "<option value= '$state[idciudad]' >".utf8_encode($state[ciudad])."</option>";    
   }



	}
	
}
?>