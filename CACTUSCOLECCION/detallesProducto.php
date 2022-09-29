<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarProductos.php");

		$conexion = crearConexionBD();
		$consulta= consultarProductos($conexion);
		if(isset($_GET["OID_PRODUCTO"])){
		$filas = obtenerNombreOid($conexion, $_GET["OID_PRODUCTO"]);
		$categorias = obtenerCategorias($conexion);
		}
		
		cerrarConexionBD($conexion);
		
		
	

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Cactus Colección</title>
        <link href="css/bootstrap.min.css" rel="stylesheet"> 
        <link href="css/style.css" rel="stylesheet">      
    </head>

    <body>
    	<script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
        include_once("header/header.php");
        ?>
		<main>
        <div class="container">
            <div class="jumbotron">
                <h1>Cactus Colección</h1>                    
            </div>  
            <div class="row">
            <?php foreach($filas as $fila){ ?> 
                <div class="col-4 col-md-2">
                        <img class="imagen" src="<?php echo $fila["IMAGEN"]; ?>" alt="Producto1">
                            <form style="padding-bottom: 50px" action="home_page.php">
								<input type="submit" value="Volver a los productos" />
							</form>
               </div>
               <div class="derecha">
                  <h1><?php echo $fila["NOMBRE"]?></h1>
                  <h4><?php echo $fila["DESCRIPCION"]?></h4>
                  <h4><b>Precio: </b><?php echo $fila["PRECIO"]?> €</h4>
                  <h4><b>Stock: </b><?php echo $fila["STOCK"] ?></h4><br>
                   <a href="cestaCompra.php?OID_PRODUCTO=<?php echo $fila["OID_PRODUCTO"]?>"><input type="button" value="Añadir a la cesta"/></a>
               </div>
            <?php } ?>				
            </div>
         
        </div>
        </main>

    </body>          		
</html>