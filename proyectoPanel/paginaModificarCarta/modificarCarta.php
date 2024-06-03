<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            print_r($_POST);
            if($_POST['idPlato']>0){
                //Modificar producto existente
                $idPlato = $_POST['idPlato'];
                $nuevoNombrePlato = $_POST['nombre']; 
                $nuevoPrecio = $_POST['precio'];
                $nuevaDesc = $_POST['descripcion'];
                $nuevoTipo = $_POST['tipoPlato'];            
                $modifPlato = "update plato set nombre='$nuevoNombrePlato', precio='$nuevoPrecio', descripcion='$nuevaDesc', tipo='$nuevoTipo' where idPlato = '$idPlato'";

            }else{

                //Insertar nuevo producto
                $nuevoNombrePlato = $_POST['nombre']; 
                $idRestaurante = $_POST['idRestaurante']; 
                $nuevoPrecio = $_POST['precio'];
                $nuevaDesc = $_POST['descripcion'];
                $nuevoTipo = $_POST['tipoPlato'];
                $modifPlato = "INSERT INTO plato (idPlato, fk_idRestaurante, nombre, precio, descripcion, tipo)
                VALUES ('', '$idRestaurante','$nuevoNombrePlato','$nuevoPrecio','$nuevaDesc','$nuevoTipo')"; //He decidido no añadir la opción de actualizar o añadir imagen nueva por dificultades de xampp
                echo $modifPlato;
            }

            if(mysqli_query($db, $modifPlato)){
                //Mensaje
                if($_POST['idPlato']>0){
                    $mensaje="El producto ha sido modificado con exito";
                } else {
                    $mensaje="El producto ha sido creado con exito";
                }



            }else{
                //Mensaje
                $mensaje="NO se ha podido guardar los cambios en la BD";
            }
            
    }

    if ($_GET['idBorrar']>0){

        $borrarPlato = "delete from plato where idPlato =".$_GET['idBorrar'];
        if(mysqli_query($db, $borrarPlato)){
            $mensaje="El producto ha sido eliminado con exito";
        }


    }

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

    <!--ESTILO PANTALLAS PEQUEÑAS (MÓVILES) -->
    <link rel='stylesheet' href='./paginaModificarCarta/estilos/modificarCartaMovil.css' media='(max-width: 540px)'/>
    
    <!--ESTILO PANTALLAS MEDIANAS (TABLETS) -->
    <link rel='stylesheet' href='./paginaModificarCarta/estilos/modificarCartaTablet.css' media='(min-width: 541px) and (max-width: 720px)'/>
    
    <!--ESTILO PANTALLAS GRANDES (ORDENADORES) -->
    <link rel='stylesheet' href='./paginaModificarCarta/estilos/modificarCarta.css' />


</head>
<body>


    <!-- CABECERA DE LA PÁGINA -->

    <div class="cabecera">

        <!--ICONOS DE NAVEGACIÓN-->
        <div class="iconosNav">
                    <a href="index.php?pag=pedidos" title="Lista de pedidos">
                        <img class="icoLista" src="imagenesPanel/iconos/iconoVermas.png" alt="Icono lista"/>
                    </a>
                    <a id="visitado" href="index.php?pag=modificarcarta"  title="Información Menú">
                        <img class="icoCarta" src="imagenesPanel/iconos/iconoCarta.png" alt="Icono carta"/>
                    </a>
                    <a href="index.php?pag=logout"  title="Cerrar sesión">
                        <img class="icoCerrarSesion" src="./imagenesPanel/iconos/iconoCerrarSesion3.png" alt="Icono cierre de sesión"/>
                    </a>
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
        


            <!--Mensaje tras añadir, modificar o eliminar productos-->

            <?php
                if(!empty($mensaje)){
                    echo "<div class='contMensaje'>$mensaje</div>";
                }
            ?>




            <div class="contenedorCategorias">

            <?php

                while($tipo_row = mysqli_fetch_array($result_tipo)) {
                    $tipo = $tipo_row['tipo'];

            ?>
                
                <h3>Categoría: <?php echo $tipo; ?></h3>

                <table class="categoria"> 
                    <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
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
                        <td><a href='index.php?pag=modificarproducto&id=<?php echo $plato['idPlato'];?>' title='Modificar producto'><img class='iconoMod' src='imagenesPanel/iconos/iconoModificar.png' alt='Icono modificar'></a></td>
                        <td><a href='index.php?pag=modificarcarta&idBorrar=<?php echo $plato['idPlato'];?>' onclick="confirmarBorrado(<?php echo $plato['idPlato'];?>);return false" title='Eliminar producto'><img class='iconoBor' src='imagenesPanel/iconos/iconoBorrar.png' alt='Icono eliminar'></a></td>
                        <!--Return false es para que se espere a que el usuario de la confirmación antes de eliminar, sino elimina directamente-->
                    </tr>
                        
                    <?php
                        
                        }
                    ?>
                        <td><a href='index.php?pag=modificarproducto' title='Crear producto'><img class='iconoAn' src='imagenesPanel/iconos/iconoAnadir2.png' alt='Icono añadir'></a></td>

            </table>


            <?php
                        
                }
            ?>
            </div>
                        <!--PIE DE PÁGINA-->
                        <div class="footer">
                        <div>
                            

            </div>

        <script>
        
        function confirmarBorrado(idBorrar) {
        
        // Mostrar ventana emergente de confirmación
        var confirmar = confirm("¿Estás seguro de que deseas eliminar este plato?");

        // Si el usuario confirma
        if (confirmar) {
            document.location="index.php?pag=modificarcarta&idBorrar="+idBorrar;
        } else {
                // Si el usuario cancela
                console.log("El usuario canceló la eliminación.");
            }
        }
        </script>
</body>
</html>
