<html>
<body>

<?php
include("conexion.php");

$usuario=$_POST['myusername']; 
$clave1=MD5($_POST['mypasswordold']); 
if (strlen($_POST['mypasswordnew'])<6) {die( "<br><br><h3>Error: La contraseña debe tener al menos 6 caracteres</h3>");}
if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['mypasswordnew'])) {die("<br><br><h3>Error: La contraseña debe números y letras</h3>");}
$clave2=MD5($_POST['mypasswordnew']); 

$sqlconsulta = "select * from covidusuarios where usuario='$usuario' and clave='$clave1' ";
//echo $sqlconsulta."<br>";



$result1 = mysqli_query($con, $sqlconsulta);
echo mysqli_num_rows($result1). "<br>" ;
if (mysqli_num_rows($result1)==0){
echo "Error: Usuario o contraseña actual no válidas...";
}
else{
//----- Aqui grabo en la base los datos del usuario nuevo ---//
$sqlCrea = "update covidusuarios set clave = '$clave2' where usuario='$usuario' ";
//echo $sqlCrea . "<br>" ;
$resu = mysqli_query($con, $sqlCrea); /// Para MySQL 
//echo mysqli_num_rows($resu);
mysqli_close($con);

Header("Location: index.php");

}





?>

</body>
</p>
</html>