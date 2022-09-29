<?php
//añade productos
session_start();

if($_SERVER["REQUEST_METHOD"]==="GET"){
	
$idProducto=$_GET["OID_PRODUCTO"];

if(!isset($_SESSION["cesta"])){
	$_SESSION["cesta"]=array();
}
$_SESSION["cesta"][]=$idProducto;

header("Location: vistaCesta.php");

}else{
	if ($_POST["oper"]=="eliminar"){
		$idProducto =$_POST["oid"];
		$productos=array();
		foreach($_SESSION["cesta"] as $producto){
			if ($producto!=$idProducto) {
				$productos[]=$producto;
				
			}
		}
		//comprobacion si el array productos esta vacio el array tiene que ser null
		$_SESSION["cesta"]=$productos;
		header("Location: vistaCesta.php");
	}
	
}

//elimina productos





?>