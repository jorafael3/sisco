<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>

</head>


<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
//include("script_mensaje.php");
//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}


?>
<h1><?php echo $_SESSION["canal_id"] ?></h1>
 
<!-- 
<p><form name="form"></form><div id="info"> </div></p>
 -->


