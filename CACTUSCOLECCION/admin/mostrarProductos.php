<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarProductos.php");
	
if (!isset($_SESSION["login_admin"])) {
	header("Location: ../access/login-admin.php");
}
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
	}
		$conexion = crearConexionBD();
		$consulta= consultarProductos($conexion);
		$categorias = obtenerCategorias($conexion);
		
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
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="../js/validacionProducto.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
		<div class="main_content">
			<div class="header">Productos</div>
				
					<div class="info">
						<div><a href="formProductos.php"><input id="insertarF" class="insertarFormProd" type="button" value="Crear producto"></a>
						<a href="formCategorias.php"><input id="insertarF2" class="insertarFormProd" type="button" value="Crear nueva categoria"></a></div>	
			        
						<table border="2">
							<tr>
								<th height="80px" width="110px">Imagen</th>
								<th height="80px" width="280px">Nombre</th>
								<th height="80px" width="260px">Descripción</th>
								<th height="80px" width="90px">Tamaño</th>
								<th height="80px" width="90px">Stock</th>
								<th height="80px" width="90px">Precio</th>
								<th height="80px" width="120px">Categoria</th>
							</tr>
						</table>
			<main>
				<?php 
				foreach($consulta as $fila){
					?>
					<form method="post" action="controladorProductos.php">
						<div class="fila_producto">
							<div class="productoDatos">
								<input name="OID_PRODUCTO" type="hidden" value="<?php echo $fila["OID_PRODUCTO"]; ?>"/>
								<input name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
								<input name="TAMAÑO" type="hidden" value="<?php echo $fila["TAMAÑO"]; ?>"/>
								<input name="DESCRIPCION" type="hidden" value="<?php echo $fila["DESCRIPCION"]; ?>"/>
								<input name="STOCK" type="hidden" value="<?php echo $fila["STOCK"]; ?>"/>
								<input name="PRECIO" type="hidden" value="<?php echo $fila["PRECIO"]; ?>"/>
								<input name="NOMBRE_CAT" type="hidden" value="<?php echo $fila["NOMBRE_CAT"]; ?>"/>
								<input name="IMAGEN" type="hidden" value="<?php echo $fila["IMAGEN"]; ?>"/>
								<input name="OID_CATEGORIA" type="hidden" value="<?php echo $fila["OID_CATEGORIA"]; ?>"/>
								
					<?php
					if (isset($producto) and ($producto["OID_PRODUCTO"] == $fila["OID_PRODUCTO"])) { ?>
					<fieldset class="nuevoProducto" name="Nuevo producto">
						<legend>Modificando producto</legend>
					<?php 
					// Mostrar los erroes de validación (Si los hay)
					if (isset($errores) && count($errores)>0) { 
				    	echo "<div id=\"div_errores\" class=\"error\">";
						echo "<h4> Errores en el formulario:</h4>";
    					foreach($errores as $error){
    						echo $error;
						} 
    					echo "</div>";
  					}
					?>	
						<div>
							<input id="OID_PRODUCTO" name="OID_PRODUCTO" type="HIDDEN" size="150" value="<?php echo $producto["OID_PRODUCTO"]; ?>" />
						</div>

						<div><label for="NOMBRE">Nombre: </label>
							<input id="NOMBRE" name="NOMBRE" type="text" size="150" maxlenght="40" value="<?php echo $producto["NOMBRE"]; ?>" />
						</div>	<span><div id="error1"></div></span>
						
						<div><label for="TAMAÑO">Tamaño: </label>
							<input id="TAMAÑO" name="TAMAÑO" type="text" size="150" maxlenght="9" value="<?php echo $producto["TAMAÑO"]; ?>" />
						</div>	<span><div id="error2"></div></span>
						
						<div><label for="DESCRIPCION">Descripción: </label>
							<input id="DESCRIPCION" name="DESCRIPCION" type="text" size="146" maxlenght="100" value="<?php echo $producto["DESCRIPCION"]; ?>" />
						</div>	<span><div id="error3"></div></span>
						
						<div><label for="STOCK">Stock: </label>
							<input id="STOCK" name="STOCK" type="text" size="154" value="<?php echo $producto["STOCK"]; ?>"/>
						</div>	<span><div id="error4"></div></span>
						
						<div><label for="PRECIO">Precio: </label>
							<input id="PRECIO" name="PRECIO" type="text" size="153" value="<?php echo $producto["PRECIO"]; ?>" />
						</div>	<span><div id="error5"></div></span>
						
						<div><label for="IMAGEN">Imagen: </label>
							<input id="IMAGEN" name="IMAGEN" type="url" size="153" maxlenght="300" value="<?php echo $producto["IMAGEN"]; ?>" />
						</div>	<span><div id="error6"></div></span>
						
						<div><label for="OID_CATEGORIA">Categoria:</label>
							<input list="opcionesCategoria" id="OID_CATEGORIA" name="OID_CATEGORIA" type="number" size="146" maxlenght="7" value="<?php echo $producto["OID_CATEGORIA"]; ?>"/>
								<datalist id="opcionesCategoria">
								<?php foreach($categorias as $categoria){
									?>
									<option value="<?php echo $categoria["OID_CATEGORIA"]?>"><?php echo $categoria["NOMBRE_CAT"]?></option>
							<?php	} ?>
								</datalist>
						</div>	<span><div id="error7"></div></span>
						<input id="grabar" class="actualizar" name="grabar" type="submit" value="Actualizar producto"/>
					<!--	<a href="mostrarProductos.php"><input style="float: right" class="actualizar" value="Cancelar actualización" /></a> -->

					</fieldset>

									<?php }else { ?>
							<table>
								<tr>			
									<td class="IMAGEN" height="80px" width="110px"><img height="100px" width="110px" src="<?php echo $fila["IMAGEN"]; ?>"></td>
									<td class="NOMBRE" height="80px" width="280px" style="text-align: center"><b><?php echo $fila["NOMBRE"]; ?></b></td>
									<td class="DESCRIPCION" height="80px" width="260px"><b><?php echo $fila["DESCRIPCION"]; ?></b></td>
									<td class="TAMAÑO" height="80px" width="90px" style="text-align: center"><b><?php echo $fila["TAMAÑO"]; ?></b></td>
									<td class="STOCK" height="80px" width="90px" style="text-align: center"><b><?php echo $fila["STOCK"]; ?></b></td>
									<td class="PRECIO" height="80px" width="90px" style="text-align: center"><b><?php echo $fila["PRECIO"]; ?></b></td>
									<td class="NOMBRE_CAT" height="80px" width="120px" style="text-align: center"><b><?php echo $fila["NOMBRE_CAT"]; ?></b></td>
									
									<div id="botones_fila">
										<td><button id="editar" name="editar" type="submit" style="width: 35px; height: 35px;" class="editar_fila">			
									<i class="fas fa-pencil-alt" alt="Editar producto"></i>			
										</button></td>

										<td><button id="borrar" name="borrar" type="submit" style="width: 35px; height: 35px;" class="editar_fila">			
									<i class="fas fa-trash-alt" alt="Borrar producto"></i>			
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
    <?php
		cerrarConexionBD($conexion);
	?>
    </div>
  
</body>
</html>