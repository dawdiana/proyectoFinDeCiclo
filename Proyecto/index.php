<?php

    header('Content-Type: text/html; charset=utf-8');

    //Conexión a la BD
    $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
    mysqli_set_charset($db, "utf8");

    $queryMenu = "SELECT * FROM plato WHERE tipo = 'menu'";
    $resMenu = mysqli_query($db, $queryMenu);
    
    $querySnack = "SELECT * FROM plato WHERE tipo = 'snack'";
    $resSnack = mysqli_query($db, $querySnack);
    
    $queryPostre = "SELECT * FROM plato WHERE tipo = 'postre'";
    $resPostre = mysqli_query($db, $queryPostre);
    

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pups Pantry</title>

    <link rel='stylesheet' href='index.css'/>

</head>
<body>
    <div class="cabecera">
       <div class="d1">
            <img class="logo" src="Imagenes/logo.png" alt="Logo página"/>
       </div> 
        <div class="d2">
            <img class="icoCompra" src="Imagenes/iconocompra.png"/>
        </div>
    </div>

    
    <!--Carta de la página-->

    <div class="cuerpo">

        <div class="menu">
                
            <h1 class="titMenu">Nuestra Carta</h1>

            
            <!-- Muestra los platos de tipo snack -->

            <h2>SNACKS</h2>

                <div class="contenedorEtiquetas">

                    <?php 
                        while ($item = mysqli_fetch_array($resSnack)) {
                        ?>
                            <div class="etiqueta">
                                <div class="prueba1">              
                                    <h3><?php echo $item['nombre'];?></h3>
                                    <div class="precio">
                                        <p><?php echo $item['precio'];?>€</p>
                                        <img class="icoMas" src="Imagenes/iconoMas1.png"/>
                                    </div>   
                                </div>
                                <div class="imgTexto">
                                    <img class="fotoCom" src="Imagenes/<?php echo $item['imagen'];?>">
                                    <p><?php echo $item['descripcion'];?></p>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                
            </div>


            <!-- Muestra los platos de tipo menú -->

            
            <h2>GOURMET</h2>
            
            <div class="contenedorEtiquetas">

                <?php 
                // Recorre el resultado
                while ($item = mysqli_fetch_array($resMenu)) {
                ?>
                    <div class="etiqueta">
                        <div class="prueba1">              
                            <h3><?php echo $item['nombre'];?></h3>
                            <div class="precio">
                                <p><?php echo $item['precio'];?>€</p>
                                <img class="icoMas" src="Imagenes/iconoMas1.png"/>
                            </div>   
                        </div>
                        <div class="imgTexto">
                            <img class="fotoCom" src="Imagenes/<?php echo $item['imagen'];?>">
                            <p><?php echo $item['descripcion'];?></p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
         

              <!-- Muestra los platos de tipo postre -->


                <h2>POSTRES</h2>

                <div class="contenedorEtiquetas">

                    <?php 
                        while ($item = mysqli_fetch_array($resPostre)) {
                        ?>
                            <div class="etiqueta">
                                <div class="prueba1">              
                                    <h3><?php echo $item['nombre'];?></h3>
                                    <div class="precio">
                                        <p><?php echo $item['precio'];?>€</p>
                                        <img class="icoMas" src="Imagenes/iconoMas1.png"/>
                                    </div>   
                                </div>
                                <div class="imgTexto">
                                    <img class="fotoCom" src="Imagenes/<?php echo $item['imagen'];?>">
                                    <p><?php echo $item['descripcion'];?></p>
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

</body>
</html>