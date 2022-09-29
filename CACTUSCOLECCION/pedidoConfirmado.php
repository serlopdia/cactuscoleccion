<?php
session_start();
if (!isset($_SESSION["login"]) || !isset($_SESSION["cestaCompra"])) {
	/*$error="No es posible acceder si no está registrado o no añadió productos a su cesta de compra";
	 $_SESSION["errore"]=$error;
	 header("Location: ../home_page.php");*/

}
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<h2>¡Su pedido ha sido confirmado!</h2>
		<h4>¡Gracias por confiar en nosotros!</h4>
		<img src="images/logoWeb.jpg">
		<h5>El equipo de cactus colección.</h5>
		<form method="get" action="home_page.php">
			<button type="submit">
				Volver al Inicio
		</form>

	</body>
</html>