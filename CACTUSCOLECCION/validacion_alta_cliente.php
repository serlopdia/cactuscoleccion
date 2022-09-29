<?php
	session_start();
	require_once("gestionBD.php");
	require_once("gestionarClientes.php");
	
	if (isset($_SESSION["formulario"])) {
		
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
		$nuevoUsuario["telefono"]= $_REQUEST["telefono"];
		$nuevoUsuario["dni"] = $_REQUEST["dni"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["usuario"] = $_REQUEST["usuario"];
		$nuevoUsuario["contrasenya"] = $_REQUEST["contrasenya"];
		$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
	}
	else {
		Header("Location: form_alta_cliente.php");
	}
	
	$_SESSION["formulario"] = $nuevoUsuario;
	$errores = validarDatosUsuario($nuevoUsuario);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_cliente.php');
	} else{
		$conexion = crearConexionBD(); 

		if (alta_cliente($conexion, $nuevoUsuario)) {
			$_SESSION["login"] = $nuevoUsuario['usuario'];
			$_SESSION["formulario"]=null;
			Header('Location: home_page.php');
		}else{
			$errores[] = "<p>El usuario ya existe ¡Inténtelo de nuevo!</p>";
			$_SESSION["errores"] = $errores;
			Header('Location: form_alta_cliente.php');
		}
		$conexion= cerrarConexionBD($conexion);
	}
	
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosUsuario($nuevoUsuario){
		// Validación del DNI
		if($nuevoUsuario["dni"]==""){
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		}else if(
					!(preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni"])) &&
					!(preg_match("/^[0-9]{9}$/", $nuevoUsuario["dni"])) ){
			$errores[] = "<p>El NIF no es valido: " . $nuevoUsuario["dni"]. "</p>";
		}

		// Validación del Nombre			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		
		// Validación del Apellidos			
		if($nuevoUsuario["apellidos"]=="") 
			$errores[] = "<p>Debe introducir sus apellidos</p>";
		
		// Validación de la Direccion		
		
		if($nuevoUsuario["direccion"]==""){ 
			$errores[] = "<p>Debe introducir su direccion</p>";
		}else if(strlen($nuevoUsuario["direccion"])>256){
		$errores []= "<p>La dirección no debe superar los 256 caracteres </p>";
		}
		//Validacion Telefono
		if($nuevoUsuario["telefono"]==""){
			$errores[]= "<p> Debe introducir un numero de telefono </p>"; 
		}elseif(!preg_match("/[0-9]{9}/", $nuevoUsuario["telefono"])){
			$errores[]= "<p> El telefono debe tener 9 digitos </p>";
		}
	
	
		// Validación del email
		if($nuevoUsuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
		}
		
		
		// Validación de la contraseña
		if(!isset($nuevoUsuario["contrasenya"]) || strlen($nuevoUsuario["contrasenya"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contrasenya"]) || 
			!preg_match("/[A-Z]+/", $nuevoUsuario["contrasenya"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contrasenya"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}else if($nuevoUsuario["contrasenya"] != $nuevoUsuario["confirmpass"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
	
		return $errores;
	}



?>

