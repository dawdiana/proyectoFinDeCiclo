<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start(); // Iniciamos sesión 

    include './funcionesPedido.php';


    //Conexión a la BD
    $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
    mysqli_set_charset($db, "utf8");


    //Guardar consultas en variables

    $queryMenu = "SELECT * FROM plato WHERE tipo = 'menu'";
    $resMenu = mysqli_query($db, $queryMenu);
    
    $querySnack = "SELECT * FROM plato WHERE tipo = 'snack'";
    $resSnack = mysqli_query($db, $querySnack);
    
    $queryPostre = "SELECT * FROM plato WHERE tipo = 'postre'";
    $resPostre = mysqli_query($db, $queryPostre);
    
    $db->close();
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pups Pantry</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--ESTILO PANTALLAS PEQUEÑAS (MÓVILES) -->
    <link rel='stylesheet' href='./estilosIndex/indexMovil.css' media='(max-width: 540px)'/>
    <!--ESTILO PANTALLAS MEDIANAS (TABLETS) -->
    <link rel='stylesheet' href='./estilosIndex/indexTablet.css' media='(min-width: 541px) and (max-width: 720px)'/>
    <!--ESTILO PANTALLAS GRANDES (ORDENADORES) -->
    <link rel='stylesheet' href='./estilosIndex/index.css'/>

