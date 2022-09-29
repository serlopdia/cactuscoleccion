<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de clientes de la capa de acceso a datos
     * #==========================================================#
     */


 function alta_cliente($conexion,$nuevoUsuario) {
	//"CALL crear_cliente('marta', 'diaz', 'calle diaz', '615487594', 'marta@gmail.com', '84581548L', 'mardiafer13', 'Marta123');";
	var_dump($nuevoUsuario["dni"])	;
	
	try {
		$consulta = "CALL crear_cliente(:nombre, :apellidos, :direccion, :telefono, :email, :dni, :usuario, :contrasenya)";
		$stmt=$conexion->prepare($consulta);
		
		$stmt->bindParam(':nombre',$nuevoUsuario["nombre"]);
		$stmt->bindParam(':apellidos',$nuevoUsuario["apellidos"]);
		$stmt->bindParam(':direccion',$nuevoUsuario["direccion"]);
		$stmt->bindParam(':telefono',$nuevoUsuario["telefono"]);
		$stmt->bindParam(':email',$nuevoUsuario["email"]);
		$stmt->bindParam(':dni',$nuevoUsuario["dni"]);
		$stmt->bindParam(':usuario',$nuevoUsuario["usuario"]);
		$stmt->bindParam(':contrasenya',$nuevoUsuario["contrasenya"]);
		
	    $resultado=	$stmt->execute();
		return true;
		
	} catch(PDOException $e) {
		return false;
	}
	
}
 
 

function consultarCliente($conexion,$usuarioCliente,$password) {
	try{
		$consulta = "SELECT COUNT(*) FROM CLIENTES WHERE usuario=:pepito AND contrasenya=:password";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':pepito',$usuarioCliente);
	$stmt->bindParam(':password',$password);
	$stmt->execute();
	return $stmt->fetchColumn();
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}
 	
	
}

function consultarTodosClientes($conexion){
	$consulta = "SELECT * FROM CLIENTES";
	return $conexion -> query($consulta);
}

function consultarUsuarios($conexion){
	$consulta = "SELECT * FROM CLIENTES";
	var_dump($consulta);
	var_dump($conexion -> query($consulta));
	return $conexion -> query($consulta);
}

function consultaClientesBusqueda($conexion, $busqueda){
	try{
		$busqueda= "%" .strtolower($busqueda) . "%";
		$consulta = "SELECT * FROM CLIENTES WHERE lower(nombre) LIKE '$busqueda' 
		OR lower(apellidos) LIKE '$busqueda'
		OR email LIKE '$busqueda' ";

	return $conexion -> query($consulta);
	
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}
	
}

function busquedaClientes($conexion, $busqueda){
	try{
		$busqueda = strtolower($busqueda);
		$consulta = "SELECT * FROM CLIENTES WHERE LOWER(NOMBRE) LIKE '%$busqueda%' 
		OR LOWER(APELLIDOS) LIKE '%$busqueda%' OR LOWER(EMAIL) LIKE '%$busqueda%' ORDER BY OID_CLIENTE ASC";

	return $conexion -> query($consulta);
	
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}
	
}
function buscarOidByUser($conexion, $usuario){
	
	try{
		$consulta= "SELECT OID_CLIENTE FROM CLIENTES WHERE USUARIO='$usuario'";
		
		$respuesta= $conexion -> query($consulta);
		$row= $respuesta -> fetch(PDO::FETCH_ASSOC);
		return $row["OID_CLIENTE"];
	
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}
		
		
}


?>