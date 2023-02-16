<!-- 
// este programa es llamado por cot-inicio y lo unico que hace es descriminar que boton fue oprimido
// los 3 botones pasan por aqui, donde son redirigidos a la pagina correspondiende en cada caso
 -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<head>
<TITLE>COMPUTRON CUOTAS</TITLE><link rel="stylesheet" type="text/css" href="css/tablas.css">
<link rel="stylesheet" type="text/css" href="css/boton.css">
</head>
<body>


<?php

session_start();
/// grabo las variables en memoria para que  no se pierdan
$_SESSION['sdireccion'] = $_POST['direccion'];
// $_SESSION['sdireccion'] = $_POST['direccion'];
$_SESSION['snombre'] = $_POST["nombre"];
$_SESSION['scedula'] = $_POST["cedula"];
$_SESSION['scelular'] = $_POST["celular"];
$_SESSION['sciudad'] = $_POST["ciudad"];
$_SESSION['snombrecli'] = $_POST["nombrecli"];
$_SESSION['sreferencia'] = $_POST["referencia"];
$_SESSION['smail'] = $_POST["mail"];
$_SESSION['snombre'] = $_POST["nombre"];
$_SESSION['splazo'] = $_POST["plazo"];
$_SESSION['pagoforma'] = $_POST["pagoforma"];
$_SESSION['sbodega'] = $_POST["bodega"];
$_SESSION['sprovincia'] = $_POST["provincia"];
$_SESSION['singresocli'] = $_POST["ingresocli"];
$_SESSION['scomentarios'] = $_POST["comentarios"];
$_SESSION['sdespacho'] = $_POST["despacho"];  // es Pickup o Envio
$_SESSION['cotiproducto'] = $_POST["cotiproducto"];
$_SESSION['coticliente'] = $_POST["coticliente"];
// die("<br><br><br>--->".$_SESSION['cotiproducto']);
$plazo = $_POST["plazo"];
$z = sizeof($_SESSION['mail']);
//die("Pl:".$_SESSION['splazo']);
if (  ( $_POST["pagoforma"]=='cd'  ) or ( $_POST["pagoforma"]=='tc'  )  )
{$pagoforma = $_POST["pagoforma"];} else {$pagoforma ='no'; }

if ($plazo == '3') {$pos = 7;}
if ($plazo == '6') {$pos = 8;}
if ($plazo == '9') {$pos = 9;}
if ($plazo == '12') {$pos = 4;}
if ($plazo == '18') {$pos = 5;}
if ($plazo == '24') {$pos = 6;}
if ($plazo == '00') {$pos = 10;}


echo "<br><br><br>";
// en este IF entro si oprimi el boton de buscar producto
    if (isset($_POST['busca'])) {
        echo "busca";
        header("Location: coti-consinventario1.php");
    }
    
// en este IF entro si oprimi el boton de borrar datos 
    elseif (isset($_POST['elimina'])) {
        header("Location: coti-elimina.php");
    }
// en este IF entro si no oprimi no eliminar ni buscar, y lo asumo como grabar
    elseif (isset($_POST['grabadatos'])) {
        //verifico que los datos del cliente esten completos para continuar
        if ($_POST['direccion']==''  or   $_POST['cedula']=='' or  $_POST['celular']=='' or  $_POST['ciudad']==''
        or $_POST['nombrecli']==''  or  $_POST['referencia']=='' or  $_POST['mail']=='' or  $pagoforma =='no')
         {die("<h3>Retroceda y complete los datos del cliente!</h3>");}
         else
         {header("Location: coti-grabar.php");}

    }
    
die();
?>



</body>
</html>
