<?php
	session_start();	
	
	if (isset($_SESSION["pago"])) {
		$pago = $_SESSION["pago"];
		unset($_SESSION["pago"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarPagos.php");
		
		$conexion = crearConexionBD();
		$excepcion = modificar_pago($conexion, $pago["OID_PAGO"], $pago["CANTIDAD"], $pago["FECHA_PAGO"],
										 $pago["ESTADO_PAGO"], $pago["TIPO_PAGO"], $pago["OID_PEDIDO"]);
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "mostrarPagos.php";
			Header("Location: excepcion.php");
		}else
			Header("Location: mostrarPagos.php");	
	}
	else Header("Location: mostrarPagos.php");

?>