
<meta name="viewport" content="width=device-width, height=device-height">
<html>
<head>
<title>Sistema SISCO</title>
<link rel="stylesheet" type="text/css" href="css/menumin.css">

<script type="text/Javascript">
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
</script>
</head>

<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("barramenu.php");
//if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

$nivel = $_SESSION["nivel"];



 
$id= $_POST['id'] ;

?>
 
  <br><br><Form Action="buscavoucher1.php" Method="POST"><br>
  <center><table border=1 cellpadding=5 cellspacing=1 width=600><th><img src="images/logo.png" height="auto" width="80%"></th> <th><br><h3>Buscar: </h3></th></center><tr>
</center>
   <th><left>Buscar Voucher:</left>
    
   </th><td>
   <center><Input Type=text  Size = 15 Maxlenght=15  Name="lote" id="lote" onkeyup="checkDec(this)" placeholder ="Lote"<center><br>
   <center><Input Type=Text  Size = 15 Maxlenght=15  Name="autorizacion" id="autorizacion"  onkeyup="checkDec(this)" placeholder ="Autorización"<center><break>
   <center><Input Type=Text  Size = 15 Maxlenght=15  Name="valor" id="valor" onkeyup="checkDec(this)" placeholder ="Valor"<center>
   </td></tr>

   <th>Opciones:<center></th><td><center><Input Type=Submit Value="Buscar" class="btn btn-sm btn-primary"></center>
   </Form>


</td></tr>
</p>
</body>
</html>


