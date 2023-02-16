<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!DOCTYPE html>
<html>

<p>
<body>
<?php

session_start();
$sec = $_GET['sec']; 

include("../conexion.php");

$sql="SELECT * FROM covidusuarios where secuencia = '$sec' ";

$result = mysqli_query($con,$sql);

$count=mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)) {
$usuario= $row['usuario'];
$nivel= $row['nivel'];
$canal= $row['canal'];

}

 
?>
   <Form Action="elimina2.php" Method="POST">
   <table border=1 cellpadding=5 cellspacing=1 width=500>
   <td align=left  width=1000><h2>Eliminar usuario:</h2>
   <left><b>Usuario: <Input Type=Text  Size = 5 Maxlenght=5  Name="usuario" id="usuario" value=<?php echo $usuario; ?> readonly >     </left><br>
   <Input Type=Hidden Name="sec" id="sec" value=<?php echo $sec; ?>>
   <center><Input Type=Submit Value="Eliminar"></center>
   </Form>

   <Form Action="usuarios1.php">
   <center><Input Type=Submit Value="Regresar al listado de usuarios"></center>
   </Form>


</p>
</body>
</html>