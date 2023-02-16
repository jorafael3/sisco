


<?php
include("barramenu.php");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index1.php");
}

$usuario = $_SESSION["usuario"];
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;

$radio = $_POST['radio'];
$bultos = $_POST['bultos'];
$lockerid = $_POST['lockerid'];
$localid = $_POST['localid'];
$local = $_POST['local'];
$despacho = $_POST['despacho'];
$numfac = $_POST['numfac'];
$sec = $_POST['sec'];
$medio = $_POST['medio'];

// despacho = informacion del cuadro de guia
// medio = metodo de despacho, urbano, en tienda, casillero, ...
if ($radio == '' and $medio == 'Casillero') {
    echo "<h2>Error... Si selecciona CASILLEROS debe seleccionar un número de casillero!</h2>";
}

// primero grabo la reserva en los casilleros
include("conexioncas.php");

$hash = mt_rand(10000000, 99999999);
$hash5 = md5($hash);

$sqlcasilleros = "UPDATE `lockers` SET `reserva`='$numfac',`hash` = '$hash5',`fechareserva` = '$fh'  where 
`lockerid` = '$lockerid' and `localid` = '$localid' and `posicion` ='$radio[0]' ";
$resultocup = mysqli_query($concom, $sqlcasilleros);


include("conexion.php");

// Primero leo la tabla para sacar nombre y mail
$sql1 = "SELECT * FROM covidsales where secuencia = $sec ";

$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);
$nombre = $row1['nombres'];
$mail = $row1['mail'];
$factura = $row1['factura'];
$celular = $row1['celular'];

$edespacho = 'Por despachar'; // estado default despacho
if ($medio == 'Entrega en tienda') {
    $edespacho = 'Entrega en ' . $local;
}
if ($medio == 'Casillero') {
    $edespacho = 'Casillero';
}

// si es casillero pongo en  desapcho los datos casillero
if ($radio <> '' and $medio == 'Casillero') {
    $despacho = $local . " Cas:. " . $radio[0];
}

/// ahora actualizo la table
$sql = "
UPDATE `covidsales` SET `bultos`='$bultos', `despacho`='$despacho' , `fechadesp`='$fecha', `despachador`='$usuario'  , 
`fechafinal`='$fecha', `usuariofinal`='$usuario' , `estado`='$edespacho'  , `despachofinal`='$medio'
where secuencia = '$sec' ";
mysqli_query($con, $sql);
mysqli_close($con);

/// Parte del envio del sms solo si es recogida en tienda:
//Entregado en tienda
if ($medio == 'Entregado en tienda') {
    $texto = "Hola " . $nombre . ".%0aTu orden No. " . $sec . " en Computron ya esta lista para ser recogida.%0a%0aGracias";
    $telefono = "593" . substr($celular, 1);
    //die($telefono."<br>".$texto);
    // echo "<br><br>Enviando SMS:" . "<iframe src=\"https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=fernfmor2019&password=esm50742&from=Test&to=$telefono&text=$texto&type=0\" width=\"500\" height=\"40\"></iframe>";

    //header("Refresh:5; url=pdf1.php?sec=" . $sec);
} else {
    //header("Location: pdf1.php?sec=" . $sec);
}
//header("Location: pdf1.php?sec=".$sec);

if ($medio == 'Casillero') {
    echo "<h2>Use este código para abrir el casillero cuando vaya a cargar la orden:</h2>";
    echo "<img src=\"https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=" . $hash5 . "&choe=UTF-8\" title=\"Computron\" /><br>";
    echo "Factura: " . $numfac . "<br>";
    echo "Casillero: " . $radio[0] . " del COMPUTRON " . $local . "<br>";
    echo "<b><u>Nota:</u></b> Este código es válido para 1 solo uso.<br>";
    echo "<br>Imprima este documento y tengalo junto con la mercadería <br>";
    echo "Necesitará este código para poder abrir el casillero <br>";
} else {
    header("Location: blanco.php");
}
die();
