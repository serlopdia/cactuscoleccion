<?php

if (isset($_SESSION["login"])) {
	$existe = true;
}



?>

<!DOCTYPE html>
<html>

	<head>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<header>
		<nav class="navbar navbar-default navbar-static-top" style="background-color: #3c6e3b;">
			<div class="container">
				<div class="Header">

					<div class="navbar-header">
				
						<a class="navbar-brand" href="home_page.php">Cactus Colección</a>

					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>
								<a href="home_page.php">Inicio</a>
							</li>
							<li>
								<a href="header/comprarPagar.php">Cómo comprar y pagar</a>
							</li>
							<li>
								<a href="header/contacto.php">Contacto</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Más<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="header/condiciones-envio.php">Condiciones de Envios y Devoluciones</a>
									</li>
									<li>
										<a href="header/privacidad.php">Política de privacidad</a>
									</li>
									<li>
										<a href="header/cookies.php">Política de Cookies</a>
									</li>

								</ul>
							</li>
						</ul>
    						<ul class="nav navbar-nav navbar-right">
						<?php if(isset($existe)){ ?>
							<li>
								<span class="glyphicon glyphicon-user">¡Bienvenido!</span>
							</li>
							<li>
								<form method="get" action="logout.php">
									<input type="submit" name= "desconectar"  value="Desconectar" />
								</form>
							</li>
						
						<?php } else{ ?>
							<li>
								<a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Acceder</a>
							</li>
							<li>
								<a href="form_alta_cliente.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a>
							</li>
						
						<?php } ?>
								<li>
								<a href="vistaCesta.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cesta</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
</html>