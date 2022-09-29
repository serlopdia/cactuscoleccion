<?php
	
   session_start();
   require_once ("gestionBD.php");
   require_once ("gestionarCesta.php");
   
  
   if(!isset($_SESSION["cesta"])|| !$_SESSION["cesta"]){
	   $productos=null;
   }else{
   	$conexion= crearConexionBD();
	$CantidadProducto=array();
	foreach ($_SESSION["cesta"] as $oid) {  
		if(!isset($CantidadProducto[$oid])){
			$CantidadProducto[$oid]=0;
		}
		$CantidadProducto[$oid]++;
	}
	
	$productos = obtenerProductosCesta($conexion,$_SESSION["cesta"]);
	$_SESSION["pedidoDatos"]=array("productos"=> $productos, "cantidades"=>$CantidadProducto);
	
   }
   
   
   
   
   
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cesta de Compra</title>
	</head>
	<body>
		<fieldset>
			<div class="contenedor">
			<h2>Cesta de compra</h2>
			<?php if(is_array($productos)){ ?>
			<table border="2">
							<tr>
								<th height="80px" width="110px"></th>
								<th height="80px" width="110px">Producto</th>
								<th height="80px" width="280px">Precio</th>
								<th height="80px" width="260px">Cantidad</th>
							
							</tr>
							<?php
									foreach ($productos as $producto) { ?>
										<tr>
											<td><img style="height: 80px" src="<?php echo $producto["IMAGEN"] ?>" /> </td>
											<td> <?php echo $producto["NOMBRE"] ?></td>
											<td> <?php echo $producto["PRECIO"] ?></td>
											<td><?php echo $CantidadProducto[$producto["OID_PRODUCTO"]] ?></td>
											<td><form class="eliminar" method="post" action="cestaCompra.php">
												<input type="hidden" name="oid" value='<?php echo $producto["OID_PRODUCTO"]?>'/>
												<input type="hidden" name="oper" value="eliminar" />
												<input type="submit" value="Eliminar">
											</form></td>
												
												
										</tr>
							<?php } ?>
						</table>
						<?php   
							$importe= calcularImporteCesta($productos, $CantidadProducto); ?>
							<p> Importe Total:</p>
							<?php echo $importe ?>
							<?php $_SESSION["importe_total"]=$importe;?> 
						
							<form method="get" action="form_datos_envio.php">
									<input type="submit" value="Pagar"  />
							</form>
						
								<?php }else { ?>
							<p>La cesta aún está vacía.</p>
							<?php }?>
							
							
							<form action="home_page.php">
								<input type="submit" value="Volver" />
							</form>
			
			</div>
		</fieldset>
		<script src="js/vistaCesta.js"></script>
	</body>
</html>