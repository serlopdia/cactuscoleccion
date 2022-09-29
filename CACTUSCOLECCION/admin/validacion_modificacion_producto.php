<?php
	session_start();
	require_once("../gestionBD.php");
	require_once("gestionarProductos.php");
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		$nuevoproducto["OID_PRODUCTO"] = $producto["OID_PRODUCTO"];
		$nuevoproducto["NOMBRE"] = $producto["NOMBRE"];
		$nuevoproducto["TAMAÑO"] = $producto["TAMAÑO"];
		$nuevoproducto["DESCRIPCION"] = $producto["DESCRIPCION"];
		$nuevoproducto["STOCK"] = $producto["STOCK"];
		$nuevoproducto["PRECIO"] = $producto["PRECIO"];
		$nuevoproducto["IMAGEN"] = $producto["IMAGEN"];
		$nuevoproducto["OID_CATEGORIA"] = $producto["OID_CATEGORIA"];
		
		$_SESSION["producto"] = $nuevoproducto;
	}
	else {
		Header("Location: mostarProductos.php");
	}
		$conexion = crearConexionBD(); 		
		$errores = validarDatosProducto($conexion, $nuevoproducto);
		cerrarConexionBD($conexion);
		
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: mostrarProductos.php');
	} else {
		Header("Location: modificarProducto.php");
	}
	
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de producto
	///////////////////////////////////////////////////////////	
	function validarDatosProducto($conexion, $nuevoproducto){
		$errores=array();		
		//Validación de nombre
		if($nuevoproducto["NOMBRE"]==""){
			$errores[] = "<p>El nombre no puede estar vacío.</p>";
		}else if(strlen($nuevoproducto["NOMBRE"])<8){
			$errores[] = "<p>El nombre debe tener más de 8 caracteres.</p>";
		}
		
		//Validación de tamaño
		if($nuevoproducto["TAMAÑO"]==""){
			$errores[] = "<p>El tamaño no puede estar vacío.</p>";
		}
		
		//Validación de descripcion
		if($nuevoproducto["DESCRIPCION"]==""){
			$errores[] = "<p>La descripción no puede estar vacía.</p>";
		}else if(strlen($nuevoproducto["DESCRIPCION"])<10){
			$errores[] = "<p>La descripción debe tener más de 10 caracteres.</p>";
		}
		
		//Validación del stock
		if($nuevoproducto["STOCK"]==""){
			$errores[] = "<p>El stock no puede estar vacío.</p>";
		}else if($nuevoproducto["STOCK"]>100){
			$errores[] = "<p>El stock no puede ser superior a 100.</p>";
		}
		
		//Validación del precio 
		if($nuevoproducto["PRECIO"]==""){
			$errores[] = "<p>El precio no puede estar vacío.</p>";
		}							
		
		//Validación de la imagen
		if($nuevoproducto["IMAGEN"]==""){
			$errores[] = "<p>La imagen no puede estar vacía.</p>";
		}else if(!filter_var($nuevoproducto["IMAGEN"], FILTER_VALIDATE_URL)){
			$errores[] = "<p>El campo de la imagen tiene que ser una URL.</p>";
		}
		//Validación de la categoria
		if($nuevoproducto["OID_CATEGORIA"]==""){
			$errores[] = "<p>La categoria no puede estar vacía.</p>";
		}

		return $errores;
	}

?>