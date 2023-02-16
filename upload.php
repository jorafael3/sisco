<?php
session_start();
$sec= $_POST['sec'] ;
$despacho= $_POST['despacho'] ;

include("barramenu.php");
echo "<br><br><br>";
$message = ''; 
// if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
// {
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $newFileName = $despacho . '.' . $fileExtension;
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../siscopdf/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='Archivo correctamente cargado. Ha sido asignado a la transaccion:'.$sec;
        // aqui actualizo la base de datos con el archivo. En el registro $sec meto en PDF el valor de $despacho
        include("conexion.php");
		$sql = "UPDATE `covidsales` SET   `pdf`='$newFileName' where secuencia = '$sec' " ;
		//echo $sql."<br>";
		mysqli_query($con, $sql); 
		mysqli_close($con);

      }
      else 
      {
        $message = 'Ha ocurrido un error en la carga. Informe al administrador del sistema';
      }
    }
    else
    {
      $message = 'Error en carga. Tipo de archivos permitidos: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'Ha ocurrido el siguiente error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
// }
echo $message;
$_SESSION['message'] = $message;
die();
header("Location: fer.php");