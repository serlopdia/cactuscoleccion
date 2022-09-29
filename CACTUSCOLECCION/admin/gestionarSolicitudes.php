<?php
     
function consultarSolicitudes($conexion) {
	$consulta = "SELECT * FROM SOLICITUDES ORDER BY OID_SOLICITUD ASC";
    return $conexion->query($consulta);
}

/* function obtenerOIDSolicitud($conexion) {
    $consulta = "SELECT (SEC_SOLICITUD.CURRVAL+1) from dual;";
    $result1 = $conexion->query($consulta);
    $result2 = $result1->fetch_all(FETCH_ASSOC);
    return $result2[0];
} */
  
/* function quitar_solicitud($conexion,$OID_SOLICITUD) {
	try {
		$stmt=$conexion->prepare('CALL QUITAR_SOLICITUD(:OID_SOLICITUD)');
		$stmt->bindParam(':OID_SOLICITUD',$OID_SOLICITUD);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
} */

function modificar_solicitud($conexion,$OID_SOLICITUD,$DIRECCION,$NOMBRE_DESTINATARIO,$TELEFONO,$OID_PEDIDO,$OID_EMPLEADO,$TIPO) {
	try {
		$stmt=$conexion->prepare('CALL modificar_solicitud (:OID_SOLICITUD,:DIRECCION,:NOMBRE_DESTINATARIO,:TELEFONO,:OID_PEDIDO,:OID_EMPLEADO,:TIPO)');
		$stmt->bindParam(':OID_SOLICITUD',$OID_SOLICITUD);
		$stmt->bindParam(':DIRECCION',$DIRECCION);
		$stmt->bindParam(':NOMBRE_DESTINATARIO',$NOMBRE_DESTINATARIO);
		$stmt->bindParam(':TELEFONO',$TELEFONO);
		$stmt->bindParam(':OID_PEDIDO',$OID_PEDIDO);
		$stmt->bindParam(':OID_EMPLEADO',$OID_EMPLEADO);
		$stmt->bindParam(':TIPO',$TIPO);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function crear_solicitud($conexion,$DIRECCION,$NOMBRE_DESTINATARIO,$TELEFONO,$OID_PEDIDO,$OID_EMPLEADO,$TIPO) {
	try {
		$stmt=$conexion->prepare('CALL crear_solicitud(:DIRECCION,:NOMBRE_DESTINATARIO,:TELEFONO,:OID_PEDIDO,:OID_EMPLEADO,:TIPO)');
		$stmt->bindParam(':DIRECCION',$DIRECCION);
		$stmt->bindParam(':NOMBRE_DESTINATARIO',$NOMBRE_DESTINATARIO);
		$stmt->bindParam(':TELEFONO',$TELEFONO);
		$stmt->bindParam(':OID_PEDIDO',$OID_PEDIDO);
		$stmt->bindParam(':OID_EMPLEADO',$OID_EMPLEADO);
		$stmt->bindParam(':TIPO',$TIPO);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function cambiar_estado_pedido($conexion,$OID_PEDIDO) {
	try {
		$stmt=$conexion->prepare('CALL cambiar_estado_pedido(:OID_PEDIDO)');
		$stmt->bindParam(':OID_PEDIDO',$OID_PEDIDO);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
		return false;
    }
}
function consultarEmpleados($conexion) {
	$consulta = "SELECT * FROM EMPLEADOS ORDER BY OID_EMPLEADO ASC";
    return $conexion->query($consulta);
}
	
?>