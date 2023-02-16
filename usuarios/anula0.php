<link rel="stylesheet" type="text/css" href="../css/menumin.css">


<?PHP

session_start();
if (!isset($_SESSION["usuario"])) {header("Location: index1.php");}
include("../barramenu.php");
if ($_SESSION["nivel"]=='99'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}

$nivel = $_SESSION["nivel"];



$id= $_POST['id'];

?>
 
  <br><br><Form Action="anula1.php" Method="POST"><br>
  <center><table border=1 cellpadding=5 cellspacing=1><th><img src="../logo.png" height="auto" width="50%"></th> <th><br><h3>Anular Venta: </h3></th><tr>

   <th><left>Numero Transacción:</th><td><center><Input Type=Text  Size = 15 Maxlenght=15  Name="id" id="id" style='text-transform:uppercase' autofocus>     </center</td></tr>

   <th>Opciones:<center></th><td><center><Input Type=Submit Value="Continuar" class="btn btn-sm btn-primary"></center>
   </Form>


</td></tr>
</p>
</body>
</html>


