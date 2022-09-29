<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarProductos.php");
require_once ("/header/header.php");
		$conexion = crearConexionBD();
		$consulta= consultarProductos($conexion);
		$categorias = obtenerCategorias($conexion);
		$pruebas = obtenerProductosPorCategoria($conexion, $_GET["OID_CATEGORIA"]);
		
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Cactus Colección</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link rel="stylesheet" href="css/boton-up.css">
    	<script src="js/jquery.min.js"></script>
    	<script src="js/ir_arriba.js"></script>
        <script src="js/bootstrap.min.js"></script>
	    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    </head>

    <body>
     
        <main>
        <div class="container">
            <div class="jumbotron">
                <h1>Cactus Colección</h1>                    
            </div> 
            <div id="lista">
			<fieldset style="float: left;padding-bottom: 500px;" class="categorias">
				<legend>Categorias</legend>
				<a href="home_page.php"><b>Todas las categorias</b></a>
					<?php foreach($categorias as $categoria){ ?>				
				<article class="producto">
						<a href="productosCategoria.php?OID_CATEGORIA=<?php echo $categoria["OID_CATEGORIA"]?>"><?php echo "<b>" .$categoria["NOMBRE_CAT"]?></a>
				</article>
				<?php } ?>
            </fieldset>
            </div>            
            <div class="row" style="margin-left: 200px">
            <?php foreach($pruebas as $prueba){ 
            	?> 
                <div class="col-4 col-md-2" style="padding-bottom: 50px">
                    <a href="detallesProducto.php?OID_PRODUCTO=<?php echo $prueba["OID_PRODUCTO"]?>" class="thumbnail">
                        <img src="<?php echo $prueba["IMAGEN"]; ?>" alt="Producto1"></a>
                        <span><strong><?php echo $prueba["NOMBRE"]?></strong><br></span>
                </div>
            <?php } ?>				
            </div>
          <?php
		 cerrarConexionBD($conexion);
		 ?>

        </div>
        
        <span class="ir-arriba">
            <i class="fas fa-chevron-up"></i>
        </span>

        </main>
        <script src="js/ir_arriba.js"></script>
    </body>
</html>