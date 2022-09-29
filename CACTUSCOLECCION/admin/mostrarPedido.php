<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarPedidos.php");
	
  	if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}
	$conexion = crearConexionBD();

	if (isset($_REQUEST["OID_PEDIDO"])) {
		
		$pedido_a_modificar = obtenerPedidoPorId($conexion, $_REQUEST["OID_PEDIDO"]);
		$arrayPedido = $pedido_a_modificar->fetch(PDO::FETCH_BOTH);
		$_SESSION["pedido_a_modificar"] = $arrayPedido;
	}
	
	$pedido_seleccionado = obtenerPedidoPorId($conexion, $_REQUEST["OID_PEDIDO"]);
	cerrarConexionBD($conexion);

	if (isset($_SESSION["errores"]))
	$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cactus Colección</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
	
		<div class="main_content">
			<div class="header">Datos del pedido</div>
			   <div class="info">

					<table border="2">
							<tr>
								<th height="80px" width="110px">Id del pedido</th>
								<th height="80px" width="110px">Fecha</th>
								<th height="80px" width="250px">Dirección</th>
								<th height="80px" width="110px">Pais</th>
								<th height="80px" width="110px">Precio total</th>
								<th height="80px" width="110px">Código postal</th>
								<th height="80px" width="110px">Estado pedido</th>
								<th height="80px" width="110px">Id del cliente</th>
								
							</tr>
					</table>
					<table>
						<?php
						foreach($pedido_seleccionado as $atributo) {
						?>
						<form method="post" action="modificarPedido.php?">
							<div class="fila_pedido">
								<div class="pedidoDatos">
									<input id="OID_PEDIDO" type="hidden" value="<?php echo $atributo["OID_PEDIDO"]; ?>"/>
									<input id="FECHA" type="hidden" value="<?php echo $atributo["FECHA"]; ?>"/>
									<input id="DIRECCION" type="hidden" value="<?php echo $atributo["DIRECCION"]; ?>"/>
									<input id="PAIS" type="hidden" value="<?php echo $atributo["PAIS"]; ?>"/>
									<input id="PRECIO_TOTAL" type="hidden" value="<?php echo $atributo["PRECIO_TOTAL"]; ?>"/>
									<input id="CODIGO_POSTAL" type="hidden" value="<?php echo $atributo["CODIGO_POSTAL"]; ?>"/>
									<input id="ESTADO_PEDIDO" type="hidden" value="<?php echo $atributo["ESTADO_PEDIDO"]; ?>"/>
									<input id="OID_CLIENTE" type="hidden" value="<?php echo $atributo["OID_CLIENTE"]; ?>"/>
					
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["OID_PEDIDO"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["FECHA"]; ?></td>
									<td height="80px" width="250px" style="text-align: center"><?php echo $atributo["DIRECCION"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["PAIS"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["PRECIO_TOTAL"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["CODIGO_POSTAL"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["ESTADO_PEDIDO"]; ?></td>
									<td height="80px" width="110px" style="text-align: center"><?php echo $atributo["OID_CLIENTE"]; ?></td>
								</tr>

								<tr>
								
									
								</tr>

							<?php } ?>							
						</table>
						</div>
					</div>
				</form>
    	</div>
	</div>
	</div>
</body>
</html>