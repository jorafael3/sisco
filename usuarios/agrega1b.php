<?php

session_start();

require("../conexion.php");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=MD5($_POST['mypassword']); 
$u1=$_POST['u1']; 
$p1=$_POST['p1']; 
$n1=$_POST['n1']; 
$c1=$_POST['c1']; 
$provincia=$_POST['provincia'];
$bodega=$_POST['bodega'];
$nombres=$_POST['nombres'];
$mail=$_POST['email'];
$celular=$_POST['celular'];

//$mypassword=md5($mypassword); 


//echo $mypassword; Solo para mostrar el password con MD5

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);
$sql="SELECT * FROM covidusuarios WHERE usuario='$myusername' and clave='$mypassword' and activo='1' ";

$result=mysqli_query($con, $sql);


while($row = mysqli_fetch_array($result)) {
$nivelx= $row['nivel'];
$usuario= $myusername;
}
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

  if ( $count==1 and ($nivelx=="40" or $nivelx=="28") )
        {
        // Login good
         Header("Location: agrega2.php?pass=".$p1."&usr=".$u1."&nivel=".$n1."&c=".$c1."&nombres=".$nombres."&celular=".$celular."&mail=".$mail."&bodega=".$bodega."&provincia=".$provincia);
        }
  else
        {
        // Login not successful
        Header("Location: agrega1.php?sec=".$sec);
        die("Información incorrecta...");
        }
  
die();

?>
