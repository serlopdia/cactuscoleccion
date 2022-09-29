<?php
session_start();

if (!isset($_SESSION["login"])) {
	 $error = "Debe iniciar sesión para poder continuar con su compra";
	 $_SESSION["errorLogin"] = $error;
	 header("Location: login.php");
	 exit;
}

	if(isset($_SESSION["erroresFormulario"])){
		$errores= $_SESSION["erroresFormulario"];
		unset($_SESSION["erroresFormulario"]);
	}

?>

<!DOCTYPE html>
<html>

	<head>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>

		<div class="container">
			<form method="post" action="validarPedidoCesta.php">
		<fieldset>
			<div class="container">
				
					<div class="DatosEnvioPedido">
						<h2>Datos de facturación</h2>
						<?php
		if (isset($errores) && count($errores) > 0) {
			echo "<h4> Errores en el formulario:</h4>";
			echo "<div id=\"div_errores\" class=\"error\">";
			foreach ($errores as $error)
				echo $error;
			echo "</div>";
		}
		?>
						<label for="direccion">Dirección:</label>
						<input type="text" id="direccion" name="direccion" required>
						<br>
						<br>
						<label for="cPostal">Código Postal:</label>
						<input type="number" id="cPostal" name="cPostal" required>
						<br>
						<br>
						<label for="ciudad">Ciudad:</label>
						<input type="text" id="ciudad" name="ciudad" required>
						<br>
						<br>
						<label for="pais">Seleccione su país:</label>
						<select name="pais">
							<option value="ESPAÑA">España</option>
							<option value="PORTUGAL">Portugal</option>
						</select>

						<br>
						<br>
					</div>
					<div class="tipoCobro">
						<h2>Método de pago</h2>
						<label>Seleccione su método de pago:</label>
						<br />
						<label>
							<input type="radio" name="pago" value="CONTRA REEMBOLSO" checked/>
							Contra reembolso</label>
						<br />
						<label>
							<input type="radio" name="pago" value="PAYPAL"/>
							PayPal</label>
						<br />
						<label>
							<input type="radio" name="pago" value="TRANSFERENCIA"/>
							Transferencia Bancaria</label>
						<br />
						<br>
						<br>

					</div>
			
				
			</div>
		</fieldset>
		
	
			<input type="submit" value="finalizar Compra">
				
		</form>
		</div>
		
		<script src="js/codigoPostal.js">
			
		</script>
	</body>

</html>