<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarPagos.php");


if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}

	if (isset($_SESSION["pago"])) {
		$pago = $_SESSION["pago"];
		unset($_SESSION["pago"]);
	}

	$conexion = crearConexionBD();
	$consulta= consultarPagos($conexion);
	cerrarConexionBD($conexion);	
	
	if (isset($_SESSION["errores"])){
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
	}
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
	<script type="text/javascript" src="../js/validacionPago.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
		<div class="main_content">
			<div class="header">Pagos</div>
			        <div class="info">
						<table border="2">
							<tr>
								<th height="80px" width="75px">Identificador</th>
								<th height="80px" width="100px">Cantidad</th>
								<th height="80px" width="210px">Fecha del pago</th>
								<th height="80px" width="230px">Estado del pago</th>
								<th height="80px" width="270px">Tipo de pago</th>
								<th height="80px" width="75px">Identificador pedido</th>
							</tr>
						</table>
			<main>
				<?php 
				foreach($consulta as $fila){ 
					?>
					<form method="post" id="formPago" action="validacion_pago.php">
						<div class="fila_pago">
							<div class="pagoDatos">

								<input name="OID_PAGO" type="hidden" value="<?php echo $fila["OID_PAGO"]; ?>"/>
								<input name="CANTIDAD" type="hidden" value="<?php echo $fila["CANTIDAD"]; ?>"/>
								<input name="FECHA_PAGO" type="hidden" value="<?php echo $fila["FECHA_PAGO"]; ?>"/>
								<input name="ESTADO_PAGO" type="hidden" value="<?php echo $fila["ESTADO_PAGO"]; ?>"/>
								<input name="TIPO_PAGO" type="hidden" value="<?php echo $fila["TIPO_PAGO"]; ?>"/>
								<input name="OID_PEDIDO" type="hidden" value="<?php echo $fila["OID_PEDIDO"]; ?>"/>
								
					<?php
					if (isset($pago) and ($pago["OID_PAGO"] == $fila["OID_PAGO"])) { ?>
					<fieldset class="nuevoPago" name="Nuevo pago">
						<legend>Modificando pago</legend>

						<?php
							if (isset($errores) && count($errores) > 0) {
								echo "<div id=\"div_errores\" class=\"error\">";
								echo "<h4> Errores en el formulario:</h4>";
								foreach ($errores as $error)
									echo $error;
								echo "</div>";
							}
						?>
						
						<div>
							<input id="OID_PAGO" name="OID_PAGO" type="hidden" value="<?php echo $pago["OID_PAGO"]; ?>"/>
						</div>
						
						<div><label for="CANTIDAD">Cantidad</label>
							<input id="CANTIDAD" name="CANTIDAD" type="text" size="150" pattern="/^\d+(\d{3})*(\,\d{1,2})?$/" value="<?php echo $pago["CANTIDAD"]; ?>" readonly required/>
						</div>	<div id="error1"></div>
						
						<div><label for="FECHA_PAGO">Fecha del pago</label>
							<input id="FECHA_PAGO" name="FECHA_PAGO" type="text" size="150" pattern="/^\d{1,2}\/\d{1,2}\/\d{2,4}$/" value="<?php echo $pago["FECHA_PAGO"]; ?>" readonly required/>
						</div>	<div id="error2"></div>
						
						<div><label for="ESTADO_PAGO">Estado del pago</label>
							<input list="opcionesEstado" id="ESTADO_PAGO" name="ESTADO_PAGO" type="text" size="146" value="<?php echo $pago["ESTADO_PAGO"]; ?>" required/>
							<datalist id="opcionesEstado">
							  	<option value="PENDIENTE">PENDIENTE</option>
								<option value="REALIZADO">REALIZADO</option>
							</datalist>
						</div>	<div id="error3"></div>
						
						<div><label for="TIPO_PAGO">Tipo del pago</label>
							<input list="opcionesTipo" id="TIPO_PAGO" name="TIPO_PAGO" type="text" size="154" value="<?php echo $pago["TIPO_PAGO"]; ?>" readonly required/>
							<datalist id="opcionesTipo">
							  	<option value="PAYPAL">PAYPAL</option>
								<option value="TRANSFERENCIA">TRANSFERENCIA</option>
								<option value="CONTRA REEMBOLSO">CONTRA REEMBOLSO</option>
							</datalist>
						</div>	<div id="error4"></div>
						
						<div><label for="OID_PEDIDO">ID Pedido</label>
							<input id="OID_PEDIDO" name="OID_PEDIDO" type="text" size="153" pattern="/^\d+$/" value="<?php echo $pago["OID_PEDIDO"]; ?>" readonly required/>
						</div>	<div id="error5"></div>
						
						<input id="grabar" class="actualizar" name="grabar" type="submit" value="Actualizar pago"/>

					</fieldset>

									<?php }else { ?>
							<table>
								<tr>
									<td class="OID_PAGO" name="OID_PAGO" height="30px" width="350px"><b><?php echo $fila["OID_PAGO"]; ?></b></td>
									<td class="CANTIDAD" name="CANTIDAD" height="30px" width="350px"><b><?php echo $fila["CANTIDAD"]; ?></b></td>
									<td class="FECHA_PAGO" name="FECHA_PAGO" height="30px" width="500px"><b><?php echo $fila["FECHA_PAGO"]; ?></td>
									<td class="ESTADO_PAGO" name="ESTADO_PAGO" height="30px" width="500px"><b><?php echo $fila["ESTADO_PAGO"]; ?></td>
									<td class="TIPO_PAGO" name="TIPO_PAGO" height="30px" width="500px"><b><?php echo $fila["TIPO_PAGO"]; ?></td>
									<td class="OID_PEDIDO" name="OID_PEDIDO" height="30px" width="500px"><b><?php echo $fila["OID_PEDIDO"]; ?></td>
									
									<div id="botones_fila">
										<td><button id="editar" name="editar" type="submit" style="width: 35px; height: 35px;" class="editar_fila">			
											<i class="fas fa-pencil-alt" alt="Editar pago"></i>			
										</button></td>

									</div>
								</tr>
								<?php } ?>
							</table>
							</div>
						</div>
					</form>
				<?php }  ?>
			</main>
 					</div>
    	</div>
</body>
</html>