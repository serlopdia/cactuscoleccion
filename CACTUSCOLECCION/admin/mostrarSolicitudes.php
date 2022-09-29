<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarSolicitudes.php");
	require_once("paginacionSolicitudes.php");
	
	 if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}
	
	if (isset($_SESSION["solicitud"])){
		$solicitud = $_SESSION["solicitud"];
		unset($_SESSION["solicitud"]);
	}

	if (isset($_SESSION["paginacion"])) 
	$paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 4);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	$query = "SELECT * FROM SOLICITUDES ORDER BY OID_SOLICITUD";

	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++;
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);
	$empleados = consultarEmpleados($conexion);

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
	<script type="text/javascript" src="../js/validacionSolicitud.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
    <div class="main_content">
	    <div class="header">Datos de envío</div> 
	        <div class="info">
				<table border="2">
					<tr>
						<th height="80px" width="75px">ID Solicitud</th>
						<th height="80px" width="280px">Dirección</th>
						<th height="80px" width="260px">Nombre</th>
						<th height="80px" width="200px">Teléfono</th>
						<th height="80px" width="75px">ID Pedido </th>
						<th height="80px" width="75px">ID Empleado</th>
						<th height="80px" width="120px">Tipo</th>
					</tr>
				</table>
		        <!--AQUI VA EL CONTENIDO-->
				
					<?php
						foreach($filas as $fila) {
					?>			
					<article class="solicitud">
						<form method="post" action="validacion_solicitud.php">
							<div class="fila_solicitud">
								<div class="solicitudDatos">
									
								<input name="OID_SOLICITUD" type="hidden" value="<?php echo $fila["OID_SOLICITUD"]; ?>"/>
								<input name="DIRECCION" type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
								<input name="NOMBRE_DESTINATARIO" type="hidden" value="<?php echo $fila["NOMBRE_DESTINATARIO"]; ?>"/>
								<input name="TELEFONO" type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
								<input name="TIPO" type="hidden" type="hidden" value="<?php echo $fila["TIPO"]; ?>"/>
								<input name="OID_PEDIDO" type="hidden" value="<?php echo $fila["OID_PEDIDO"]; ?>"/>
								<input name="OID_EMPLEADO" type="hidden" value="<?php echo $fila["OID_EMPLEADO"]; ?>"/>
						
							<?php
						if ( isset($solicitud) and ($solicitud["OID_SOLICITUD"] == $fila["OID_SOLICITUD"])) { ?>
					<fieldset class="direccionEnvio" name="Nueva solicitud">
						<legend>Modificando solicitud</legend>

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
							<input id="OID_SOLICITUD" name="OID_SOLICITUD" type="HIDDEN" size="150" value="<?php echo $solicitud["OID_SOLICITUD"]; ?>" />
						</div>
						
						<div><label for="DIRECCION">Dirección</label>
							<input id="DIRECCION" name="DIRECCION" type="text" size="150"  minlength="10" maxlength="256"  value="<?php echo $solicitud["DIRECCION"]; ?>" required/>
						</div><span ><div id="error1"></div></span>
						
						<div><label for="NOMBRE_DESTINATARIO">Nombre del destinatario</label>
							<input id="NOMBRE_DESTINATARIO" name="NOMBRE_DESTINATARIO" type="text" size="150"  minlength="10" maxlength="15" value="<?php echo $solicitud["NOMBRE_DESTINATARIO"]; ?>" required/>
						</div><span ><div id="error2"></div></span>
						
						<div><label for="TELEFONO">Teléfono</label>
							<input id="TELEFONO" name="TELEFONO" type="tel" size="146" value="<?php echo $solicitud["TELEFONO"]; ?>" required/>
						</div><span ><div id="error3"></div></span>
						
						<div><label for="TIPO">Tipo</label>
							<input list="opcionesTipo" id="TIPO" name="TIPO" type="text" size="154" minlength="9" maxlength="11" value="<?php echo $solicitud["TIPO"]; ?>" required/>
							<datalist id="opcionesTipo">
								<option value="CERTIFICADA">Envío CERTIFICADO</option>
								<option value="ORDINARIA">Envío ORDINARIO</option>
							</datalist>
						</div> <span ><div id="error4"></div></span>
						
						<div><label for="OID_PEDIDO">ID Pedido</label>
							<input id="OID_PEDIDO" name="OID_PEDIDO" type="number" size="153" maxlength="7" value="<?php echo $solicitud["OID_PEDIDO"]; ?>" required readonly/>
						</div> <span ><div id="error5"></div></span>
						
						<div><label for="OID_EMPLEADO">ID Empleado</label>
								<input id="OID_EMPLEADO" list="opcionesEmpleado" name="OID_EMPLEADO" type="number" size="146" maxlength="7" value="<?php echo $solicitud["OID_EMPLEADO"]; ?>" />
								<datalist id="opcionesEmpleado">
								<?php foreach($empleados as $empleado){ ?>
									<option value="<?php echo $empleado["OID_EMPLEADO"]?>"><?php echo $empleado["NOMBRE"]?></option>
								<?php	} ?>
								</datalist>
							</div>	<div id="error6"></div>
						
						<input id="grabar" class="actualizar" name="grabar" onsubmit="return validarSolicitud()" type="submit" value="Actualizar envio"/>

					</fieldset>
					
								<?php }	else { ?>
									
									<table>
										<tr>	
											<td class="OID_SOLICITUD" height="80px" width="75px"><b><?php echo $fila["OID_SOLICITUD"]; ?></b></td>
											
											<td class="DIRECCION" height="80px" width="300px"><b><?php echo $fila["DIRECCION"]; ?></b></td>
											
											<td class="NOMBRE_DESTINATARIO" height="80px" width="270px"><b><?php echo $fila["NOMBRE_DESTINATARIO"]; ?></b></td>
												
											<td class="TELEFONO" height="80px" width="200px"><b><?php echo $fila["TELEFONO"]; ?></b></td>
											
											<td class="OID_PEDIDO" height="80px" width="75px"><b><?php echo $fila["OID_PEDIDO"]; ?></b></td>
											
											<td class="OID_EMPLEADO" height="80px" width="60px"><b><?php echo $fila["OID_EMPLEADO"]; ?></b></td>	
																		
											<td class="TIPO" height="80px" width="75px"><b><?php echo $fila["TIPO"]; ?></b></td>
										
											<div id="botones_fila">
												<td><button id="editar" name="editar" type="submit" style="width: 35px; height: 35px;" class="editar_fila">			
													<i class="fas fa-pencil-alt" alt="Editar producto"></i>			
												</button></td>
		
											</div>
										
										</tr>	
									<?php } ?>									
								</table>		
								</div>
							</div>
						</form>
					</article>			
					<?php } ?>				
					<div id="enlaces">
						<?php
							for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
								if ( $pagina == $pagina_seleccionada) { 	?>
									<span class="current"><?php echo $pagina; ?></span>
						<?php }	else { ?>
									<a href="mostrarSolicitudes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
						<?php } ?>
					</div>
				
		</div>
	</div>
    </div>
</div>
</body>
</html>