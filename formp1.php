<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">
<html>

<head>
  <style type="text/css">
    .zoom {
      transition: transform .5s;
    }

    .zoom:hover {
      transform: scale(10);
    }

    .ventana {
      background: rgba(0, 0, 102, 1);
      width: 30%;
      color: rgba(255, 255, 255, 1);
      text-align: center;
      padding: 33px;
      min-height: 250px;
      border-radius: 22px;
      position: absolute;
      left: 32%;
      top: 30%;
      display: none;

    }

    .cerrar {
      position: absolute;
      right: 3px;
      top: 3px;
    }
  </style>



  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <title>Sistema SISCO</title>
  <link rel="stylesheet" type="text/css" href="css/menus.css">

  <script type="text/Javascript">
    function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
</script>

</head>

<?php include "connectdb.php"; ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
    $("#ddlcredito").change(function() {
      if ($(this).val() == "Directo") {
        $("#dvcredito").show();
      } else {
        $("#dvcredito").hide();
      }
    });
  });
</script>

<script>
  function getState(val) {
    $.ajax({
      type: "POST",
      url: "get_state.php",
      data: 'idgrupo=' + val,
      success: function(data) {
        $("#state-list").html(data);
      }
    });
  }

  function showMsg() {

    $("#msgC").html($("#country-list option:selected").text());
    $("#msgS").html($("#state-list option:selected").text());
    return false;
  }
</script>


<script type="text/javascript">
  $(function() {
    $("#state-list").change(function() {
      if ($(this).val() == "KENNEDY" || $(this).val() == "CEIBOS") {
        $("#casilleros").show();
      } else {
        $("#casilleros").hide();
      }
    });
  });
</script>

<!-- <script type="text/javascript">
  $(function() {
    $("#state-list").change(function() {
      if ($(this).val() == "KENNEDY") {
        $("#casilleros").show();
      } else {
        $("#casilleros").hide();
      }
    });
  }); -->


</script>

<body>


  <div class="ventana" id="vent">
    <div class="cerrar"> <a href="javascript:cerrar()"><img src="images/cerrar.png"></a></div>
    <h3>Uso de casilleros:</h3>
    El uso de casilleros está restringido al tamaño del producto.
    Artículos que si caben: celulares, portátiles, impresoras, accesorios, cpu Xtratech, <br>
    No caben: Televisores de mas de 32 pulgadas, impresoras corporativas, lavadoras, etc.

  </div>

  <?php

  // error_reporting(E_ALL);
  // ini_set('display_errors','1');


  // para aplicar pago y escribir numero de factura aunque no este confirmado el pago
  // esto es para reservar los productos y que no esten vendidos cuando el pago este confirmado
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("Location: index1.php");
  }
  include("barramenu.php");
  require("conexion.php");
  //echo "<br><br>";
  if ($_SESSION["nivel"] <> '20') {
    die("<br><br><h2>No tiene acceso a esta opción!</h2>");
  }


  $sec = $_GET['sec'];
  date_default_timezone_set('America/Guayaquil');
  $fecha = date("Y-m-d", time());
  $hora = date("H:i:s", time());
  $fh = $fecha . " " . $hora;
  $usrid = $_SESSION["usuario"];


  $sqlblock = "UPDATE `covidsales` SET `lockid`='$usrid', lockdate ='$fh' where secuencia =$sec ";
  mysqli_query($con, $sqlblock);

  $sql = "
SELECT a.secuencia, a.cedula, a.nombres, a.celular, a.ciudad, a.venta, a.valortotal, a.ordenweb,
 a.bodega,a.fecha, a.pdf, a.formapago, a.vendedor, a.estado, a.factura, a.fechafact, a.despacho, a.l2p, 
 a.bultos, a.estado, a.fechadesp, a.anulada, a.pickup, a.mail, a.valorcuotas, a.numcuotas,a.tipotarjeta, 
 a.direccion, a.referencias, b.orden, b.provincia, b.bodega ,c.provincia , d.doc2, e.doc1 , 
 f.doc1 as ced, f.doc2 as tarj, f.doc3 as vou,  a.comentarios as comentarios ,  a.ordenbodegaf 