</head>
<body>
    <div class="cabecera">
       <div class="d1">
            <img class="logo" src="./Imagenes/iconosLogo/logo.png" alt="Logo página"/>
       </div> 
        <div class="d2">
            <a href="./paginaPago/paginaPago.php"> 
                <img class="icoCompra" src="./Imagenes/iconosLogo/iconoCompra.png"/>  <!--Se actualiza cuando añadimos productos al carrito-->
            </a>
            <p id="cantidadCarrito">0</p>
        </div>
    </div>

    
    <div class="cuerpo">


        <!--Carta de la página-->


        <div class="menu">
            
        
            <div class="tituloPatita">
                <img class="icoPatita" src="./Imagenes/iconosLogo/iconoPatita.png" alt="Icono de patita"/>
                <h1 class="titMenu">Nuestra Carta</h1>
            </div>
            
            
            <!-- Muestra los platos de tipo snack -->

            <h2 class="nombreCat">SNACKS</h2>

                <div class="contenedorEtiquetas">

                    <?php 
                        while ($plato = mysqli_fetch_array($resSnack)) {
                        ?>
                            <div class="etiqueta">
                                <div class="cebeceraEtiqueta">              
                                    <h3 class="tituloPlato"><?php echo $plato['nombre'];?></h3>
                                    <div class="precio">
                                        <p><?php echo $plato['precio'];?> €</p>
                                        <button class="botonAñadir" id="<?php echo $plato['idPlato'];?>"><img class="icoMas" src="./Imagenes/iconosLogo//iconoMas1.png" alt="Icono suma"/></button>
                                        <button class="botonEliminar" id="<?php echo $plato['idPlato'];?>"><img class="icoMenos" src="./Imagenes/iconosLogo//iconoMenos.png" alt="Icono resta"/></button>
                                    </div>   
                                </div>
                                <div class="imgTexto">
                                    <?php 
                                        if($plato['imagen']){
                                            echo '<img class="fotoCom" src="./Imagenes/platos/'.$plato['imagen'].'" alt="Imagen plato"/>';
                                        } else {
                                            echo '<img class="fotoCom" src="./Imagenes/platos/noImagen.png" alt="Imagen falta plato"/>';
                                        }
                                    ?>
                                    <p><?php echo $plato['descripcion'];?></p>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                
            </div>


            <!-- Muestra los platos de tipo menú -->

            
            <h2 class="nombreCat">GOURMET</h2>
            
            <div class="contenedorEtiquetas">

                <?php 
                // Recorre el resultado
                while ($plato = mysqli_fetch_array($resMenu)) {
                ?>
                    <div class="etiqueta">
                        <div class="cebeceraEtiqueta">              
                            <h3 class="tituloPlato"><?php echo $plato['nombre'];?></h3>
                            <div class="precio">
                                <p><?php echo $plato['precio'];?> €</p>
                                <button class="botonAñadir" id="<?php echo $plato['idPlato'];?>"><img class="icoMas" src="./Imagenes/iconosLogo/iconoMas1.png" alt="Icono suma"/></button>
                                <button class="botonEliminar" id="<?php echo $plato['idPlato'];?>"><img class="icoMenos" src="./Imagenes/iconosLogo/iconoMenos.png" alt="Icono resta"/></button>
                            </div>   
                        </div>
                        <div class="imgTexto">
                            <?php 
                                if($plato['imagen']){
                                    echo '<img class="fotoCom" src="./Imagenes/platos/'.$plato['imagen'].'" alt="Imagen plato"/>';
                                 } else {
                                    echo '<img class="fotoCom" src="./Imagenes/platos/noImagen.png" alt="Imagen falta plato"/>';
                                }
                            ?>
                            <p><?php echo $plato['descripcion'];?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
         

              <!-- Muestra los platos de tipo postre -->


                <h2 class="nombreCat">POSTRES</h2>

                <div class="contenedorEtiquetas">

                    <?php 
                        while ($plato = mysqli_fetch_array($resPostre)) {
                        ?>
                            <div class="etiqueta">
                                <div class="cebeceraEtiqueta">              
                                    <h3 class="tituloPlato"><?php echo $plato['nombre'];?></h3>
                                    <div class="precio">
                                        <p><?php echo $plato['precio'];?> €</p>
                                        <button class="botonAñadir" id="<?php echo $plato['idPlato'];?>"><img class="icoMas" src="./Imagenes/iconosLogo/iconoMas1.png" alt="Icono suma"/></button>
                                        <button class="botonEliminar" id="<?php echo $plato['idPlato'];?>"><img class="icoMenos" src="./Imagenes/iconosLogo/iconoMenos.png" alt="Icono resta"/></button>
                                    </div>   
                                </div>
                                <div class="imgTexto">
                                    <?php 
                                        if($plato['imagen']){
                                            echo '<img class="fotoCom" src="./Imagenes/platos/'.$plato['imagen'].'" alt="Imagen plato"/>';
                                        } else {
                                            echo '<img class="fotoCom" src="./Imagenes/platos/noImagen.png" alt="Imagen falta plato"/>';
                                        }
                                    ?>
                                    <p><?php echo $plato['descripcion'];?></p>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                    
                </div>

        </div>

        <div class="footer">
            <p>Pup´s Pantry</p>
            <p>600 630 621</p>

            <div class="condiciones">
                <a href="#">Aviso Legal</a>
                <a href="#">Política de Cookies</a>
                <a href="#">Accesibilidad</a>
            </div>


        </div>

    </div>

        <script>


            // Cuando la página se carga, hace una solicitud al servidor para obtener el valor actual del carrito
            $(document).ready(function() {
                $.ajax({
                    url: './funcionesCarrito/mostrarValorCarrito.php', // Ruta al script PHP que obtiene el valor del carrito
                    type: 'GET', // Método de solicitud
                    success: function(response) { // Función a ejecutar cuando la solicitud tiene éxito
                        $("#cantidadCarrito").text(response); // Actualizar el contador del carrito en el DOM
                    },
                    error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                        console.error('Error al obtener el valor del carrito:', error);
                    }
                });
            });                


            $(".botonAñadir").click(function() {
                console.log("Botón de sumar pulsado");
                var productId = $(this).attr('id'); // Obtener el ID del producto del botón
                console.log("ID del producto: " + productId);
               
                $.ajax({
                    url: './funcionesCarrito/sumarCarrito.php', 
                    type: 'POST', 
                    data: { productId: productId }, // Datos a enviar al servidor (ID del producto)
                    success: function(response) {
                        $("#cantidadCarrito").text(response); 
                    },
                    error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                        console.error('Error al agregar producto al carrito:', error);
                    }
                });
            });

            $(".botonEliminar").click(function() {
                console.log("Botón de restar pulsado");
                var productId = $(this).attr('id');
                console.log("ID del producto: " + productId);

                $.ajax({
                    url: './funcionesCarrito/restarCarrito.php',
                    type: 'POST',
                    data: { productId: productId },
                    success: function(response) {
                        $("#cantidadCarrito").text(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar producto del carrito:', error);
                    }
                });
            });

    </script>

</body>
</html>