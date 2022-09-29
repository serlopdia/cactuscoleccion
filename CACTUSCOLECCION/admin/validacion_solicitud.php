<?php
	session_start();
	require_once("../gestionBD.php");
	require_once("gestionarSolicitudes.php");
	
	if (isset($_REQUEST["TELEFONO"])) {

		$solicitud["OID_SOLICITUD"] = $_REQUEST["OID_SOLICITUD"];
		$solicitud["DIRECCION"] = $_REQUEST["DIRECCION"];
		$solicitud["NOMBRE_DESTINATARIO"] = $_REQUEST["NOMBRE_DESTINATARIO"];
		$solicitud["TELEFONO"] = $_REQUEST["TELEFONO"];		
		$solicitud["OID_PEDIDO"] = $_REQUEST["OID_PEDIDO"];
		$solicitud["OID_EMPLEADO"] = $_REQUEST["OID_EMPLEADO"];
		$solicitud["TIPO"] = $_REQUEST["TIPO"];
		
		$_SESSION["solicitud"] = $solicitud;

		$conexion = crearConexionBD();
		$errores = validarDatosSolicitud($solicitud);
		cerrarConexionBD($conexion);

		if (count($errores)>0) {
			$_SESSION["errores"] = $errores;
			if (isset($_REQUEST["grabar"])) Header("Location: mostrarSolicitudes.php");
			else Header('Location: formSolicitud.php');
		} else {
			if(isset($_REQUEST["editar"])) Header("Location: mostrarSolicitudes.php");
			else if (isset($_REQUEST["insertar"])) Header("Location: insertarSolicitud.php");
			else if (isset($_REQUEST["grabar"])) Header("Location: modificarSolicitud.php");
		}
	}
	else
		header("Location : mostrarSolicitudes.php");
	
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de solicitud
	///////////////////////////////////////////////////////////
	function validarDatosSolicitud($solicitud){
		 
		// Validación de la Direccion			
		if($solicitud["DIRECCION"]==""){ 
			$errores[] = "<p>Debe introducir una direccion.</p>";
		}else if(strlen($solicitud["DIRECCION"])<10){
			$errores []= "<p>La dirección debe superar los 10 caracteres. </p>";
		}
         
      // Validación del Nombre			
      if($solicitud["NOMBRE_DESTINATARIO"]=="") 
         $errores[] = "<p>Debe introducir un nombre de destinatario.</p>";
		
		//Validacion Telefono
		if($solicitud["TELEFONO"]==""){
			$errores[]= "<p> Debe introducir un numero de telefono.</p>"; 
		}else if(!preg_match("/[0-9]{9}/", $solicitud["TELEFONO"])){
			$errores[]= "<p> El telefono debe tener 9 digitos.</p>";
		}

		// Validación del Tipo
		if($solicitud["TIPO"]==""){
			$errores[] = "<p>El tipo no puede estar vacío.</p>";
      }else if(($solicitud["TIPO"]!='CERTIFICADA') && ($solicitud["TIPO"]!='ORDINARIA')){
         $errores[]= "<p> El tipo debe ser 'CERTIFICADA' u 'ORDINARIA'.</p>";
      }

		// Validación del OID_PEDIDO
		if($solicitud["OID_PEDIDO"]==""){
			$errores[] = "<p>El ID Pedido no puede estar vacío.</p>";
      }else if(!is_numeric($solicitud["OID_PEDIDO"])){
			$errores[] = "<p>El ID Pedido debe ser un número.</p>";
      }

      // Validación del OID_EMPLEADO
		if($solicitud["OID_EMPLEADO"]==""){
			$errores[] = "<p>El ID Empleado no puede estar vacío.</p>";
      }else if(!is_numeric($solicitud["OID_EMPLEADO"])){
			$errores[] = "<p>El ID Empleado debe ser un número.</p>";
      }
	
		return $errores;
	}

?>
