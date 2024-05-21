<?php


    $query_tipo = "SELECT distinct tipo FROM plato";
    $result_tipo = mysqli_query($db, $query_tipo);

    if (!$result_tipo) { //si no hay resultado, avisa de ha habido un error
        die("Error en la consulta: " . mysqli_error($db));
        
    }

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

    <div class="iconosCab">

        <!--ICONOS ARRIBA-->
        <div class="contIconoVolver">
            <a href="index.php?pag=pedidos" title="Volver a la página anterior">
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
        <h2>Información del menú</h2>
    </div>

</div>


    <!-- hacer tabla con informacion de la carta, ¿Categorías? ¿Con orden de prioridad?-->
    
    <div class="cuerpo">
        
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

                $query_plato = "SELECT idPlato, nombre, precio, descripcion, imagen FROM plato WHERE tipo='$tipo'";
                $result_plato = mysqli_query($db, $query_plato);
                if (!$result_plato) {
                    die("Error en la consulta de platos: " . mysqli_error($db));
                }

                while ($plato = mysqli_fetch_assoc($result_plato)) {
            ?>
                <tr>
                    <td><?php echo $plato['nombre'];?></td>
                    <td><?php echo $plato['precio'];?>€</td>
                    <td class="descripcion"><?php echo $plato['descripcion'];?></td>
                    <td><?php echo $plato['imagen'];?></td>
                    <td><a href='index.php?pag=modificarproducto&id=<?php echo $plato['idPlato'];?>' title='Modificar producto'><img class='iconoMod' src='imagenesPanel/iconos/iconoModificar.png' alt='Icono modificar'></a></td>
                </tr>
            
                <?php
                    
                    }
                ?>
                
                

        </table>


        <?php
                    
            }
        ?>
        </div>

        </div>

</body>
</html>
