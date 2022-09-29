<?php
session_start();
    include_once("gestionBD.php");
 	include_once("gestionarClientes.php");

if (isset($_POST['submit'])){
		$usuarioCliente= $_POST['usuario'];
		$password = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_clientes = consultarCliente($conexion,$usuarioCliente,$password);
		cerrarConexionBD($conexion);
		
		if ($num_clientes == 0)
		$error = "Su usuario no existe o su contraseña es incorrecta"; 
		else {
			$_SESSION["login"] = $usuarioCliente;
			Header("Location: home_page.php"); 
		}	
	}

if(isset($_SESSION["errorLogin"])){
	$error_login=$_SESSION["errorLogin"];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Acceso a la web</title>
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" >
	</head>

	<body>
		
		
	
		
			<div class="contenedor">
			<h1> Iniciar sesión</h1>
			<?php if (isset($error)) {
		echo $error;
	}	
	?>
			<?php if(isset($error_login)){  
				echo $error_login;
			}?>
			<form id="iniciarSesion" method="post" action="login.php">
				<i class="fas fa-user"></i>
				<input type="text" name="usuario" placeholder="Introduzca su usuario"/><br />
				<i class="fas fa-key"></i>
				<input type="password" name="pass" placeholder="Introduzca su contraseña"/><br /><br />
				<input type="submit"  id="iniciarSesion" name="submit" value="Iniciar Sesión" />
			</form>
			<p>¿No estás registrado? <a href="form_alta_cliente.php">¡Registrate!</a></p>
		</div>
	
	</body>

</html>