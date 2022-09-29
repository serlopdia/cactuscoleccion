<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);

		require_once("../gestionBD.php");
		require_once("gestionarProductos.php");

		$conexion = crearConexionBD();	
		$excepcion = quitar_producto($conexion, $producto["OID_PRODUCTO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "mostrarProductos.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: mostrarProductos.php");
	}
	else Header("Location: mostrarProductos.php"); // Se ha tratado de acceder directamente a este PHP
?>