


<?php
session_start();
$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
//echo "<br><br><br>";
$sec= $_POST['sec'] ;
$nombre=$_POST['nombre']; 
$cedula=$_POST['cedula']; 
$celular=$_POST['celular']; 
$ciudad=$_POST['ciudad'];  
$direccion=$_POST['direccion']; 
$referencia=$_POST['referencia']; 
$compra=$_POST['compra']; 
$pago=$_POST['pago']; 
$ordenweb=$_POST['ordenweb'];
$mail=$_POST['mail'];
$vendedor=$_POST['vendedor'];
$total=$_POST['total'];
 
if ($total<=1){die("<br><br><br>Regrese y complete el valor total de la compra...");}
$comentarios=$_POST['comentario'];
$despacho=$_POST['despacho'];
if (isset($_POST['numcuotas'])){$numcuotas = $_POST['numcuotas'];} else {$numcuotas =0;}
if (isset($_POST['valcuotas'])){$valcuotas = $_POST['valcuotas'];} else {$valcuotas =0;}
$ingresocli=$_POST['ingresocli'];
if (isset($_POST['bodega'])){$bodega = $_POST['bodega'];} else {$bodega ='';}
if (isset($_POST['provincia'])){$provincia = $_POST['provincia'];} else {$provincia ='';}
if (isset($_POST['tipotarjeta']) and $pago=='Tarjeta'){$tipotarjeta = $_POST['tipotarjeta'];} else {$tipotarjeta ='';}
if (isset($_POST['linktopay'])){$linktopay = $_POST['linktopay'];} else {$linktopay ='';}

if ($despacho == 'Pickup'){$pickup=1;} else {$pickup=0;}

include("conexion.php");

$estado = 'Verif. pago';

switch ($pago) {
    case "Tarjeta":
        $estado = "Tarjeta";
        break;
	case "Tienda":
        $estado = "Tienda";
        break;	
    case "Paymentez":
        $estado = "Paymentez";
        break;
    case "Directo":
        $estado = "Enviar Docs.";
        break;
    case "Transferencia":
        $estado = "Transferencia";
        break;
    case "LinkToPay":
        $estado = "LinkToPay";
        break;    
    default:
        $estado = "Verif. pago";
}

$sql = "
UPDATE `covidsales` SET `cedula`='$cedula', `nombres`='$nombre' , `celular`='$celular', `ciudad`='$ciudad' , `mail`='$mail',`direccion`='$direccion' ,
`referencias`='$referencia', `venta`='$compra' , `fecha`='$fh',`formapago`='$pago', `ordenweb`='$ordenweb' , `estado`='$estado'  , `valortotal`='$total' ,
`numcuotas`= '$numcuotas',`valorcuotas`='$valcuotas' ,`valorfactura`='$total', `tipotarjeta` ='$tipotarjeta' , `l2p` ='$linktopay',
`comollego`= '$ingresocli', `pickup`='$pickup',`comentarios`= '$comentarios'
where secuencia = '$sec' " ;

 //echo "<br>sql:".$sql."<br><br><br>";
 

mysqli_query($con, $sql); 
if ($pickup==1) // si pickup es 1 quiere decir qu el cliente lo recoje y especifico donde sera eso PRISCILLA -- QUITE LA FECHA PORQUE NO ME ESTA GUARDANDO LA BODEGA DE RETIRO 
{
$sql3 = "update covidpickup SET `provincia`=$provincia ,`bodega`='$bodega' where orden = '$sec' " ;
}
//echo "<br>sql:".$sql3."<br><br><br>";

mysqli_query($con, $sql3); 

mysqli_close($con);



header("Location: blanco.php");
die();