FROM `covidsales` as a 
left join covidpickup as b on a.secuencia = b.orden 
left join covidprovincia as c on b.provincia= c.idgrupo 
left join covidcredito as d on a.secuencia= d.transaccion 
left join covidtransferencias as e on a.secuencia= e.transaccion 
left join coviddocumentos as f on a.secuencia = f.transaccion
where a.secuencia =$sec
";

  //echo "<br><br>".$sql;
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $nombre = $row['nombres'];
  $cedula = $row['cedula'];
  $celular = $row['celular'];
  $ciudad = $row['ciudad'];
  $direccion = $row['direccion'];
  $referencias = $row['referencias'];
  $venta = $row['venta'];
  $formapago = $row['formapago'];
  $ordenweb = $row['ordenweb'];
  $mail = $row['mail'];
  $total = $row['valortotal'];
  $valcuotas = $row['valorcuotas'];
  $numcuotas = $row['numcuotas'];
  $pickup = $row['pickup'];
  $provincia = $row['provincia'];
  $bodega = $row['bodega'];
  $tipotarjeta = $row['tipotarjeta'];
  $uto = $row['vendedor'];
  $ufrom = $_SESSION["usuario"];
  $comentarios = $row['comentarios'];
  $ordenbodegaf = $row['ordenbodegaf'];
  
  
  if (isset($row['doc2'])) {
    $pagare = $row['doc2'];
  } else {
    $pagare = '';
  }
  if (isset($row['doc1'])) {
    $transfer = $row['doc1'];
  } else {
    $transfer = '';
  }
  if (isset($row['ced'])) {
    $docced = $row['ced'];
  } else {
    $docced = '';
  }
  if (isset($row['tarj'])) {
    $doctarj = $row['tarj'];
  } else {
    $doctarj = '';
  }
  if (isset($row['vou'])) {
    $docvou = $row['vou'];
  } else {
    $docvou = '';
  }
  $linktopay = $row['l2p'];

  //die("<br><br><br>pagare:".$tipotarjeta);
  $ruta = "http://app.compu-tron.net/siscodocumentos/";

  ?>

  <Form Action="formp2.php" Method="post">



    <center>
      <table border=0 cellpadding=0 cellspacing=0>
    </center>
    <tr>
      <Th colspan=2>
        <h2>Formulario de pago de facturas</h2>
      </th>

    </tr>

    <!-- 
</table>



<table border=0 cellpadding=1 cellspacing=3 width=65%>
 -->

    <th width=40%>Transacción:</th>
    <td><Input Type=Text Size=40 Maxlenght=100 Name="trans" id="trans" value="<?php echo $sec ?>" READONLY> </td>
    </tr>

    <th>Nombre:</th>
    <td><Input Type=Text Size=40 Maxlenght=100 Name="nombre" id="nombre" value="<?php echo $nombre ?>"> </td>
    </tr>


    <th>Cedula / RUC:</th>
    <td><Input Type=Text Size=40 Maxlenght=100 Name="cedula" id="cedula" value="<?php echo $cedula ?>"></td>
    </tr>


    <th>Celular:</th>
    <td><Input Type=Text Size=10 Maxlenght=10 Name="celular" id="celular" value="<?php echo $celular ?>"></td>
    </tr>
    </tr>
    <th>Mail:</th>
    <td><Input Type=Text Size=40 Maxlenght=40 Name="mail" id="mail" value="<?php echo $mail ?>"></td>
    </tr>
    </tr>
    <th>Ciudad:</th>
    <td><Input Type=Text Size=40 Maxlenght=40 Name="ciudad" id="ciudad" value="<?php echo $ciudad ?>"></td>
    </tr>
    </tr>


    <th>Dirección:</th>
    <td><textarea name="direccion" rows="4" cols="100"> <?php echo $direccion ?>
</textarea></td>
    </tr>

    <th>Referencia:</th>
    <td> <textarea name="referencia" rows="4" cols="100"> <?php echo $referencias ?>
</textarea></td>
</tr>
<th>Comentarios:</th>
    <td> <textarea name="comentarios" rows="4" cols="100"> <?php echo $comentarios ?>
</textarea></td>

    </tr>
