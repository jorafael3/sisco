<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<HTML>

<HEAD>

	<script type="text/javascript">
		function setfocus() {
			document.getElementById("myusername").focus();
		}
	</script>
	<meta name="viewport" content="width=device-width, height=device-height">

	<title>Sistema SISCO</title>
</head>

<?php
session_start();
$usuario = $_POST['usuario'];
$password = MD5($_POST['password']);
$nivel = $_POST['nivel'];
$canal = $_POST['canal'];
echo $canal;
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$bodega = $_POST['bodega'];
$provincia = $_POST['provincia'];





if (!isset($_SESSION["usuario"])) {
	header("Location: index1.php");
}
include("../barramenu.php");
//if ($_SESSION["nivel"]=='10'){die( "<br><br><h2>No tiene acceso a esta opción!</h2>");}
?>


<BODY>
	</br>


	<BODY onload="setfocus()">


		<center>
			<br><br><br><br><br>
			<table border=1 cellpadding=5 cellspacing=1 width=400>


				<td>
					<Center><img src="../logo.png" height="100" width="220"></Center>
				</td>
				<td>
					<h3>Ingrese datos de <br>SUPERVISOR </h3>
				</td>
				<tr>

					<Form Action="agrega1b.php" Method="post">
						<!-- <td><left><strong>Transacción:</strong></td>
	<td><Center><Input Size = 10 Maxlenght=10 readonly name="sec" type="text" id="sec" value = "<?php echo $sec ?>"></Center></td></tr> -->
						<td>
							<left><strong>Usuario:</strong>
						</td>
						<td>
							<Center><Input Size=10 Maxlenght=10 name="myusername" type="text" id="myusername"></Center>
						</td>
				</tr>
				<td>
					<left><strong>Contraseña:</strong>
				</td>
				<td>
					<left>
						<Center><Input Size=10 Maxlenght=10 name="mypassword" type="password" id="mypassword"></Center>
				</td>
				</tr>

				<Input Type=hidden Name='u1' value='<?php echo $usuario ?>'>
				<Input Type=hidden Name='p1' value='<?php echo $password ?>'>
				<Input Type=hidden Name='n1' value='<?php echo $nivel ?>'>
				<Input Type=hidden Name='c1' value='<?php echo $canal ?>'>

				<Input Type=hidden Name='nombres' value='<?php echo $nombres ?>'>
				<Input Type=hidden Name='email' value='<?php echo $email ?>'>
				<Input Type=hidden Name='celular' value='<?php echo $celular ?>'>
				<Input Type=hidden Name='bodega' value='<?php echo $bodega ?>'>
				<Input Type=hidden Name='provincia' value='<?php echo $provincia ?>'>

				<td></td>
				<td>
					<Center><Input Type=Submit Value="Continuar"></Center>
				</td>
				</tr>

				</Form>


				</td>
				<tr>





	</BODY>

</HTML>