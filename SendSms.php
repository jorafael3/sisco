
<?php

$url = 'http://api.smsplus.net.ec/sms/client/api.php/sendMessage'; //la URL del metodo mPlus 

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$auth = 'OTk5OTk5MTQyOnE2RTJXYkgyckNXclpFMnY=';//clave

curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Basic {$auth}",
    'Accept: application/json',
    'Content-Type: application/json', ]);
$arregloX = ['Mortola', '01234'];//['var1','var2','var3'....]//array vacio para mensaje sin variables
$numero = '593999508017';
$idMensaje= 134269;
$idControlInterno = 105;

$dataWs = ['phoneNumber' => $numero,//telefono
    'messageId' => $idMensaje,//id
    'transactionId' => $idControlInterno,//id interno
    'dataVariable' => $arregloX//,//ejemplo 'dataVariable' => ['var1','var2','var3']
    
];


curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataWs));

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //verifica
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //verifica

$resp = curl_exec($curl);
curl_close($curl);
//echo $resp;
//{"codError":100,"desError":"OK","transactionId":"21052811221092520"}
$data = json_decode($resp, true);//json a array
$codigoRespuesta = $data['codError'] ;
$descripcionRespuesta = $data['desError'] ;
$transaccionIDMplus = $data['transactionId'] ;
echo $codigoRespuesta;//100
echo $descripcionRespuesta;//OK
echo $transaccionIDMplus;//21052811403092568