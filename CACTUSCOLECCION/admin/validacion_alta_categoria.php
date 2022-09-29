<?php
	session_start();
	require_once("../gestionBD.php");
	require_once("gestionarProductos.php");
	
	if (isset($_REQUEST["NOMBRE_CAT"])) {
		$nuevaCategoria["NOMBRE_CAT"] = $_REQUEST["NOMBRE_CAT"];
		
		$_SESSION["categoria"] = $nuevaCategoria;
	}
	else {
		Header("Location: formCategorias.php");
	}
		$conexion = crearConexionBD(); 		
		$errores = validarDatosCategoria($conexion, $nuevaCategoria);
		cerrarConexionBD($conexion);
		
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formCategorias.php');
	}else{
			$conexion = crearConexionBD(); 

		if (!crear_categoria($conexion, $nuevaCategoria)) {
			$_SESSION["categoria"] = $nuevaCategoria;
			$_SESSION["categoria"]=NULL;
			Header('Location: mostrarProductos.php');
		}else{
			$errores[] = "<p>La categoria ya existe ¡Inténtelo de nuevo!</p>";
			$_SESSION["errores"] = $errores;
			Header('Location: formCategorias.php');
		}
		cerrarConexionBD($conexion);
	}
	
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de categoria
	///////////////////////////////////////////////////////////	
	function validarDatosCategoria($conexion, $nuevaCategoria){
		$errores=array();		
		//Validación de nombre
		if($nuevaCategoria["NOMBRE_CAT"]==""){
			$errores[] = "<p>El nombre no puede estar vacío.</p>";
		}else if(strlen($nuevaCategoria["NOMBRE_CAT"])>40){
			$errores[] = "<p>El nombre debe ser mas corto.</p>";
		}

		return $errores;
	}
?>