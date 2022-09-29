<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarSolicitudes.php");
	require_once("gestionarPedidos.php");
	
	if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}

	$conexion = crearConexionBD();
	
	if(isset($_GET["OID_PEDIDO"])){
		$pedido_a_enviar = obtenerPedidoPorId($conexion, $_GET["OID_PEDIDO"]);
		$pedido = $pedido_a_enviar->fetch(PDO::FETCH_BOTH);

		$solicitud["OID_SOLICITUD"] = "";
		$solicitud["DIRECCION"] = $pedido["DIRECCION"];
		$solicitud["NOMBRE_DESTINATARIO"] = "";
		$solicitud["TELEFONO"] = "";
		$solicitud["OID_PEDIDO"] = $pedido["OID_PEDIDO"];
		$solicitud["OID_EMPLEADO"] = "";
		$solicitud["TIPO"] = "";
		
		unset($pedido);
		$_SESSION["solicitud"] = $solicitud;
		$_SESSION['errores'] = null;
		$_SESSION['exito'] = null;
	} else {
		if (!isset($_SESSION["solicitud"])) {
			$solicitud["OID_SOLICITUD"] = "";
			$solicitud["DIRECCION"] = "";
			$solicitud["NOMBRE_DESTINATARIO"] = "";
			$solicitud["TELEFONO"] = "";
			$solicitud["OID_PEDIDO"] = "";
			$solicitud["OID_EMPLEADO"] = "";
			$solicitud["TIPO"] = "";
		
			$_SESSION["solicitud"] = $solicitud;
			$_SESSION['errores'] = null;
			$_SESSION['exito'] = null;
		}
		else
			$solicitud = $_SESSION["solicitud"];
	}	
		$empleados = consultarEmpleados($conexion);
	if (isset($_SESSION["errores"]))
	$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cactus Colección</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="../js/validacionSolicitud.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
		<div class="main_content">
			<div class="header">Datos de envío</div> 
				<div class="info">

					<?php
						if (isset($errores) && count($errores) > 0) {
							echo "<div id=\"div_errores\" class=\"error\">";
							echo "<h4> Errores en el formulario:</h4>";
							foreach ($errores as $error)
								echo $error;
							echo "</div>";
						}
					?>
					
					<form method="post" id="formSolicitud" action="validacion_solicitud.php" class="insertarSolicitud">
						<fieldset class="direccionEnvio" name="Dirección de envío">
							<legend>Nueva Solicitud</legend>
							
							<div>
								<input id="OID_SOLICITUD" name="OID_SOLICITUD" type="hidden" size="150" value="<?php echo $solicitud["OID_SOLICITUD"]; ?>" />
							</div>
							
							<div><label for="DIRECCION">Dirección</label>
								<input id="DIRECCION" name="DIRECCION" type="text" size="146"  minlength="10" maxlength="256" value="<?php echo $solicitud["DIRECCION"]; ?>" readonly />
							</div>	<div id="error1"></div>
							
							<div><label for="NOMBRE_DESTINATARIO">Nombre del destinatario</label>
								<input id="NOMBRE_DESTINATARIO" name="NOMBRE_DESTINATARIO" type="text" size="125"  minlength="10" maxlength="15" value="<?php echo $solicitud["NOMBRE_DESTINATARIO"]; ?>" />
							</div>	<div id="error2"></div>
							
							<div><label for="TELEFONO">Teléfono </label>
								<input id="TELEFONO" name="TELEFONO" type="tel" size="146" value="<?php echo $solicitud["TELEFONO"]; ?>" />
							</div>	<div id="error3"></div>
							
							<div><label for="TIPO">Tipo</label>
								<input list="opcionesTipo" id="TIPO" name="TIPO" type="text" size="155" minlength="9" maxlength="11" value="<?php echo $solicitud["TIPO"]; ?>" />
									<datalist id="opcionesTipo">
										<option value="CERTIFICADA">Envío CERTIFICADO</option>
										<option value="ORDINARIA">Envío ORDINARIO</option>
									</datalist>
							</div>	<div id="error4"></div>
							
							<div><label for="OID_PEDIDO">ID Pedido</label>
								<input id="OID_PEDIDO" name="OID_PEDIDO" type="number" size="146" maxlength="7"  value="<?php echo $solicitud["OID_PEDIDO"]; ?>" readonly/>
							</div>	<div id="error5"></div>
							
							<div><label for="OID_EMPLEADO">ID Empleado</label>
								<input id="OID_EMPLEADO" list="opcionesEmpleado" name="OID_EMPLEADO" type="number" size="146" maxlength="7" value="<?php echo $solicitud["OID_EMPLEADO"]; ?>" />
								<datalist id="opcionesEmpleado">
								<?php foreach($empleados as $empleado){ ?>
									<option value="<?php echo $empleado["OID_EMPLEADO"]?>"><?php echo $empleado["NOMBRE"]?></option>
								<?php	} ?>
								</datalist>
							</div>	<div id="error6"></div>
							
						</fieldset>
						<input id="insertar" class="insertar" name="insertar" type="submit" value="Crear solicitud"/>
					</form>
	<?php
		cerrarConexionBD($conexion);
	?>
				</div>
 		</div>
    </div>
</body>
</html>