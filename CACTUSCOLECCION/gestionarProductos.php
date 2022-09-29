<?php


function consultarProductos($conexion) {

	$consulta = "SELECT * FROM PRODUCTOS ORDER BY NOMBRE";

	return $conexion -> query($consulta);
}

function obtenerCategorias($conexion){
	$consulta = "SELECT * FROM CATEGORIAS ORDER BY NOMBRE_CAT";

	return $conexion -> query($consulta);

}
/*function obtenerProductosPorCategoria($conexion, $CATEGORIA){
	$consulta = "SELECT * FROM PRODUCTOS WHERE CATEGORIA = $CATEGORIA";
	
	return $conexion -> query($consulta);
}*/

function obtenerNombreOid($conexion, $OID_PRODUCTO){
	$consulta = "SELECT * FROM PRODUCTOS WHERE OID_PRODUCTO = $OID_PRODUCTO";
	
		return $conexion -> query($consulta);
	
}
function obtenerProductosPorCategoria($conexion, $CATEGORIA){
	$consulta = "SELECT * FROM PRODUCTOS P WHERE P.OID_CATEGORIA = $CATEGORIA ORDER BY P.NOMBRE";
	return $conexion -> query($consulta);
}

function obtenerCantidadProductos($conexion){
	$consulta = "SELECT * FROM LINEAPEDIDO";
	
	return $conexion -> query($consulta);
}

function insertarProducto($conexion, $OID_PRODUCTO, $NOMBRE, $TAMAÑO, $DESCRIPCION, $STOCK, $PRECIO, $IMAGEN){
	$consulta = "INSERT INTO LINEAPEDIDO ";
}

function crear_producto($conexion, $NOMBRE, $TAMAÑO, $DESCRIPCION, $STOCK, $PRECIO, $CATEGORIA, $IMAGEN){
	try{
		$stmt=$conexion->prepare('CALL crear_producto(:NOMBRE,:TAMAÑO,:DESCRIPCION,:STOCK,:PRECIO,:CATEGORIA,:IMAGEN)');
		$stmt->bindParam(':NOMBRE',$NOMBRE);
		$stmt->bindParam(':TAMAÑO',$TAMAÑO);
		$stmt->bindParam(':DESCRIPCION',$DESCRIPCION);
		$stmt->bindParam(':STOCK',$STOCK);
		$stmt->bindParam(':PRECIO',$PRECIO);
		$stmt->bindParam(':CATEGORIA',$CATEGORIA);
		$stmt->bindParam(':IMAGEN',$IMAGEN);
		$stmt->execute();
		return "";		
	}catch(PDOException $e){
		return $e->getMessage();		
	}
}
function modificar_productos($conexion, $OID_PRODUCTO, $NOMBRE, $TAMAÑO, $DESCRIPCION, $STOCK, $PRECIO, $CATEGORIA, $IMAGEN){
	try{
		$stmt=$conexion->prepare('CALL MODIFICAR_PRODUCTOS(:OID_PRODUCTO,:NOMBRE,:TAMAÑO,:DESCRIPCION,:STOCK,:PRECIO,:CATEGORIA,:IMAGEN)');
		$stmt->bindParam(':OID_PRODUCTO',$OID_PRODUCTO);
		$stmt->bindParam(':NOMBRE',$NOMBRE);
		$stmt->bindParam(':TAMAÑO',$TAMAÑO);
		$stmt->bindParam(':DESCRIPCION',$DESCRIPCION);
		$stmt->bindParam(':STOCK',$STOCK);
		$stmt->bindParam(':PRECIO',$PRECIO);
		$stmt->bindParam(':CATEGORIA',$CATEGORIA);
		$stmt->bindParam(':IMAGEN',$IMAGEN);
		$stmt->execute();
		return "";		
	}catch(PDOException $e){
		return $e->getMessage();		
	}
}

function quitar_producto($conexion,$OID_PRODUCTO) {
		try {
			$stmt=$conexion->prepare('CALL quitar_producto(:OID_PRODUCTO)');
			$stmt->bindParam(':OID_PRODUCTO',$OID_PRODUCTO);
			$stmt->execute();
			return "";		
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}


?>