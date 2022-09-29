<?php

session_start();
require_once("gestionBD.php");
require_once("admin/gestionarPedidos.php");
require_once("gestionarClientes.php");
require_once("admin/gestionarPagos.php");

$conexion= crearConexionBD();
if(isset($_SESSION["login"])){
	//para insertar en PEDIDOS
	$nuevoPedido["direccion"]=$_REQUEST["direccion"];
	$nuevoPedido["pais"]=$_REQUEST["pais"];
	$nuevoPedido["ciudad"]=$_REQUEST["ciudad"];
	$nuevoPedido["precio_total"]=$_SESSION["importe_total"];
	$nuevoPedido["cPostal"]=$_REQUEST["cPostal"];
	$nuevoPedido["oid_cliente"]=buscarOidByUser($conexion, $_SESSION["login"]);
	//estado, oid cliente
	
	//para insertar en PAGOS
	//cantidad, fecha, estado
	$nuevoPedido["tipoPago"]=$_REQUEST["pago"];
	//oidpedido
}
$_SESSION["pedidoCesta"]=$nuevoPedido;

$erroresValidacion= validarDatosPedido($nuevoPedido);

if(count($erroresValidacion)>0){
	$_SESSION["erroresFormulario"]=$erroresValidacion;
	header("Location: form_datos_envio.php");
}else{
			
	if(insertarCesta($conexion, $nuevoPedido)){
		$idPedido=buscarOIDpedido($conexion, $nuevoPedido["oid_cliente"]);
		foreach ($_SESSION["pedidoDatos"]["productos"] as $producto) {
			$cantidad= $_SESSION["pedidoDatos"]["cantidades"][$producto["OID_PRODUCTO"]];
			
				$lineaPedido=array();
		//		var_dump($producto);
		$lineaPedido["precio"]=$producto["PRECIO"];
		$lineaPedido["cantidad"]=$cantidad;
		$lineaPedido["oid_pedido"]=$idPedido;
		$lineaPedido["oid_producto"]=$producto["OID_PRODUCTO"];
		
		
		insertarLineaPedidoCesta($conexion, $lineaPedido);	
	}
	
	if(insertarPagoCesta($conexion,$idPedido,$_SESSION["importe_total"],$nuevoPedido["tipoPago"])){
		$_SESSION["cesta"]=null;
		$_SESSION["pedidoDatos"]=null;
		header("Location: pedidoConfirmado.php");
	}else{
		header("Location: error.php");
	}
	
	$conexion=cerrarConexionBD($conexion);
	
}
}

function validarDatosPedido($nuevoPedido){
	
	if($nuevoPedido["direccion"]==""){
			$erroresValidacion[] = "<p>Debe introducir su direccion</p>";
		}else if(strlen($nuevoPedido["direccion"])>256){
		$erroresValidacion []= "<p>La dirección no debe superar los 256 caracteres </p>";
		}
	if($nuevoPedido["ciudad"]==""){
			$erroresValidacion[] = "<p>Debe introducir su ciudad</p>";
		}else if(strlen($nuevoPedido["ciudad"])>15){
		$erroresValidacion []= "<p>La ciudad no debe superar los 15 caracteres </p>";
		}
	if($nuevoPedido["cPostal"]==""){
			$erroresValidacion[] = "<p>Debe introducir su codigo postal</p>";
		}elseif(strlen($nuevoPedido["cPostal"]) != 5){
			$erroresValidacion[]= "<p> El codigo postal debe tener 5 digitos </p>";
		}
	return $erroresValidacion;
}

?>