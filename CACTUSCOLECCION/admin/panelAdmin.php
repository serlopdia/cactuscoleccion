<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarPedidos.php");	
	
	if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}

	if(isset($_SESSION["pedido_seleccionado"])){
		$pedido = $_SESSION["pedido_seleccionado"];
		header("Location: mostrarPedido.php");
	}
	
	$conexion = crearConexionBD();
	$filasPendientes = consultarPedidosPendientes($conexion);	
	$filasRealizados = consultarPedidosRealizados($conexion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mis pedidos</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
    <div class="main_content">
    <div class="header">Panel de Administrador</div> 
        <div class="info">
        	<fieldset>
					<legend>Pedidos pendientes</legend>
					<div class="divPendientes">
						<table>
							<tr>
								<th>Identificador del pedido</th>
								<th>Fecha</th>
								<th>Dirección</th>
								<th>Pais</th>
								<th>Precio total</th>
								<th>Código postal</th>
								<th>Estado pedido</th>
								<th>Identificador del cliente</th>
							</tr>
					<?php
						foreach($filasPendientes as $filaPendiente) {
					?>
						<tr>											
							<input id="OID_PEDIDO" type="hidden" value="<?php echo $filaPendiente["OID_PEDIDO"]; ?>"/>
							<input id="FECHA" type="hidden" value="<?php echo $filaPendiente["FECHA"]; ?>"/>
							<input id="DIRECCION" type="hidden" value="<?php echo $filaPendiente["DIRECCION"]; ?>"/>
							<input id="PAIS" type="hidden" value="<?php echo $filaPendiente["PAIS"]; ?>"/>
							<input id="PRECIO_TOTAL" type="hidden" value="<?php echo $filaPendiente["PRECIO_TOTAL"]; ?>"/>
							<input id="CODIGO_POSTAL" type="hidden" value="<?php echo $filaPendiente["CODIGO_POSTAL"]; ?>"/>
							<input id="ESTADO_PEDIDO" type="hidden" value="<?php echo $filaPendiente["ESTADO_PEDIDO"]; ?>"/>
							<input id="OID_CLIENTE" type="hidden" value="<?php echo $filaPendiente["OID_CLIENTE"]; ?>"/>
							
							<td style="text-align: center"><?php echo $filaPendiente["OID_PEDIDO"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["FECHA"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["DIRECCION"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["PAIS"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["PRECIO_TOTAL"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["CODIGO_POSTAL"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["ESTADO_PEDIDO"]; ?></td>
							<td style="text-align: center"><?php echo $filaPendiente["OID_CLIENTE"]; ?></td>
							
							<td style="padding-right: 10px"><button id="mas_info" name="mas_info" type="submit" class="mas_informacion">	
							<a href="mostrarPedido.php?OID_PEDIDO=<?php echo $filaPendiente["OID_PEDIDO"]?>"><i class="fas fa-ellipsis-v"></button></td>
									
							<td><button id="añadirSolicitud" name="mas_info" type="submit" class="añadirSolicitud">	
							<a href="formSolicitud.php?OID_PEDIDO=<?php echo $filaPendiente["OID_PEDIDO"]?>"><i class="fas fa-plus"></button></td>
						</tr>
					<?php } ?>
					</table>
					</div>
				</fieldset>				
				
				<fieldset>
					<legend>Pedidos realizados</legend>
					<div class="divRealizados">
						<table>
							<tr>
								<th>Identificador del pedido</th>
								<th>Fecha</th>
								<th>Dirección</th>
								<th>Pais</th>
								<th>Precio total</th>
								<th>Código postal</th>
								<th>Estado pedido</th>
								<th>Identificador del cliente</th>
							</tr>
					<?php
						foreach($filasRealizados as $filaRealizado) {
					?>
					<tr><input id="OID_PEDIDO" type="hidden" value="<?php echo $filaRealizado["OID_PEDIDO"]; ?>"/>
						<input id="FECHA" type="hidden" value="<?php echo $filaRealizado["FECHA"]; ?>"/>
						<input id="DIRECCION" type="hidden" value="<?php echo $filaRealizado["DIRECCION"]; ?>"/>
						<input id="PAIS" type="hidden" value="<?php echo $filaRealizado["PAIS"]; ?>"/>
						<input id="PRECIO_TOTAL" type="hidden" value="<?php echo $filaRealizado["PRECIO_TOTAL"]; ?>"/>
						<input id="CODIGO_POSTAL" type="hidden" value="<?php echo $filaRealizado["CODIGO_POSTAL"]; ?>"/>
						<input id="ESTADO_PEDIDO" type="hidden" value="<?php echo $filaRealizado["ESTADO_PEDIDO"]; ?>"/>
						<input id="OID_CLIENTE" type="hidden" value="<?php echo $filaRealizado["OID_CLIENTE"]; ?>"/>
						
							<td style="text-align: center"><?php echo $filaRealizado["OID_PEDIDO"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["FECHA"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["DIRECCION"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["PAIS"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["PRECIO_TOTAL"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["CODIGO_POSTAL"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["ESTADO_PEDIDO"]; ?></td>
							<td style="text-align: center"><?php echo $filaRealizado["OID_CLIENTE"]; ?></td>
							
							<td style="padding-right: 10px"><button id="mas_info" name="mas_info" type="submit" class="mas_informacion">	
							<a href="mostrarPedido.php?OID_PEDIDO=<?php echo $filaRealizado["OID_PEDIDO"]?>"><i class="fas fa-ellipsis-v"></button></td>
						</tr>	
						<?php } ?>								
					</table>
					
					</div>	
					</fieldset>
					
					</div>
      			</div>
   		 </div>
    </div>

	<?php
		cerrarConexionBD($conexion);
	?>

</body>
</html>