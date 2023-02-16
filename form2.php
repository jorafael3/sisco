


<?php
session_start();
$usuario = $_SESSION["usuario"] ;
$canal = $_SESSION["canal"] ;
if ($canal=="CallCenter")
	{
		$vcanal = 1;
	}
else
	{
		if ($canal=="OnLine")
			{
				$vcanal = 0;
			}
		else
			{
				$vcanal = 2;
			}
	}
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;

if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
//include("barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

//die("<br><br><br><br><br>xxx".$canal." - ".$vcanal);
$nombre=$_POST['nombre'];
$cedula=$_POST['cedula'];
$celular=$_POST['celular'];
$ciudad=$_POST['listciudad'];  
$direccion=$_POST['direccion'];
$referencia=$_POST['referencia'];
$compra=$_POST['compra'];
$pago=$_POST['pago'];
$ordenweb=$_POST['ordenweb'];
$mail=$_POST['mail'];
$vendedor=$_POST['vendedor'];
$total=$_POST['total'];
if ($total<=1){die("<br><br><br>Regrese y complete el valor total de la compra...");}
$comentarios=$_POST['comentarios'];
$despacho=$_POST['despacho'];
if (isset($_POST['numcuotas'])){$numcuotas = $_POST['numcuotas'];} else {$numcuotas =0;}
if (isset($_POST['valcuotas'])){$valcuotas = $_POST['valcuotas'];} else {$valcuotas =0;}
$ingresocli=$_POST['ingresocli'];
if (isset($_POST['bodega'])){$bodega = $_POST['bodega'];} else {$bodega ='';}
if (isset($_POST['provincia'])){$provincia = $_POST['provincia'];} else {$provincia ='';}
if (isset($_POST['tipotarjeta']) and $pago=='Tarjeta'){$tipotarjeta = $_POST['tipotarjeta'];} else {$tipotarjeta ='';}
if (isset($_POST['linktopay'])){$linktopay = $_POST['linktopay'];} else {$linktopay ='';}

if (isset($_POST['bodega1'])){$ordenbodegaf = $_POST['bodega1'];} else {$ordenbodegaf ='';}

//die("<br><br><br>Coment-".$comentarios."-Despa-".$despacho."-Prov-".$provincia."-bodega-".$bodega);

//die("<br><br><br><br>Tarj:".$tipotarjeta);

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

// antes de ingresar reviso que no exista la orden PRISCILLA -- QUITE LA FECHA PORQUE NO ME ESTA GUARDANDO LA BODEGA DE RETIRO
$sqlcheck = "select * from covidsales where `cedula`='$cedula' and `nombres`='$nombre'  and `venta`='$compra' and `referencias`='$referencia'
and `valortotal`='$total' and `mail`='$mail' and `direccion`='$direccion' and `ordenweb`='$ordenweb'   ";
$resultcheck = mysqli_query($con, $sqlcheck);
$countcheck=mysqli_num_rows($resultcheck);

 //if ($countcheck <>'0') {die("<br><br><br><h2>Error, orden duplicada!</h2>");}




/// Para MySQL
$sql = "insert into covidsales (`cedula`,`nombres`,`celular`, `ciudad`,`direccion`,`referencias`,`venta`,`formapago`,`l2p`,
 `ordenweb`,`fecha`,`estado`,`vendedor`,`mail`,`valortotal`,`numcuotas`,`valorcuotas`,`canal`,`comollego`,`pickup`,`comentarios` ,`valorfactura`,`tipotarjeta`,`ordenbodegaf`)
VALUES ('$cedula','$nombre','$celular','$ciudad','$direccion','$referencia','$compra','$pago', '$linktopay',
 '$ordenweb','$fh','$estado','$vendedor','$mail','$total','$numcuotas','$valcuotas','$vcanal','$ingresocli','$pickup','$comentarios','$total','$tipotarjeta','$ordenbodegaf')";
//die("<br><br>".$sql);
mysqli_query($con, $sql);

if ($pickup==1) // si pickup es 1 quiere decir qu el cliente lo recoje y especifico donde sera eso PRISCILLA -- QUITE LA FECHA PORQUE NO ME ESTA GUARDANDO LA BODEGA DE RETIRO
{
$sql2 = "select * from covidsales where `cedula`='$cedula' and `nombres`='$nombre'   and `venta`='$compra' and `referencias`='$referencia'
and `valortotal`='$total' and `mail`='$mail' and `direccion`='$direccion' and `ordenweb`='$ordenweb'   ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($result2);
$sec = $row2['secuencia'];
$sql3 = "insert into covidpickup (`orden`,`provincia`,`bodega`) VALUES ('$sec','$provincia','$bodega')";
}
mysqli_query($con, $sql3);
mysqli_close($con);


$texto = "Estimado(a) ".$nombre. ".%0aHemos registrado una orden nueva a su nombre. Por este medio recibira actualizaciones de su orden.%0a%0aGracias%0a%0aCOMPUTRON S.A. ";
$telefono = "593".substr($celular,-9);
//die($telefono."<br>".$texto);
echo "<br><br>Enviando SMS:". "<iframe src=\"https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=fernfmor2019&password=esm50742&from=Test&to=$telefono&text=$texto&type=0\" width=\"500\" height=\"40\"></iframe>";

echo "<h3>Espere...</h3>";

header("Refresh:5; url=index1.php");
die();


?>
