


<?php
session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}

$usuario = $_SESSION["usuario"] ;
require("conexion.php");
date_default_timezone_set('America/Guayaquil');
$fecha = date("y-m-d", time());
$hora = date("H:i:s", time());

$medio=$_POST['medio']; 
$numfac=$_POST['numfac'];               
$sec=$_POST['sec'];

include("conexion.php");

// Primero leo la tabla para sacar nombre y mail
$sql1 = "SELECT * FROM covidsales where secuencia = $sec ";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($result1);
$nombre = $row1['nombres'];
$mail = $row1['mail'];
$despacho = $row1['despacho'];
$bultos = $row1['bultos'];


/// Para MySQL
$sql = "
UPDATE `covidsales` SET  `fechafinal`='$fecha', `usuariofinal`='$usuario' , `estado`='Por despachar'  , `despachofinal`='$medio'
where (secuencia = '$sec' and factura = '$numfac')" ;

mysqli_query($con, $sql); 
mysqli_close($con);

/// Parte del envio del mail:
$message  = "Estimado(a)".$nombre."<br><br>";
$message .= "Su factura ".$numfac." ha sido despachada.<br><br> ";
$message .= "Cantidad de bultos:".$bultos."<br><br>";

if ($medio =="Urbano")
{
$message .= "Courrier:".$medio."<br><br>";
$message .= "Número de guía:".$despacho."<br><br>";
$message .= "Puede rastrear su pedido aquí : https://www.urbano.com.ec<br><br>";
}
else
{
$message .= "Medio de despacho:".$medio."<br><br>";
}
$message .= "Gracias por preferirnos!<br><br>";
$message .= "COMPUTRON S.A.";

// PARA CAMBIAR ALEATORIAMENTE EL ENVIO DEL CORREO
$aleatorio = (rand(1,5));
	switch ($aleatorio) {
	case "1":
		$mailsender="cartimexmail1@gmail.com";
		break;
	case "2":
		$mailsender="cartimexmail2@gmail.com";
		break;
	case "3":
		$mailsender="cartimexmail3@gmail.com";
		break;
	case "4":
		$mailsender="cartimexmail4@gmail.com";
		break;
	default:
		$mailsender="cartimexmail5@gmail.com";
	}

require_once '../vendor/autoload.php';
$m = new PHPMailer;
$m->CharSet = 'UTF-8';
$m->isSMTP();
$m->SMTPAuth = true;
$m->Host = 'smtp.gmail.com';
$m->Username = $mailsender;
$m->Password = 'Bruno2001';
$m->SMTPSecure = 'ssl';
$m->Port = 465;

$m->From = 'cartimexsa@gmail.com';
$m->FromName = 'COMPUTRON S.A.';
$m->addAddress($mail);
$m->addBCC('fmortola@gmail.com');

$m->isHTML(true);
// $m->addAttachment('directorio/nombrearchivo.jpg','nombrearchivo.jpg')
$m->Subject = "FACTURA COMPUTRON";
$m->Body = $message;


//var_dump( $m->send() );




header("Location: index1.php");
die();

