<?php
session_start();
require_once("gestionarClientes.php");
require_once ("gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	$formulario['nombre'] = "";
	$formulario['apellidos'] = "";
	$formulario['direccion'] = "";
	$formulario['telefono'] = "";
	$formulario['dni'] = "";
	$formulario['email'] = "";
	$formulario['usuario'] = "";
	$formulario['contrasenya'] = "";

	$_SESSION['formulario'] = $formulario;
	$_SESSION['errores'] = null;
	$_SESSION['exito'] = null;
} else {
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"]))
	$errores = $_SESSION["errores"];
// $conexion= crearConexionBD();
// $clientes= consultarUsuarios($conexion);
// foreach ($clientes as $cliente) {
	// echo "$cliente";
// }
// 
// cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cactus Colección</title>
		<meta charset="UTF-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="js/validarPass.js"></script>
		<link rel="stylesheet" href="css/password.css">
	</head>
	<body>
		<script src="code.jquery.com/jquery-3.5.1.js"></script>
		<?php
		include_once ("/header/header.php");
		?>


		<div class="container">
		<form id="altaCliente" method="post" action="validacion_alta_cliente.php" novalidate>
		<div class="DatosPersonales">
			
		<?php
		if (isset($errores) && count($errores) > 0) {
			echo "<h4> Errores en el formulario:</h4>";
			echo "<div id=\"div_errores\" class=\"error\">";
			foreach ($errores as $error)
				echo $error;
			echo "</div>";
		}
		?>
		
		
		<div id="msg"></div>
		<h2>Datos Personales</h2>
		<label for="name">Nombre:</label>
		<input type="text" id="nombre" name="nombre" value="<?php echo $formulario['nombre']; ?>" required><br><br>
		<label for="lname">Apellidos:</label>
		<input type="text" id="apellidos" name="apellidos" value="<?php echo $formulario['apellidos']; ?>" required><br><br>
		<label for="address">Dirección:</label>
		<input type="text" id="direccion" name="direccion" value="<?php echo $formulario['direccion']; ?>" required><br><br>
		<label for="telefono">Teléfono:</label>
		<input type="text" id="telefono" name="telefono" value="<?php echo $formulario['telefono']; ?>" required><br><br>
		<label for="email">Dirección de e-mail:</label>
		<input type="email" id="email" name="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['email']; ?>" required><br><br>
		<label for="dni">DNI:</label>
		<input type="text" id="dni" name="dni" placeholder="Introduzca su DNI" pattern="[0-9]{8}[A-Za-z]{1}" value="<?php echo $formulario['dni']; ?>" required/> <br><br>

		</div>
		<div class="DatosUsuario">
		<h2>Datos de Usuario</h2>
		<label for="username">Usuario:</label><br>
		<input type="text" id="usuario" name="usuario" value="<?php echo $formulario['usuario']; ?>" required><br>
		<label for="pwd">Contraseña:</label><br>
		<input type="password" id="contrasenya" name="contrasenya" onkeyup="passwordColor();"
                oninput="document.getElementById('validacion').innerHTML=passwordValidation();" required>
		</div>	<span id="validacion"></span>
		
		<div><label for="confirmpass">Confirmar contraseña: </label><br>
		<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
		</div>
		
		<input class="restablecer" type="reset" value="Restablecer">
		<input type="submit" value="Registrarse">

		</form>
		<p> Al registrarse, acepta nuestras Condiciones de uso y Política de privacidad</p>
		<p> ¿Ya tiene una cuenta?</p><a href="login.php">Iniciar Sesión</a>

		</div>
		<script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
	</body>
</html>