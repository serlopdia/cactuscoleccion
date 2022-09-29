<?php
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarProductos.php");
		
		$conexion = crearConexionBD();
		$excepcion = modificar_productos($conexion, $producto["OID_PRODUCTO"], $producto["NOMBRE"], $producto["TAMAÑO"],
										 $producto["DESCRIPCION"], $producto["STOCK"], $producto["PRECIO"], $producto["IMAGEN"], $producto["OID_CATEGORIA"]);
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "mostrarProductos.php";
			Header("Location: excepcion.php");
		}else
			Header("Location: mostrarProductos.php");	
	}
	else Header("Location: mostrarProductos.php");
		


?>