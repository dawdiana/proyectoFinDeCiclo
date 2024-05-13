<?php


    $query_tipo = "SELECT distinct tipo FROM plato";
    $result_tipo = mysqli_query($db, $query_tipo);

    if (!$result_tipo) { //si no hay resultado, avisa de ha habido un error
        die("Error en la consulta: " . mysqli_error($db));
        
    }

   // $query_plato = "SELECT nombre, precio, descripcion, imagen FROM plato WHERE tipo='$tipo'";
    //$result_plato = mysqli_query($db, $query_platos);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Carta</title>
    <link rel='stylesheet' href='./paginaModificarCarta/modificarCarta.css'/>

</head>
<body>
<div class="cabecera">
        <div class="contIcono">
            <img class="icoCerrarSesion" src="imagenesPanel/iconoCerrarSesion.png" alt="Icono cierre de sesión"/>
            <a href="index.php?pag=pedidos"><img class="iconoCasa" title="Volver a página principal" src='imagenesPanel/iconoCasa4.png' alt="Icono de casa"/></a>
        </div>
        <div class="contLogo">
        <a href="index.php?pag=pedidos"><img class="logo" src="imagenesPanel/logoOrderMaster.png" alt="Imagen logo"/></a>
        </div>    
    </div>
    
    <h2>Modificar Carta</h2>

    <!-- hacer tabla con informacion de la carta, ¿Categorías? ¿Con orden de prioridad?-->
    
    <div class="contenedorCategorias">

    <?php

        while($tipo_row = mysqli_fetch_array($result_tipo)) {
            $tipo = $tipo_row['tipo'];

    ?>
        
        <hr>

        <h3>Categoría: <?php echo $tipo; ?></h3>

        <table class="categoria"> 
            <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
            </tr>

        <?php

            $query_plato = "SELECT nombre, precio, descripcion, imagen FROM plato WHERE tipo='$tipo'";
            $result_plato = mysqli_query($db, $query_plato);
            if (!$result_plato) {
                die("Error en la consulta de platos: " . mysqli_error($db));
            }

            while ($plato = mysqli_fetch_assoc($result_plato)) {
        ?>
            <tr>
                <td><?php echo $plato['nombre'];?></td>
                <td><?php echo $plato['precio'];?>€</td>
                <td><?php echo $plato['descripcion'];?></td>
                <td><?php echo $plato['imagen'];?></td>
                <td><a href='index.php?pag=modificarProducto&id=' title='Modificar producto'><img class='iconoMod' src='imagenesPanel/iconoModificar.png' alt='Icono modificar'></a></td>
            </tr>
        
            <?php
                
                }
            ?>
            
            

    </table>


    <?php
                
         }
     ?>
    </div>

</body>
</html>
