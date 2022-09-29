<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionarSolicitudes.php");
	
	if (!isset($_SESSION["solicitud"])) {
		$solicitud['OID_SOLICITUD'] = "";
		$solicitud['DIRECCION'] = "";
		$solicitud['NOMBRE_DESTINATARIO'] = "";
		$solicitud['TELEFONO'] = "";
		$solicitud['OID_PEDIDO'] = "";
		$solicitud['OID_EMPLEADO'] = "";
		$solicitud['TIPO'] = "";
	
		$_SESSION["solicitud"] = $solicitud;
	}
	else
		$solicitud = $_SESSION["solicitud"];

	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cactus Colección</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<div class="wrapper"> 
    <div class="main_content">
    <div class="header">Datos de envío</div> 
        
	        
			
			<fieldset >
				<legend>Datos de envío</legend>
				<label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" size="146" value="<?php echo $solicitud["DIRECCION"]; ?>"><br>     
                <label for="nombre_destinatario">Nombre del destinatario:</label>
                <input type="text" id="nombre_destinatario" name="nombre_destinatario" size="125"><br>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" size="146" ><br>            
                <label>Tipo:</label>
                	<label>
                		<input name="tipo1" type="radio" value="CERTIFICADA"/> CERTIFICADA</label>
          
                	<label>
                		<input name="tipo2" type="radio" value="ORDINARIA" /> ORDINARIA</label>
                	
                </fieldset>		
					<input id="actualizar" name="actualizar" class="actualizar" type="button" value="Actualizar solicitud"/>
					<input id="insertar" name="insertar" class="insertar" type="button" value="Solicitar envío"/>
			
			</form>
			
    </div>
</div>
	<?php
		cerrarConexionBD($conexion);
	?>
</body>
</html>
