<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarProductos.php");
	
	if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}
	if (!isset($_SESSION["producto"])) {
		$producto["OID_PRODUCTO"] = "";
		$producto["NOMBRE"] = "";
		$producto["TAMAÑO"] = "";
		$producto["DESCRIPCION"] = "";
		$producto["STOCK"] = "";
		$producto["PRECIO"] = "";
		$producto["IMAGEN"] = "";
		$producto["OID_CATEGORIA"] = "";

	
		$_SESSION["producto"] = $producto;
	}
	else
		$producto = $_SESSION["producto"];
		$conexion = crearConexionBD();
		$consultar = consultarProductos($conexion);
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
			    <div class="header">Datos del producto</div> 
				<div class="info">
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
					<form action="controladorProductos.php" id="formProducto" method="post" novalidation>
					<fieldset class="nuevoProducto" name="Nuevo producto">
						<legend>Nuevo Producto</legend>
						<div>
							<input id="OID_PRODUCTO" name="OID_PRODUCTO" type="HIDDEN" size="150" value="<?php echo $producto["OID_PRODUCTO"]; ?>" />
						</div>

						<div><label for="NOMBRE">Nombre: </label>
							<input id="NOMBRE" name="NOMBRE" type="text" size="150" maxlenght="40" value="<?php echo $producto["NOMBRE"]; ?>" required/>
						</div>
						<span><div id="error1"></div></span>
						
						<div><label for="TAMAÑO">Tamaño: </label>
							<input id="TAMAÑO" name="TAMAÑO" type="text" size="150" maxlenght="9" value="<?php echo $producto["TAMAÑO"]; ?>" required/>
						</div>
						<span><div id="error2"></div></span>

						<div><label for="DESCRIPCION">Descripción: </label>
							<input id="DESCRIPCION" name="DESCRIPCION" type="text" size="146" maxlenght="100" value="<?php echo $producto["DESCRIPCION"]; ?>" required/>
						</div>
						<span><div id="error3"></div></span>

						<div><label for="STOCK">Stock: </label>
							<input id="STOCK" name="STOCK" type="number" size="154" value="<?php echo $producto["STOCK"]; ?>" required/>
						</div><span><div id="error4"></div></span>
						
						<div><label for="PRECIO">Precio: </label>
							<input id="PRECIO" name="PRECIO" type="text" size="153" value="<?php echo $producto["PRECIO"]; ?>" required/>
						</div><span><div id="error5"></div></span>
						
						<div><label for="IMAGEN">Imagen: </label>
							<input id="IMAGEN" name="IMAGEN" type="url" size="153" maxlenght="300" value="<?php echo $producto["IMAGEN"]; ?>" required/>
						</div><span><div id="error6"></div></span>
						
						<div><label for="OID_CATEGORIA">Categoria:</label>
							<input list="opcionesCategoria" id="OID_CATEGORIA" name="OID_CATEGORIA" type="number" size="146" maxlenght="7" value="<?php echo $producto["OID_CATEGORIA"]; ?>" required />
								<datalist id="opcionesCategoria">
								<?php foreach($categorias as $categoria){
									?>
									<option value="<?php echo $categoria["OID_CATEGORIA"]?>"><?php echo $categoria["NOMBRE_CAT"]?></option>
							<?php	} ?>
								</datalist>
						</div>
						<span><div id="error7"></div></span>
					</fieldset>
					<input id="insertar" class="insertar" name="insertar" type="submit" value="Crear producto"/>
					</form>
	<?php
		cerrarConexionBD($conexion);
	?>
				</div>
 		</div>
    </div>
</body>
</html>