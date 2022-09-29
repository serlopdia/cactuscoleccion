<?php

	session_start();
	if (isset($_REQUEST["OID_PRODUCTO"])) {
		$producto["OID_PRODUCTO"] = $_REQUEST["OID_PRODUCTO"]; 
		$producto["NOMBRE"] = $_REQUEST["NOMBRE"];
		$producto["TAMAÑO"] = $_REQUEST["TAMAÑO"];
		$producto["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
		$producto["STOCK"] = $_REQUEST["STOCK"];
		$producto["PRECIO"] = $_REQUEST["PRECIO"];
		$producto["IMAGEN"] = $_REQUEST["IMAGEN"];
		
		$_SESSION["producto"] = $producto;
		
		if(isset($_REQUEST["editar"]))Header("Location: detallesProducto.php");
		else if (isset($_REQUEST["modificar"]))Header("Location: cesta_compra.php");
	}
	else
		header("Location : lista_productos.php");
	
?>