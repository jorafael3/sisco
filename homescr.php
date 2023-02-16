<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<?php


session_start();

// if ($_SESSION["sacceso"]<>"0") and ($_SESSION["sacceso"]<>"1") and ($_SESSION["sacceso"]<>"2") and ($_SESSION["sacceso"]<>"3") and ($_SESSION["sacceso"]<>"4")
//         {
//         // User not logged in, redirect to login page
//         echo "<br><br><br><br><br>";
//            die("Usuario no autorizado!");
//       //  Header("Location: index.php");
//         }


?>

<HTML>

<HEAD>
<TITLE>Control de clientes</TITLE>
</HEAD>


<BODY>
<?php 

include("barramenu.php");

echo "<br><br><br>Usuario:".$_SESSION["snombre"];
$caso="1";
$color1="dddddd";
?>
<br>


<!-- 
<center>
<table border=0 cellpadding=5 cellspacing=1 width=400>
<br>


<td colspan="2"><br><center>
<FORM METHOD="POST" ACTION="listadodobra2.php">
Buscar: <input title="Please Enter Your First Name" id="nombre" name="nombre" type="text" />
<input type="submit" name="Submit" value="Buscar clientes"></td><tr>
</Form>





<td colspan="2"><br><center>
<FORM METHOD="GET" ACTION="logout.php">
<input type="submit" name="Submit" value="Salir del sistema"></td><tr>
</Form>

</table>

 -->


</BODY>
</HTML>