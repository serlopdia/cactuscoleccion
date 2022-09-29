<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarProductos.php");
	
	if (!isset($_SESSION['categoria'])) {
		$categoria["OID_CATEGORIA"] = "";
		$categoria["NOMBRE_CAT"] = "";
		
		$_SESSION["categoria"] = $categoria;
	}
	else
		$categoria = $_SESSION['categoria'];
		$conexion = crearConexionBD();
		
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
	<script type="text/javascript" src="../js/validacionCategoria.js"></script>
	<div class="wrapper"> 
    <?php
    include_once('dashboard.php');
	?>
		<div class="main_content">
			    <div class="header">Datos de la categoria</div> 
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
				<form action="validacion_alta_categoria.php" id="formCategoria" method="post" >
					<fieldset class="nuevoProducto" name="Nueva categoria">
						<legend>Nueva Categoria</legend>
						<div>
							<input id="OID_CATEGORIA" name="OID_CATEGORIA" type="HIDDEN" size="150" value="<?php echo $categoria["OID_CATEGORIA"]; ?>" />
						</div>
						<div><label for="NOMBRE_CAT">Nombre de la categoria: </label>
							<input id="NOMBRE_CAT" name="NOMBRE_CAT" type="text" size="150" value="<?php echo $categoria["NOMBRE_CAT"]; ?>" required/>
						</div> <span><div id="error1"></div></span>
					</fieldset>
					<input id="insertar" class="insertar" name="insertar" type="submit" value="Crear categoria"/>
					</form>
	<?php
		cerrarConexionBD($conexion);
	?>
				</div>
 		</div>
    </div>
</body>
</html>