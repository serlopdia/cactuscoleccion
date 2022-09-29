<?php

function consultarPagos($conexion) {
    $consulta = "SELECT * FROM PAGOS ORDER BY OID_PAGO DESC";
    return $conexion->query($consulta);
}

function modificar_pago ($conexion,$OID_PAGO,$CANTIDAD,$FECHA_PAGO,$ESTADO_PAGO,$TIPO_PAGO,$OID_PEDIDO) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_PAGO(:OID_PAGO,:CANTIDAD,:FECHA_PAGO,:ESTADO_PAGO,:TIPO_PAGO,:OID_PEDIDO)');
		$stmt->bindParam(':OID_PAGO',$OID_PAGO);
		$stmt->bindParam(':CANTIDAD',$CANTIDAD);
		$stmt->bindParam(':FECHA_PAGO',$FECHA_PAGO);
		$stmt->bindParam(':ESTADO_PAGO',$ESTADO_PAGO);
		$stmt->bindParam(':TIPO_PAGO',$TIPO_PAGO);
		$stmt->bindParam(':OID_PEDIDO',$OID_PEDIDO);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}



function insertarPagoCesta($conexion,$idPedido,$importeTotal,$tipoPago){
	try{
		$consulta= "CALL crear_pago(:cantidad, CURRENT_DATE, :estado, :tipo, :oid_pedido) ";
		$stmt= $conexion->prepare($consulta);
		// var_dump($idPedido);
		// var_dump($importeTotal);
		// var_dump($tipoPago);
		$estado="PENDIENTE";
		$stmt->bindParam(':cantidad',$importeTotal,PDO::PARAM_INT);
		$stmt->bindParam(':estado',$estado);
		$stmt->bindParam(':tipo',$tipoPago,PDO::PARAM_STR);
		$stmt->bindParam(':oid_pedido',$idPedido,PDO::PARAM_INT);

	    $resultado=	$stmt->execute();
		return $resultado;
	}catch(PDOException $e) {
		$e->getMessage();
		return false;
	}
	
}

?>