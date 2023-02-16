
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menumin.css">

</head>
<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

$nivel = $_SESSION["nivel"];
$id= $_POST['id'] ;

?>
 
  <br><br><Form Action="busca1.php" Method="POST"><br>
  <center><table border=1 cellpadding=5 cellspacing=1 width=600><th><img src="images/logo.png" height="auto" width="80%"></th> <th><br><h3>Buscar: </h3></th></center><tr>
</center>
   <th><left>Buscar Transacción por:</left>
   <br><left>  -Número transacción</left>
   <br><left>  -Número de factura&nbsp&nbsp</left>
   <br><left>  -Número de guía&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</left>
   <br><left>  -Nombre cliente&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</left>
   <br><left>  -Número de cédula&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</left>
   <br><left>  -Número de órden WEB&nbsp&nbsp&nbsp&nbsp&nbsp</left>
   
   </th><td><center><Input Type=Text  Size = 15 Maxlenght=15  Name="id" id="id" style='text-transform:uppercase'><center></td></tr>

   <th>Opciones:<center></th><td><center><Input Type=Submit Value="Buscar" class="btn btn-sm btn-primary"></center>
   </Form>


</td></tr>
</p>
</body>
</html>


