<?php

	require_once('src/QrCode.php');
	use Endroid\QrCode\QrCode;
	
	$qr = new QrCode();
	
	$qr
	->setText("Esta es una prueba")
	->setSize("200")
	->render();
		
	
	
?>

