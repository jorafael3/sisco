<!DOCTYPE html>
<meta name="viewport" content="width=device-width, height=device-height">

<head>
    <title>Sistema SISCO</title>
    <link rel="stylesheet" type="text/css" href="css/menus.css">
    <script src="https://code.jquery.com/jquery-git.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <SCRIPT TYPE="text/javascript">
    <!--
    // copyright 1999 Idocs, Inc. http://www.idocs.com
    // Distribute this script freely but keep this notice in place
    function numbersonly(myfield, e, dec) {
        var key;
        var keychar;

        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);

        // control keys
        if ((key == null) || (key == 0) || (key == 8) ||
            (key == 9) || (key == 13) || (key == 27))
            return true;

        // numbers
        else if ((("0123456789").indexOf(keychar) > -1))
            return true;

        // decimal point jump
        else if (dec && (keychar == ".")) {
            myfield.form.elements[dec].focus();
            return false;
        } else
            return false;
    }

    //
    -->
    </SCRIPT>


    <script type="text/javascript" src="calendarDateInput.js">
    /***********************************************
     * Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
     * Script featured on and available at http://www.dynamicdrive.com
     * Keep this notice intact for use.
     ***********************************************/
    </script>


    <!-- 
este activa o desactiva el dropdown de vendedor
 -->
 

    <!-- 
este activa o desactiva el dropdown de despacho
 -->
  

    <!-- 
este activa o desactiva el dropdown de como llego el cliente
 -->
     

    <!-- 
este activa o desactiva el dropdown de forma de pago
 -->
     

    <?php
   session_start();

   //echo "<br><br><br><br>aaaaaaaa:".$_POST['despacho1'];
   include("../barramenu.php");

   include("../conexion.php");
   // if ($_SESSION["sacceso"]<>"1")
   //         {
   //         // User not logged in, redirect to login page
   //         Header("Location: /tarjetas/index.php");
   //         }
   // 


   // Popular el Dropdown:
   $marcasdd = array();
   $sql = "SELECT * FROM covidusuarios where nivel ='10' and activo = '1' order by usuario  ";
   $result = mysqli_query($con, $sql);
   $count = mysqli_num_rows($result);
   $i = 0;
   while ($row = mysqli_fetch_array($result)) {
      $i = $i + 1;
      // 		if ($row['nivel'] == '0') {$cargo= "(Ingreso)";}
      // 		if ($row['nivel'] == '1') {$cargo= "(Admin.)";}
      // 		if ($row['nivel'] == '2') {$cargo= "(Volanteo)";}		
      $mostrar[] = utf8_decode($row['usuario']); ///  .'-'.$cargo;
      $marcas[] = $row['secuencia'];
      $agentname[] = utf8_decode($row['usuario']);
   }
   $zz = count($marcas) - 1;


   ?>

    <HTML>

    <HEAD>
        <script language="javascript" src="calendar.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/menus.css">
        <link rel="stylesheet" type="text/css" href="../css/boton.css">


        <TITLE>Reportes varios:</TITLE>
    </HEAD>

<BODY>
    <br>
    <br>
    <br>
    <center>
        <table border=1 cellpadding=5 cellspacing=1 width=1000>
            <th width=20%><img src="../logo.png" height="70" width="350" id="placa"></th>
            <th>
                <h3>
                    <center>
                        <h2>Reporte Documentos Credito Directo: </h2>
                    </center>
                </h3>
        </table>

        <table border=1 cellpadding=5 cellspacing=1 width=1000>

            <td>
                <center>
                    <!-- 
<FORM METHOD="POST" ACTION="reporte_menu2.php" onsubmit="return consulta()">
 -->
                    <FORM METHOD="POST" ACTION="rep_creditos.php" onsubmit="return consulta()">
                        <!--- // aqui meto lo de la fecha --->
                        <!-- 
<input type="checkbox" name="selec_fechas" value="1" onclick="if (this.checked) {activafechas(1)} else {activafechas(0)}">
 -->

                        
                        Entre fechas: &nbsp&nbsp

                        <!-- <script>DateInput('fecha1', true, 'YYYY/MM/DD')
DateInput('fecha2', true, 'YYYY/MM/DD')</script> -->
                        <input type="date" name="fecha1" step="1" min="2020-05-01" max="2025-12-31"
                            value="<?php echo date("Y-m-d"); ?>">
                        <input type="date" name="fecha2" step="1" min="2020-05-01" max="2025-12-31"
                            value="<?php echo date("Y-m-d"); ?>">
            </td>
            <!-- </Form> -->
            </tr>


            <td colspan="1"><br>
                <center>
                    <input type="submit" name="Buscar" value="Generar reporte" class="btn btn-sm btn-primary"></form>
                    <br><br>



        </table>



        </table>




</BODY>

</HTML