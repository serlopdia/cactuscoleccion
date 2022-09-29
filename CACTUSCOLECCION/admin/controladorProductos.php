<?php

	session_start();
	if (isset($_REQUEST["NOMBRE"])) {
		$producto["OID_PRODUCTO"] = $_REQUEST["OID_PRODUCTO"];
		$producto["NOMBRE"] = $_REQUEST["NOMBRE"];
		$producto["TAMAÑO"] = $_REQUEST["TAMAÑO"];
		$producto["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
		$producto["STOCK"] = $_REQUEST["STOCK"];
		$producto["PRECIO"] = $_REQUEST["PRECIO"];
		$producto["IMAGEN"] = $_REQUEST["IMAGEN"];
		$producto["OID_CATEGORIA"] = $_REQUEST["OID_CATEGORIA"];
		
		$_SESSION["producto"] = $producto;
		
		if(isset($_REQUEST["editar"]))Header("Location: mostrarProductos.php");
		else if (isset($_REQUEST["insertar"])) Header("Location: validacion_alta_producto.php");
		else if (isset($_REQUEST["grabar"])) Header("Location: validacion_modificacion_producto.php");
		else  if (isset($_REQUEST["borrar"])) Header("Location: borrarProducto.php"); 
	}
	else
		header("Location : mostrarProductos.php");
	
?>