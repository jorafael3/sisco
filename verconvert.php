
<?PHP

session_start();
$fac= $_GET['fac'] ;

include("conexion.php");

$sql = "SELECT * FROM covidsales where  factura like '%$fac%'   ";
$result = mysqli_query($con, $sql);
$count=mysqli_num_rows($result);
$row = mysqli_fetch_array($result) ;

$sec=$row['secuencia'];

header("Refresh:1;url=verorden1.php?sec=$sec");
//http://app.compu-tron.net/sisco/verorden1.php?sec=5839
//die($sec);




 ?>


