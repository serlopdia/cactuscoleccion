<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de clientes de la capa de acceso a datos
 * #==========================================================#
 */

function consultarEmpleado($conexion, $usuarioEmpleado, $password) {

	try {
		$consulta = "SELECT COUNT(*) FROM EMPLEADOS WHERE usuario=:usuarioEmpleado AND contrasenya=:password";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':usuarioEmpleado', $usuarioEmpleado);
		$stmt -> bindParam(':password', $password);
		$stmt -> execute();
		return $stmt -> fetchColumn();
	} catch(PDOException $e) {
		$e -> getMessage();
		return false;
	}
}
?>