<th>Bodega de facturacion Orden:</th>
    <td><Input Type=Text Size=40 Maxlenght=40 Name="ordenbodegaf" id="ordenbodegaf" value="<?php echo $ordenbodegaf ?>"></td>
    </tr>
    </tr>

    <th>Compra:</th>

    <td>
      <table border=2 cellpadding=0 cellspacing=0 style="background-color: #ff0000"> <?php echo $venta; ?></table>


      <!-- 
<textarea name="compra" rows="4" cols="100"  > <?php echo $venta ?>
</textarea>
 -->
    </td>
    </tr>
    <th>Valor total de la compra:</th>
    <td><Input Type=Text Size=10 Maxlenght=10 Name="total" id="total" value="<?php echo $total ?>" onkeyup="checkDec(this)"> </td>
    </tr>

    <th><span>Forma de pago:</span></th>
    <td>
      <select disabled name="pagodisabled" id="ddlcredito" onchange="ShowHideDiv()">
        <?php
        if ($formapago == "Paymentez") {
          echo "<option value='Paymentez' selected>Paymentez</option>";
        } else {
          echo "<option value='Paymentez' >Paymentez</option>";
        }
		if ($formapago == "Tienda") {
          echo "<option value='Tienda' selected>Pago en Tienda</option>";
        } else {
          echo "<option value='Tienda' >Pago en Tienda</option>";
        }
        if ($formapago == "Tarjeta") {
          echo "<option value='Tarjeta' selected>Tarjeta</option>";
        } else {
          echo "<option value='Tarjeta' >Tarjeta</option>";
        }
        if ($formapago == "Transferencia") {
          echo "<option value='Transferencia' selected>Transferencia</option>";
        } else {
          echo "<option value='Transferencia' >Transferencia</option>";
        }
        if ($formapago == "Directo") {
          echo "<option value='Directo' selected>C. Directo</option>";
        } else {
          echo "<option value='Directo' >C. Directo</option>";
        }
        if ($formapago == "LinkToPay") {
          echo "<option value='LinkToPay' selected>Link To Pay</option>";
        } else {
          echo "<option value='LinkToPay' >Link To Pay</option>";
        }

        ?>

      </select><?php echo $tipotarjeta; ?></td>
    </tr>

    <?php if ($numcuotas <> '' or $valcuotas <> '') { ?>
      <th>Ingrese las condiciones del crédito:</th>
      <td>
        <div id="dvcredito" style="display: inline">
        <?php } else { ?>
      <th></th>
      <td>
        <div id="dvcredito" style="display: none">
        <?php } ?>
        <b>Número de cuotas: </b>
        <input type="text" Size=5 Maxlenght=5 id="numcuotas" name="numcuotas" value="<?php echo $numcuotas ?>" />
        <b>Valor de cuota: </b>
        <input type="text" Size=5 Maxlenght=5 id="valcuotas" name="valcuotas" value="<?php echo $valcuotas ?>" />
      </td>
      </tr>
      </div>

      <?php if ($linktopay <> '') { ?>
        <th></th>
        <td>
          <div id="linktopay" style="display: inline">
          <?php } else { ?>
        <th></th>
        <td>
          <div id="linktopay" style="display: none">
          <?php } ?>
          <b>Enlace: </b>
          <input type="text" Size=40 Maxlenght=70 id="linktopay" name="linktopay" value="<?php echo $linktopay ?>" readonly />
          <b>Código: </b>
          <input type="text" Size=15 Maxlenght=15 id="linktopaycod" name="linktopaycod" value="<?php echo $linktopaycod ?>" />
          <input type="button" value="Pago NEGADO" class="homebutton" id="btnHome" onClick="window.location = 'mensajesl2p.php?uto=<?php echo $uto; ?>&sec=<?php echo $sec; ?> '" />

          </div>
        </td>
        </tr>


        <?php
        $nivel = $_SESSION["nivel"];

        if ($nivel >= 20 or strlen($ordenweb) >= 1) {
          echo "<th >Orden WEB:</th>";
          echo "<td ><Input Type=Text Size = 12 Maxlenght=12 Name='ordenweb' id='ordenweb' value = $ordenweb></td></tr>";
        } else {
          echo "<Input Type=hidden Name='ordenweb' value=''>";
        }

        echo "<Input Type=hidden Name='sec' value='$sec'>";
        echo "<Input Type=hidden Name='pago' value='$formapago'>";

        // aqui debo poner la informacion del pickup
        echo "<th >Forma de despacho:</th>";
	
        if ($pickup == 1) // se ercoge en tienda, debo mostrar la info de provincia y local
        {
          echo "<td><strong>Retira en tienda : " . $provincia . " - " . $bodega . "</strong>";

          echo "<div id='casilleros' style='display: none'>";
          // aqui pregunto por retirada en casillero
          if ($bodega == "KENNEDY" or $bodega == "CEIBOS" or $bodega == "NORTE") {
            echo " &nbsp&nbspRetirar en casillero <input type='checkbox' value='1' name='casillero'/>  <a href= 'javascript:abrir()' ><img src ='images/pregunta.png'></a></td></tr>";
          }
          echo "</div> </td>";
        } else // no se recoge en tienda
        {
          echo "<td><strong>Envío a dirección registrada</strong></td>";
        }
        echo "<tr> <th><strong>Bodega de facturacion de mercaderia:</strong></th>";
		?>
        <!-- 
