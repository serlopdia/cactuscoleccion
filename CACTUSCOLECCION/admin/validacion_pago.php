<?php
	session_start();
	require_once("../gestionBD.php");
	require_once("gestionarPagos.php");
	
	if (isset($_REQUEST["OID_PAGO"])) {

		$pago["OID_PAGO"] = $_REQUEST["OID_PAGO"];
		$pago["CANTIDAD"] = $_REQUEST["CANTIDAD"];
		$pago["FECHA_PAGO"] = $_REQUEST["FECHA_PAGO"];
		$pago["ESTADO_PAGO"] = $_REQUEST["ESTADO_PAGO"];
		$pago["TIPO_PAGO"]= $_REQUEST["TIPO_PAGO"];
		$pago["OID_PEDIDO"]= $_REQUEST["OID_PEDIDO"];
	
		$_SESSION["pago"] = $pago;

		$conexion = crearConexionBD();
		$errores = validarDatosPago($pago);
		cerrarConexionBD($conexion);

		if (count($errores)>0) {
			$_SESSION["errores"] = $errores;
			if (isset($_REQUEST["grabar"])) Header("Location: mostrarPagos.php");
		} else {
			if(isset($_REQUEST["editar"])) Header("Location: mostrarPagos.php");
			else if (isset($_REQUEST["grabar"])) Header("Location: modificarPago.php");
		}
	}
	else
		header("Location : mostrarPagos.php");
	
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de pago
	///////////////////////////////////////////////////////////
	function validar_fecha($fecha){
		$valores = explode('/', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			return true;
		 }
		return false;
	}

	function validarDatosPago($pago){
		
		// Validación de la Cantidad			
		if($pago["CANTIDAD"]=="") 
			$errores[] = "<p>Debe introducir un nombre de destinatario.</p>";
		
		//Validacion de la Fecha
		if($pago["FECHA_PAGO"]==""){
			$errores[]= "<p> La fecha no puede estar vacía.</p>"; 
		}else if(!validar_fecha($pago["FECHA_PAGO"])){
			$errores[]= "<p> La fecha introducida no es válida.</p>";
		}
		
		// Validación del Estado
		if($pago["ESTADO_PAGO"]==""){
			$errores[] = "<p>El estado no puede estar vacío.</p>";
		}else if($pago["ESTADO_PAGO"]!='PENDIENTE' && $pago["ESTADO_PAGO"]!='REALIZADO'){
			$errores[]= "<p> El estado debe ser 'PENDIENTE' o 'REALIZADO'.</p>";
		}
		
		// Validación del Tipo
		if($pago["TIPO_PAGO"]==""){
			$errores[] = "<p>El tipo no puede estar vacío.</p>";
		}else if($pago["TIPO_PAGO"]!='PAYPAL' && $pago["TIPO_PAGO"]!='TRANSFERENCIA' && $pago["TIPO_PAGO"]!='CONTRA REEMBOLSO'){
			$errores[]= "<p> El tipo de pago debe ser 'PAYPAL', 'TRANSFERENCIA' o 'CONTRA REEMBOLSO'.</p>";
		}
		
		// Validación del OID_PEDIDO
		if($pago["OID_PEDIDO"]==""){
			$errores[] = "<p>El ID Pedido no puede estar vacío.</p>";
		}else if(!is_numeric($pago["OID_PEDIDO"])){
			$errores[] = "<p>El ID Pedido debe ser un número.</p>";
		}
		
		return $errores;
	}
		
?>