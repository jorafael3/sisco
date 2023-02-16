


<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index1.php");
}
$canal = $_SESSION["canal"];
$usuario = $_SESSION["usuario"];
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d", time());
$hora = date("H:i:s", time());
$fh = $fecha . " " . $hora;


$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
$celular = $_POST['celular'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$referencia = $_POST['referencia'];
//$compra=$_POST['compra']; 
$pago = $_POST['pago'];
$ordenweb = $_POST['ordenweb'];
$factura = $_POST['factura'];
$sec = $_POST['sec'];
$mail = $_POST['mail'];
$bodega = $_POST['bodega'];
$provincia = $_POST['provincia'];
$total = $_POST['total'];
if ($total <= 1) {
    die("<br><br><br>Regrese y complete el valor total de la compra...");
}
if (isset($_POST['casillero'])) {
    $casillero = "SI";
} else {
    $casillero = "NO";
}
if (isset($_POST['numcuotas'])) {
    $numcuotas = $_POST['numcuotas'];
} else {
    $numcuotas = 0;
}
if (isset($_POST['valcuotas'])) {
    $valcuotas = $_POST['valcuotas'];
} else {
    $valcuotas = 0;
}
if (isset($_POST['linktopaycod'])) {
    $linktopaycod = $_POST['linktopaycod'];
} else {
    $linktopaycod = '';
}

//solo dejo casillero para los locales que tienen uno
if ($bodega <> "KENNEDY") {
    $casillero = "NO";
}


include("conexion.php");

$estado = 'Verif. pago';

switch ($pago) {
    case "Tarjeta":
        $estado = "Facturado";
        break;
    case "Paymentez":
        $estado = "Verif. pago";
        break;
    case "Directo":
        $estado = "Facturado";
        break;
    case "Transferencia":
        $estado = "Verif. pago";
        break;
    case "LinkToPay":
        $estado = "Verif. pago";
        break;
    default:
        $estado = "Verif. pago";
}

/// Para MySQL
$sql = "
UPDATE `covidsales` SET `cedula`='$cedula', `provincia`='$provincia',`bodega`='$bodega', `nombres`='$nombre', 
`celular`='$celular',`ciudad`='$ciudad',`direccion`= '$direccion',`referencias`='$referencia',  
`formapago`= '$pago', `ordenweb`= '$ordenweb',`estado`='$estado' , `fechafact`= '$fh', `mail`= '$mail',
`facturador` = '$usuario', `factura` = '$factura',`numcuotas`= '$numcuotas',`valorcuotas`='$valcuotas' , `valortotal` = '$total' ,
`valorfactura`='$total', `l2pcodigo`='$linktopaycod',`casillero`='$casillero'  where secuencia = $sec";
//die("<br><br>" . $sql);
mysqli_query($con, $sql);


// creo la entrada en los mensajes para avisar facturacion de dicha bodega
$mensajenuevo = " Revise transaccion No. " . $sec . " ya que contiene un ítem de su inventario que ha sido vendido!! Retire el ítem para evitar doble facturación ";

$sqlusuario = "select * from covidusuarios where provincia ='$provincia' and bodega = '$bodega' ";
//echo "Usuario: ".$sqlusuario."<br>";
$resultusuario = mysqli_query($con, $sqlusuario);
while ($rowusuario = mysqli_fetch_array($resultusuario)) {
    $usr = $rowusuario['usuario'];

    $sqlmensaje = "INSERT INTO `covidmensajes` (`fechaingreso`,`usuariode`,`mensaje`,`usuariopara`,`leido`)
	values ( '$fh','$usuario','$mensajenuevo','$usr' ,0)  ";
    mysqli_query($con, $sqlmensaje);
    //echo $sqlmensaje."<br>";
}
//echo "xx";
//die();
mysqli_close($con);

//echo $sql;

/// Parte del envio del mail:
$message  = "Estimado(a)" . $nombre . "%0a";
$message .= "Estamos procesando su factura " . $factura . "%0a";
$message .= "Gracias por su compra!%0a";
$message .= "COMPUTRON S.A.";


//$texto = "Estimado(a) ".$nombre. ".%0aHemos registrado una orden nueva a su nombre. Por este medio recibira actualizaciones de su orden.%0a%0aGracias%0a%0aCOMPUTRON S.A. ";
$telefono = "593" . substr($celular, -9);
//die($telefono."<br>".$message);
//echo "<br><br>Enviando SMS por orden #".$sec.":". "<iframe src=\"https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=fernfmor2019&password=esm50742&from=Test&to=$telefono&text=$message&type=0\" width=\"500\" height=\"40\"></iframe>";
//header("Refresh:5; url=index1.php");

header("Location: index1.php");

die();