<td ><Input Type=Text Size = 25 Maxlenght=25 Name="bodega" id="bodega" required></td></tr>
 -->

        <td><strong>Provincia:<strong>
              <select name="provincia" id="country-list" class="demoInputBox" required onChange="getState(this.value);">

                <option value="">Seleccione provincia</option>
                <?php
                $sql1 = "SELECT * FROM covidprovincia";
                $results = $dbhandle->query($sql1);
                while ($rs = $results->fetch_assoc()) {
                ?>
                  <option value="<?php echo $rs["idgrupo"]; ?>"><?php echo $rs["provincia"]; ?></option>
                <?php
                }
                ?>
              </select><strong>&nbsp&nbsp&nbspBodega:<strong>
                  <select id="state-list" name="bodega" required onchange="ShowHideDiv()">
                    <option value="">Seleccione bodega</option>

               </select></td>
        </tr>



        <th><strong>Factura DOBRA:</strong></th>
        <td><Input Type=Text Size=25 Maxlenght=25 Name="factura" id="factura" required></td>
        </tr>
        <?php

        if ($pagare <> '') {
          echo "<th ><strong>Pagaré de crédito:</strong></th>";
          echo "<td ><a href=muestrapagare.php?sec=$pagare>" . $pagare . "</td></tr>";
        }
        if ($transfer <> '') {
          echo "<th ><strong>Transferencia bancaria:</strong></th>";
          echo "<td ><img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/" . $transfer . "' height='70' width='120'/></td></tr>";
        }
        //echo "<td ><a href=muestraimagent.php?sec=$sec&a=1>".$transfer."</td></tr>";
        if ($docced <> '' or $doctarj <> '' or $docvou <> '') {
          echo "<th ><strong>Documentos:</strong></th>";
          echo "<td ><img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/" . $docced . "' height='70' width='120'/>";
          echo "<img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/" . $doctarj . "' height='70' width='120'/>";
          echo "<img class = 'zoom' src = 'http://app.compu-tron.net/siscodocumentos/" . $docvou . "' height='70' width='120'/></td></tr>";
        }

        ?>
        <td>
          <input type="button" value="No hay PRODUCTOS" class="homebutton" id="btnHome2" onClick="window.location = 'mensajesnoprod.php?uto=<?php echo $uto; ?>&sec=<?php echo $sec; ?> '" />

        </td>
        <td>
          <Center><Input Type=Submit Value="PAGAR FACTURA" class="btn btn-sm btn-primary"></Center>
  </form>

  <!-- 
Boton para duplicar la orden si se necesita dividir en mas para sacar de diferentes bodegas
 -->
  <Form Action="duplica.php" Method="post">
    <Input Type=hidden Name='sec' value='<?php echo $sec ?> '>
    <Center><br><Input Type=Submit Value="DUPLICAR PEDIDO" class="btn btn-xs btn-danger"></Center>
    </td>
  </form>

  </table>

  </form>

  <script>
    function abrir() {
      document.getElementById("vent").style.display = "block";
    }

    function cerrar() {
      document.getElementById("vent").style.display = "none";
    }
  </script>

</body>