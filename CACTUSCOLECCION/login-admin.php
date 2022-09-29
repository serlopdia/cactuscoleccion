<?php
session_start();
include_once ("gestionBD.php");
include_once ("gestionarEmpleados.php");

if (isset($_POST['submit'])) {
	$usuarioEmpleado = $_POST['usuario'];
	$password = $_POST['pass'];

	$conexion = crearConexionBD();
	$num_empleados = consultarEmpleado($conexion, $usuarioEmpleado, $password);
	cerrarConexionBD($conexion);

	if ($num_empleados == 0) {
		$error_admin = "Su usuario o contraseña no son correctos";
	} else {
		$_SESSION["login_admin"] = $usuarioEmpleado;
		Header("Location: admin/panelAdmin.php");
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Admin</title>
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" >
	</head>

	<body>

		<div class="contenedor">
			<h1> Iniciar sesión como Administrador</h1>
			<?php
			if (isset($error_admin)) {
				echo $error_admin;

			}
			?>
			<form id="iniciarSesionAdmin" method="post" action="login-admin.php">
				<i class="fas fa-user"></i>
				<input type="text" name="usuario" placeholder="Introduzca su usuario"/>
				<br />
				<i class="fas fa-key"></i>
				<input type="password" name="pass" placeholder="Introduzca su contraseña"/>
				<br />
				<input type="submit" name="submit" value="Iniciar Sesión" />
			</form>
		</div>
	</body>

</html>