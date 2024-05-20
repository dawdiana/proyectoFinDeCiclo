<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los detalles del producto
    $query_producto = "SELECT * FROM plato WHERE idPlato='$id'";
    $result = mysqli_query($db, $query_producto);
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($db));
    }

    //Guardamos los datos del producto en un array
    $producto = mysqli_fetch_assoc($result);
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel='stylesheet' href='./paginaModificarProducto/modificarProducto.css'/>
</head>
<body>
<div class="cabecera">
        <div class="contIcono">
           <!-- <img class="icoCerrarSesion" src="./imagenesPanel/iconoCerrarSesion3.png" alt="Icono cierre de sesión"/>-->
            <a href="index.php?pag=modificarcarta">
                <img class="icoVolver" src="imagenesPanel/iconos/iconoVolver.png" alt="Icono de volver atrás"/>
            </a>
        </div>
        <div class="contLogo">
            <a href="index.php?pag=pedidos"><img class="logo" src="imagenesPanel/iconos/logoOrderMaster.png" alt="Imagen logo"/></a>
        </div>     
    </div>

    <!-- TÍTULO PÁGINA  -->

    <div class="cuerpo">

        <div class="menu">  
            
            <div class="contTitulo">
                <h2>Modificar Producto</h2>
            </div>

            <div class="contIconosMenu">
                <a href="index.php?pag=pedidos">
                            <img class="icoLista" src="imagenesPanel/iconos/iconoVermas.png" alt="Icono lista"/>
                </a>

                <a href="index.php?pag=modificarcarta">
                            <img class="icoCarta" src="imagenesPanel/iconos/iconoCarta.png" alt="Icono carta"/>
                </a>

                <a href="#"  title="Cerrar sesión">
                    <img class="icoCerrarSesion" src="./imagenesPanel/iconos/iconoCerrarSesion3.png" alt="Icono cierre de sesión"/>
                </a>            
            </div>

        </div>

        <!-- FORMULARIO MODIFICAR PRODUCTO -->
        <form class="formularioModif" action="<?php echo isset($_GET['id']) ? 'funcionesProducto/guardarCambios.php' : 'funcionesProducto/guardarProducto'; ?>" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" step="0.01" required>


            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" value="<?php echo $producto['tipo']; ?>" required>

            <label for="imagen">Imagen:</label>
            
            <?php if ($producto['imagen']): ?>
                <p>Imagen actual: <?php echo $producto['imagen']; ?></p>
            <?php endif; ?>
            
            <input type="file" id="imagen" name="imagen">

            <button type="submit" class="boton"><?php echo isset($_GET['id']) ? 'Guardar Cambios' : 'Añadir Producto'; ?></button>
        </form> 

        <div class="footer">
        <div>
    </div>

</body>
</html>