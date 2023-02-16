<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  <title>Control Ventas Online</title>
</head>

<body>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Font Awsome https://fontawesome.com-->
  <script src="https://kit.fontawesome.com/1c253b40c1.js" crossorigin="anonymous"></script>

  <script type="text/javascript" src="http://app.compu-tron.net/sisco/jquery/jquery-1.11.1.min.js"></script>


  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">

    <!-- Just an image -->
    <a class="navbar-brand" href="#">
      <img src="http://app.compu-tron.net/sisco/images/logo.png" width="180" height="50" alt="">
    </a>

    <!-- 
  <a class="navbar-brand" href="#">Navbar</a>
 -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="http://app.compu-tron.net/sisco/index.php"><i class="fas fa-power-off"></i> LOGOUT
            <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-list"></i> Listar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/mensajes1.php">Mensajes</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/index2.php">Ventas cerradas</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/index3.php">Todas las ventas</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/anuladas.php">Ventas anuladas</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexcaja.php">Listado caja</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/graf-facturas1.php">Rep. facturas x
              vendedor</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexcc1.php">Listado tarjetas por
              cobrar</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexl2p.php">APROBACIONES Link To Pay</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexl2pV.php">Verificaciones Link To
              Pay</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexblock.php">Listado blockeados</a>

          </div>
        </li>
        <!-- <li class="nav-item">
         <a class="nav-link" href="http://app.compu-tron.net/sisco/busca0.php"><i class="fas fa-search"></i> Buscar</a>
      </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search"></i> Buscar
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/busca0.php">Buscar sisco</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/buscavoucher0.php"> Buscar Vouchers</a>
          </div>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fab fa-shopify"></i> Ventas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/form1.php"><i class="fas fa-plus-circle"></i>
              Ingresar venta</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indextransfer1.php"><i class="fas fa-paperclip"></i> Adjuntar transferencia</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-hand-holding-usd"></i> Crédito
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexcd1.php"><i class="far fa-window-close"></i> Documentos pendientes</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexcd2.php"><i class="far fa-check-square"></i> Documentos completos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-phone-alt"></i> Callcenter
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexcc2.php"><i class="far fa-thumbs-up"></i> Aprobación crédito directo</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-shipping-fast"></i> Despacho
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexpreparar.php"><i class="fas fa-boxes"></i> Por preparar</a>
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexnoguia.php"><i class="fas fa-arrows-alt"></i> Método envío</a>
            <!-- <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexpdf.php"><i
                class="far fa-file-pdf"></i>
              Por adjuntar PDF guía</a> -->
            <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexdesp.php"><i class="fas fa-truck"></i>
              Por despachar</a>
            <!-- 
          <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexpreparar.php"><i class="fas fa-dolly"></i> Preparar</a>
          <a class="dropdown-item" href="http://app.compu-tron.net/sisco/indexserie.php"><i class="fas fa-barcode"></i> Serie</a>
 -->
          </div>
        </li>

        <?php

        if ($_SESSION['canal_id'] > 2) {

        ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-cog"></i> Supervisores
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/anula0.php"><i class="fas fa-ban"></i> Anular transacción</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_menu1.php"><i class="fas fa-database"></i> Reportes</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_menudt1.php"><i class="fas fa-database"></i> Reportes detalle</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_cdirecto.php"><i class="fas fa-database"></i> Reporte Documentos Credito</a>
              <!-- 
                  <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/notificaciones.php"><i class="far fa-bell"></i> Notificaciones</a>
              -->
            </div>
          </li>
        <?php
        } else {
        ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-cog"></i> Supervisores
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/usuarios1.php"><i class="fas fa-users"></i> Listar usuarios</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/agrega1.php"><i class="fas fa-user-plus"></i> Crear usuario</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/anula0.php"><i class="fas fa-ban"></i> Anular transacción</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_menu1.php"><i class="fas fa-database"></i> Reportes</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_menudt1.php"><i class="fas fa-database"></i> Reportes detalle</a>
              <a class="dropdown-item" href="http://app.compu-tron.net/sisco/reportes/reporte_cdirecto.php"><i class="fas fa-database"></i> Reporte Documentos Credito</a>
              <!-- 
                  <a class="dropdown-item" href="http://app.compu-tron.net/sisco/usuarios/notificaciones.php"><i class="far fa-bell"></i> Notificaciones</a>
              -->
            </div>
          </li>
        <?php
        }
        ?>



      </ul>

      <!-- 
    <form class="form-inline">
    	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
  	</form>
 -->

      <ul></ul>


      <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
          <li class="nav-item active">
            <?PHP session_start();
            include("script_mensaje.php");
            echo "<a class=\"nav-link\" >";
            if (isset($_SESSION['usuario'])) {
              echo "<small><b>Usr: </b>" . $_SESSION['usuario'];
            }
            if (isset($_SESSION['canal'])) {
              echo "<br><b>Canal: </b>" . $_SESSION['canal'] . "</small>";
            }
            echo "</a>";
            ?>


          </li>
          <!-- 
            <li class="nav-item active">
              		  <?php
                    require("conexion.php");
                    $usr = $_SESSION['usuario'];
                    date_default_timezone_set('America/Guayaquil');
                    $fecha = date("y-m-d", time());
                    $hora = date("H:i:s", time());
                    $sql = "select * from `sac-casos` where encargado ='$usr'   ";
                    $result = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                      echo "<a class=\"nav-link\" href=\"#\"><img src=\"images/campana.png\" height=\"50\" width=\"50\"></a>";
                    } else {
                      echo "<href=\"#\"><img src=\"images/campana2.png\" height=\"50\" width=\"50\">";
                    }
                    ?>
            </li>

            <li class="nav-item active">
					  <a class="nav-link" href="#"><img src="http://app.compu-tron.net/sisco/images/soporte.png" height="50" width="50"></a>
            </li>

 -->

        </ul>
      </div>



    </div>
  </nav>

  <p>
  <form name="form"></form>
  <div id="info"> </div>
  </p>

</body>

</html>