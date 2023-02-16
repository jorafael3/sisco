


<?php
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

$sec = $_POST['sec'];
$numfac = $_POST['numfac'];

include("conexion.php");

/// Verifico si es pickup o despacho
$sqlc = "select * from  `covidsales`  where secuencia = '$sec' ";
$result2 = mysqli_query($con, $sqlc);
$row2 = mysqli_fetch_array($result2);
$celular = $row2['celular'];
$nombre = $row2['nombres'];
if ($row2['pickup'] == 1) {
	$pickup = 1;
} else {
	$pickup = 0;
}


if ($pickup == 1) // si es 1 envio SMS+mail a cliente y tienda
{
	$sqljoin = "SELECT a.provincia as nombreprovincia, a.provinciaid, a.local, a.mail, a.sms, a.anulado ,
		b.orden, b.bodega, b.provincia, b.anulado
		FROM `covidnotificaciones` as a
		inner join covidpickup as b
		on a.provinciaid = b.provincia and a.local = b.bodega
		WHERE b.orden ='$sec' and a.anulado<>'1' and b.anulado<>'1' ";

	$resultjoin = mysqli_query($con, $sqljoin);
	$rowj = mysqli_fetch_array($resultjoin);
	$smstienda = "593" . substr($rowj['sms'], -9);
	$mailtienda = $rowj['mail'];
	$ordentienda = $rowj['orden'];
	$local = $rowj['local'];
	$provincia = $rowj['nombreprovincia'];

	$textotienda = "Local (" . $provincia . " - " . $local . ") el pedido No. " . $ordentienda . " sera recogido de su local,revise el SISCO y aliste el pedido ";

	$texto = "Estimado(a) " . $nombre . ".%0aSu pedido esta listo para ser recogido.%0a%0aGracias%0a%0aCOMPUTRON S.A. ";
	$telefono = "593" . substr($celular, -9);
	//die($telefono."<br>".$texto);
	echo "<br><br>Enviando SMS al cliente :" . "<iframe src=\"https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=fernfmor2019&password=esm50742&from=Test&to=$telefono&text=$texto&type=0\" width=\"500\" height=\"40\"></iframe>";
	echo "<br><br>Enviando SMS a la tienda:" . "<iframe src=\"https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=fernfmor2019&password=esm50742&from=Test&to=$smstienda&text=$textotienda&type=0\" width=\"500\" height=\"40\"></iframe>";

	// envio el mail al mail de la tienda
	/// Parte del envio del mail:
	$message  = $textotienda;


	// PARA CAMBIAR ALEATORIAMENTE EL ENVIO DEL CORREO
	$aleatorio = (rand(1, 5));
	switch ($aleatorio) {
		case "1":
			$mailsender = "cartimexmail1@gmail.com";
			break;
		case "2":
			$mailsender = "cartimexmail2@gmail.com";
			break;
		case "3":
			$mailsender = "cartimexmail3@gmail.com";
			break;
		case "4":
			$mailsender = "cartimexmail4@gmail.com";
			break;
		default:
			$mailsender = "cartimexmail5@gmail.com";
	}
	// 
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
	$m->addAddress($mailtienda);
	//$m->addBCC('fmortola@gmail.com','Victor Cedeno');

	$m->isHTML(true);
	// $m->addAttachment('directorio/nombrearchivo.jpg','nombrearchivo.jpg')
	$m->Subject = "Retiro de mercaderia en tienda";
	$m->Body = $message;


	var_dump($m->send());
}


/// ahora actualizo la table
$sql = "UPDATE `covidsales` SET  `preppor`='$usuario' , `preparada`='$fh' where secuencia = '$sec' ";
//die($sql);
mysqli_query($con, $sql);
mysqli_close($con);



echo "<br><br><H2>Actualizando información</h2>" .
	//header("Refresh:3; url=tomaserie1.php?sec=$sec&numfac=$numfac");
	header("Refresh:3; url=blanco.php");

//header("Location: pdf1.php?sec=".$sec);
die();
