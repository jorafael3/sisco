<?php

session_start();

require("../conexion.php");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=MD5($_POST['mypassword']); 
$sec=$_POST['sec']; 
$comentarios=trim($_POST['comentarios']); 
//$mypassword=md5($mypassword); 

//echo "Usr: ". $myusername."<br>";
//echo "pass: ". $mypassword."<br>";


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


  if ( $count==1 and $nivelx=="40")
        {echo "if<br>sec=".$sec."&usr=".$usuario."&com=".$comentarios;
        //Header("Location: tumandre.php");
         Header("Location: anula2.php?sec=".$sec."&usr=".$usuario."&com=".$comentarios);
        }
  else
        {echo "else";
        //Header("Location: anula1a.php?sec=".$sec);
        die("<br><br><br><br>Información incorrecta...");
        }
  
die();

?>
