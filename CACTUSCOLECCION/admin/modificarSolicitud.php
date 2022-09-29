<?php	
	session_start();	
	
	if (isset($_SESSION["solicitud"])) {
		$solicitud = $_SESSION["solicitud"];
		unset($_SESSION["solicitud"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarSolicitudes.php");
		
		$conexion = crearConexionBD();
		$excepcion = modificar_solicitud ($conexion,$solicitud["OID_SOLICITUD"],$solicitud["DIRECCION"],$solicitud["NOMBRE_DESTINATARIO"],
									$solicitud["TELEFONO"],$solicitud["OID_PEDIDO"],$solicitud["OID_EMPLEADO"],$solicitud["TIPO"]);
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "mostrarSolicitudes.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: mostrarSolicitudes.php");
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: mostrarSolicitudes.php"); 
?>
