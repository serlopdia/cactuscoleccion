<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarProductos.php");
require_once ("/header/header.php");
		$conexion = crearConexionBD();
		$consulta= consultarProductos($conexion);
		$categorias = obtenerCategorias($conexion);
//		$prueba = obtenerProductosPorCategoria($conexion, $_GET["OID_CATEGORIA"]);
		
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Cactus Colección</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link rel="stylesheet" href="css/boton-up.css">
	    <link rel="stylesheet" href="css/style.css">
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
			<fieldset class="categorias">
				<legend>Categorias</legend>
					<?php foreach($categorias as $categoria){ ?>				
				<article class="producto">
						<a href="productosCategoria.php?OID_CATEGORIA=<?php echo $categoria["OID_CATEGORIA"]?>"><?php echo "<b>" .$categoria["NOMBRE_CAT"]?></a>
				</article>
				<?php } ?>
            </fieldset>
            </div>
            <div class="row" style="margin-left: 200px">
            <?php foreach($consulta as $producto){ ?> 
                <div class="col-4 col-md-2" style="padding-bottom: 10px">
                    <a href="detallesProducto.php?OID_PRODUCTO=<?php echo $producto["OID_PRODUCTO"]?>" class="thumbnail">
                        <img src="<?php echo $producto["IMAGEN"]; ?>" alt="Producto1"></a>
                        <span><strong><?php echo $producto["NOMBRE"]?></strong><br></span>
                </div>
            <?php } ?>				
            </div>
          <?php
         include_once("footer.php");
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