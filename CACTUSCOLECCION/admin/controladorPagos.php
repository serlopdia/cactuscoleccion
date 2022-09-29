<?php

	session_start();
	if (isset($_REQUEST["OID_PAGO"])) {
		$pago["OID_PAGO"] = $_REQUEST["OID_PAGO"];
		$pago["CANTIDAD"] = $_REQUEST["CANTIDAD"];
		$pago["FECHA_PAGO"] = $_REQUEST["FECHA_PAGO"];
		$pago["ESTADO_PAGO"] = $_REQUEST["ESTADO_PAGO"];		
		$pago["TIPO_PAGO"] = $_REQUEST["TIPO_PAGO"];
		$pago["OID_PEDIDO"] = $_REQUEST["OID_PEDIDO"];
		
		$_SESSION["pago"] = $pago;
		
		if(isset($_REQUEST["editar"]))Header("Location: mostrarPagos.php");
		else if (isset($_REQUEST["insertar"])) Header("Location: altaProducto.php");
		else if (isset($_REQUEST["grabar"])) Header("Location: modificarPago.php");
	}
	else
		header("Location : mostrarPagos.php");
	
?>




		