<?php
	session_start();
	
	if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}
	if (isset($_SESSION["solicitud"])) {
		$solicitud = $_SESSION["solicitud"];
		unset($_SESSION["solicitud"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarSolicitudes.php");
		
		$conexion = crearConexionBD();
		$excepcion = crear_solicitud($conexion,$solicitud["DIRECCION"],$solicitud["NOMBRE_DESTINATARIO"],
									$solicitud["TELEFONO"],$solicitud["OID_PEDIDO"],$solicitud["OID_EMPLEADO"],$solicitud["TIPO"]);
		$cambio_estado = cambiar_estado_pedido($conexion,$solicitud["OID_PEDIDO"]);
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "panelAdmin.php";
			Header("Location: excepcion.php");
		} else if ($cambio_estado<>"") {
			$_SESSION["cambio_estado"] = $cambio_estado;
			$_SESSION["destino"] = "panelAdmin.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: panelAdmin.php");
	}
	else Header("Location: panelAdmin.php");
?>