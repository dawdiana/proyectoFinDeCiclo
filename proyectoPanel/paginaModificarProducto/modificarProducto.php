<?php

    $query_tipo = "SELECT distinct tipo FROM plato";
    $result_tipo = mysqli_query($db, $query_tipo);


//si hay un id (en caso de que queramos modificar un producto)
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
    <title><?php echo isset($_GET['id']) ? 'Modificar producto' : 'Crear Producto Nuevo'; ?></title>
    <link rel='stylesheet' href='./paginaModificarProducto/modificarProductoMovil.css' media='(max-width: 845px)'/>
    <link rel='stylesheet' href='./paginaModificarProducto/modificarProducto.css'/>
</head>
<body>
<div class="cabecera">

    <div class="iconosCab">

        <!--ICONOS ARRIBA-->
        <div class="contIconoVolver">
            <a href="index.php?pag=modificarcarta" title="Volver a la página anterior">
                <img class="icoVolver" src="imagenesPanel/iconos/iconoVolver.png" alt="Icono de volver atrás"/>
            </a>
        </div>
        
        <div class="iconosNav">
                <div class="contIcono">
                    <a href="index.php?pag=pedidos" title="Lista de pedidos">
                        <img class="icoLista" src="imagenesPanel/iconos/iconoVermas.png" alt="Icono lista"/>
                    </a>
                </div>  
                <div class="contIcono">
                    <a id="visitado" href="index.php?pag=modificarcarta"  title="Información Menú">
                        <img class="icoCarta" src="imagenesPanel/iconos/iconoCarta.png" alt="Icono carta"/>
                    </a>
                </div>  
                <div class="contIcono">
                    <a href="index.php?pag=logout"  title="Cerrar sesión">
                        <img class="icoCerrarSesion" src="./imagenesPanel/iconos/iconoCerrarSesion3.png" alt="Icono cierre de sesión"/>
                    </a>
                </div>  
        </div>
    </div>


    <div class="contLogo">
        <a href="index.php?pag=pedidos"><img class="logo" src="imagenesPanel/iconos/logoOrderMaster.png" alt="Imagen logo"/></a>
    </div>   
        
            
    <!-- TÍTULO PÁGINA  -->
    <div class="contTitulo">
        <h2><?php echo isset($_GET['id']) ? 'Modificar producto' : 'Crear Producto Nuevo'; ?></h2>
    </div>

</div>

    <div class="cuerpo">

        <!-- FORMULARIO MODIFICAR PRODUCTO -->
        <form class="formularioModif" action="./index.php?pag=modificarcarta" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" step="1" required>


            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

                <!--Hacer desplegable para escoger el tipo-->
                <label for="tipoPlato">Tipo:</label>
                <select id="tipoPlato" name="tipoPlato" required>

                    <?php
                         while($tipo_row = mysqli_fetch_array($result_tipo)) {
                            $tipo = $tipo_row['tipo'];
                    ?>
                        <option value="<?php echo $tipo;?>"><?php echo $tipo; ?></option>
                    <?php  
                        }
                    ?>
                    </select>
            </label>


            <label for="imagen">Imagen:</label>
            
            <?php if ($producto['imagen']): ?>
                <p>Imagen actual: <?php echo $producto['imagen']; ?></p>
            <?php endif; ?>
            
            <input type="file" id="imagen" name="imagen">

            <input type="hidden" id="idPlato" name="idPlato" value="<?php echo $producto['idPlato']; ?>">

            <button type="submit" class="boton"><?php echo isset($_GET['id']) ? 'Guardar Cambios' : 'Añadir Producto'; ?></button>
        </form> 

        <div class="footer">
        <div>
    </div>

</body>
</html>