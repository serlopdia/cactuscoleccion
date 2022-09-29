<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de la cesta de compra de la capa de acceso a datos
 * #==========================================================#
 */
function obtenerProductosCesta($conexion, $cesta) {

	try {
		$consulta = "SELECT * FROM PRODUCTOS WHERE OID_PRODUCTO IN (" . implode(",", $_SESSION["cesta"]) . ")";
		$r=array();
		$stmt= $conexion -> prepare($consulta);
		$stmt -> execute();
		while($row = $stmt-> fetch(PDO::FETCH_ASSOC)){ 
			$r[]=$row;
		}
		return $r;
	} catch(PDOException $e) {
		return false;
	}

}
function calcularImporteCesta($productos, $cantidadProducto){
	$sumaTotal=0;
	foreach ($productos as $producto) {
		$importe= $producto["PRECIO"]*$cantidadProducto[$producto["OID_PRODUCTO"]];
		$sumaTotal= $sumaTotal+$importe;
	}
	return $sumaTotal;
}


	

?>