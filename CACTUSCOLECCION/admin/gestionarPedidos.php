<?php
     
function consultarTodosPedidos($conexion) {
	$consulta = "SELECT * FROM PEDIDOS ORDER BY OID_PEDIDO DESC";
    return $conexion->query($consulta);
}

function consultarPedidosRealizados($conexion) {
	$consulta = "SELECT * FROM PEDIDOS WHERE ESTADO_PEDIDO = 'REALIZADO' ORDER BY OID_PEDIDO DESC";
    return $conexion->query($consulta);
}

function consultarPedidosPendientes($conexion) {
	$consulta = "SELECT * FROM PEDIDOS WHERE ESTADO_PEDIDO = 'PENDIENTE' ORDER BY OID_PEDIDO DESC";
    return $conexion->query($consulta);
}

function consultarLineaPedido($conexion) {
	$consulta = "SELECT * FROM LINEAPEDIDO WHERE LINEAPEDIDO.OID_PEDIDO = PEDIDOS.OID_PEDIDO";
}

function consultarProducto($conexion){
	$consulta = "SELECT * FROM PRODUCTOS WHERE PRODUCTOS.OID_LINEAPEDIDO = LINEAPEDIDO.OID_LINEAPEDIDO";
}

function obtenerPedidoPorId($conexion, $OID_PEDIDO){
	$consulta = "SELECT * FROM PEDIDOS WHERE OID_PEDIDO = $OID_PEDIDO";
	//var_dump($conexion->query($consulta));
	return $conexion->query($consulta);
}

function obtenerPrecioTotalPedido($conexion, $oid_pedido){
				
	try{
		$consulta="";
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}	
}

function modificar_pedido($conexion, $OID_PEDIDO, $FECHA, $DIRECCION, $PAIS, $CIUDAD, $PRECIO_TOTAL, $CODIGO_POSTAL, $ESTADO_PEDIDO, $OID_CLIENTE){
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_PRODUCTOS(:OID_PEDIDO,:FECHA,:DIRECCION,:PAIS,:CIUDAD,:PRECIO_TOTAL,:CODIGO_POSTAL,:ESTADO_PEDIDO,:OID_CLIENTE)');
		$stmt->bindParam(':OID_PEDIDO',$OID_PEDIDO);
		$stmt->bindParam(':FECHA',$FECHA);
		$stmt->bindParam(':DIRECCION',$DIRECCION);
		$stmt->bindParam(':PAIS',$PAIS);
		$stmt->bindParam(':CIUDAD',$CIUDAD);
		$stmt->bindParam(':PRECIO_TOTAL',$PRECIO_TOTAL);
		$stmt->bindParam(':CODIGO_POSTAL',$CODIGO_POSTAL);
		$stmt->bindParam(':ESTADO_PEDIDO',$ESTADO_PEDIDO);
		$stmt->bindParam(':OID_CLIENTE',$OID_CLIENTE);
		$stmt->execute();
		return "";		
	}catch(PDOException $e){
		return $e->getMessage();		
	}
}

function cambio_estado_pedido($conexion,$OID_PEDIDO,$ESTADO_PEDIDO) {
	try {
		$consulta = "CALL cambiar_estado_pedido($OID_PEDIDO, '$ESTADO_PEDIDO' )";
		$stmt=$conexion->prepare($consulta);
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function insertarCesta($conexion, $nuevoPedido){
	
	try{
		$consulta="CALL crear_pedido(:direccion, :pais, :ciudad, :precio_total, :cpostal, :estado_pedido, :oid_cliente)";
		$stmt=$conexion->prepare($consulta);
		
		$estado= 'PENDIENTE';
		$stmt->bindParam(':direccion',$nuevoPedido["direccion"]);
		$stmt->bindParam(':pais',$nuevoPedido["pais"]);
		$stmt->bindParam(':ciudad',$nuevoPedido["ciudad"]);
		$stmt->bindParam(':precio_total',$nuevoPedido["precio_total"]);
		$stmt->bindParam(':cpostal',$nuevoPedido["cPostal"]);
		$stmt->bindParam(':estado_pedido',$estado);
		$stmt->bindParam(':oid_cliente',$nuevoPedido["oid_cliente"]);
	    $resultado=	$stmt->execute();
	    // if($resultado)
		// return $conexion->lastInsertId();
		// else {
			// return false;
		// }
		//var_dump($conexion->lastInsertId());
		return $resultado;
		
	} catch(PDOException $e) {
		echo "holaaa";
		var_dump($e);
		return false;
	}
	
	
}
 
 function insertarLineaPedidoCesta($conexion, $lineaPedido){
 	try{
 		
		$consulta="CALL crear_linea_pedido(:precio, :cantidad, :oidPedido, :oidProducto)";
 		$stmt=$conexion->prepare($consulta);
		
		$stmt->bindParam(':precio',$lineaPedido["precio"],PDO::PARAM_INT);
		$stmt->bindParam(':cantidad',$lineaPedido["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(':oidPedido',$lineaPedido["oid_pedido"],PDO::PARAM_INT);
		$stmt->bindParam(':oidProducto',$lineaPedido["oid_producto"],PDO::PARAM_INT);
		//var_dump($lineaPedido);
		$resultado=	$stmt->execute();
		return $resultado;
	
	}catch(PDOException $e) {
		return false;
	}
     
 }
 
 function buscarOIDpedido($conexion, $oid_cliente){
 	
	try{
		$consulta= "SELECT MAX(OID_PEDIDO) AS OID_PEDIDO FROM PEDIDOS WHERE OID_CLIENTE='$oid_cliente'";
		
		$respuesta= $conexion -> query($consulta);
		$row= $respuesta -> fetch(PDO::FETCH_ASSOC);
		//var_dump($row);
		return $row["OID_PEDIDO"];
 }catch(PDOException $e) {
		return false;
	}
 }
