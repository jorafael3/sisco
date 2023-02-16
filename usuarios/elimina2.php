<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!DOCTYPE html>
<html>

<p>
<body>
<?php

session_start();
$sec = $_POST['sec']; 

include("../conexion.php");

$sql="UPDATE `covidusuarios` SET `activo`=0 where secuencia = '$sec' ";
$result = mysqli_query($con,$sql);
mysqli_close($con);

 echo "<br><br><H2>Eliminando usuario</h2>".
header("Refresh:3; url=usuarios1.php");

?>


</p>
</body>
</html>