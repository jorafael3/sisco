<?php

//$link = mssql_connect('10.5.1.3:1433', 'pagcomp', 'computron2015$');
$link = mssql_connect('10.5.1.3:1433', 'jairo', 'qwertys3gur0');

if (!$link)
    die('Imposible conectar con el DOBRA!');
else
   //     echo mssql_get_last_message();
    //    echo '<br>';

if (!mssql_select_db('CARTIMEX', $link))
    die('No se puede seleccionar la base!');
else
 //        echo mssql_get_last_message();
 //       echo '<br>';

echo '<br>';
?>
