<?php

	session_start();
	if (isset($_REQUEST["TELEFONO"])) {
		$solicitud["OID_SOLICITUD"] = $_REQUEST["OID_SOLICITUD"];
		$solicitud["DIRECCION"] = $_REQUEST["DIRECCION"];
		$solicitud["NOMBRE_DESTINATARIO"] = $_REQUEST["NOMBRE_DESTINATARIO"];
		$solicitud["TELEFONO"] = $_REQUEST["TELEFONO"];		
		$solicitud["OID_PEDIDO"] = $_REQUEST["OID_PEDIDO"];
		$solicitud["OID_EMPLEADO"] = $_REQUEST["OID_EMPLEADO"];
		$solicitud["TIPO"] = $_REQUEST["TIPO"];
		
		$_SESSION["solicitud"] = $solicitud;

		if(isset($_REQUEST["editar"])) Header("Location: mostrarSolicitudes.php");
		else if (isset($_REQUEST["insertar"])) Header("Location: insertarSolicitud.php");
		else if (isset($_REQUEST["guardar"])) Header("Location: modificarSolicitud.php");
	}
	else
		header("Location : mostrarSolicitudes.php");
	
?>