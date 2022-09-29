<?php
session_start();
require_once ("../gestionBD.php");
require_once ("../gestionarClientes.php");

if(!isset($_SESSION["login_admin"])){
		header("Location: ../login-admin.php");
	}
$conexion = crearConexionBD();
if(isset($_GET["buscar"])&& $_GET["buscar"]){
	$clientes= consultaClientesBusqueda($conexion, $_GET["buscar"]);
}else{
	$clientes = consultarTodosClientes($conexion);
}

cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html>

	<head>
		<title>Mis clientes</title>
	</head>
	<body>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<div class="wrapper"> 
		 <?php
		include_once ('dashboard.php');
	?>
	
	
	
		<div class="main_content">
			
			<div class="header">Mis clientes</div>
				
			        <div class="info">
			     <div class="buscador">
			     	<h4>Buscar cliente:</h4>
					<form method="get" action="mostrarClientes.php">
						<input type="search" name= "buscar" placeholder="Buscar por..."/>
						<input type="submit" value="Buscar"/>
						
					</form>
					<form method="get" action="mostrarClientes.php">
						<input type="submit" value="Ver todos"/>
						
					</form>
					
				</div>	
				<fieldset>
						<table>
							<tr>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Email</th>
								<th>Dni</th>
								<th>Usuario</th>
								<th>Contraseña</th>
							</tr>
				<?php 
				foreach($clientes as $cliente){ 
					?>
								<tr>			
									<td class="NOMBRE" height="80px" width="120px" style="text-align: center"><b><?php echo $cliente["NOMBRE"]; ?></b></td>
									<td class="APELLIDOS" height="80px" width="200px" style="text-align: center"><b><?php echo $cliente["APELLIDOS"]; ?></b></td>
									<td class="DIRECCIÓN" height="80px" width="260px" style="text-align: center"><b><?php echo $cliente["DIRECCIÓN"]; ?></b></td>
									<td class="TELÉFONO" height="80px" width="110px" style="text-align: center"><b><?php echo $cliente["TELÉFONO"]; ?></b></td>
									<td class="EMAIL" height="80px" width="200px" style="text-align: center"><b><?php echo $cliente["EMAIL"]; ?></b></td>
									<td class="DNI" height="80px" width="120px" style="text-align: center"><b><?php echo $cliente["DNI"]; ?></b></td>
									<td class="USUARIO" height="80px" width="120px" style="text-align: center"><b><?php echo $cliente["USUARIO"]; ?></b></td>
									<td class="CONTRASEÑA" height="80px" width="120px" style="text-align: center"><b><?php echo $cliente["CONTRASENYA"]; ?></b></td>
									
								</tr>
				<?php } ?>   
				</table>  
				</fieldset>  	
 					</div>
    </div>
  </div>
  
  
  
</body>
</html>