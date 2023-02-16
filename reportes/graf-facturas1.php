<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
<title>Sistema SISCO</title>
<!-- 
<link rel="stylesheet" type="text/css" href="../css/menupeq.css">
 -->
<script src="https://code.jquery.com/jquery-git.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

//-->
</SCRIPT>


<script type="text/javascript" src="calendarDateInput.js">
/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/
</script>




<?php
session_start();


unset($_POST['vendedor']) ;
unset($_POST['despacho1']);
unset($_POST['comollego']);
unset($_POST['formapago']);

//echo "<br><br><br><br>aaaaaaaa:".$_POST['despacho1'];
include("../barramenu.php");

include("../conexion.php");

?>

<HTML>

<HEAD>
<script language="javascript" src="calendar.js"></script>
<link rel="stylesheet" type="text/css" href="../css/menumin.css">
<link rel="stylesheet" type="text/css" href="../css/boton.css">


<TITLE>Reportes varios:</TITLE>
</HEAD>

<BODY>
<FORM METHOD="POST" ACTION="graf-facturas2.php" onsubmit="return consulta()">

<br>
<br>
<br>

<center>
<table border=0 cellpadding=5 cellspacing=1 width=400>
<th  width = 20%><img src="../images/logo.png" height="70" width="150"  ></th> <th  ><h3><center>Reportes facturas x cajero </center></h3></th>
</tr><td colspan = 2>
<center>Entre fechas: </center>
</td>
<script>DateInput('fecha1', true, 'YYYY/MM/DD')
DateInput('fecha2', true, 'YYYY/MM/DD')</script>
<!-- 
<script type = "text/javascript">
{document.getElementById("DateInput").disabled=false;}
</script>
 -->
<!--- // Hasta aqui fecha --->



</td>
<!-- </Form> -->
</tr>


<td colspan="1"   ><br><center>
<input type="submit" name="Buscar" value="Generar reporte" class="btn btn-sm btn-primary"></form><br><br>



</table>



</table>




</BODY>
</HTML