<html>
<body>

<?php
include("../conexion.php");
$sec=$_GET['sec']; 
// $usuario=$_POST['usuario']; 
// $correo=$_POST['correo']; 
// $clave=$_POST['clave']; 
// $nivel=$_POST['nivel']; 


$sql = "update  covidnotificaciones set anulado= 1 where secuencia = '$sec' ";


/// $result = mysqli_query($sql, $link); /// Para MSSQL
 $result = mysqli_query($con, $sql); /// Para MySQL
 

mysqli_close($con);

Header("Location: notificaciones.php");

?>

</body>
</p>
</html>