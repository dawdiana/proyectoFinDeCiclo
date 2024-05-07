<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start(); // Iniciamos sesión 

    //Conexión a la BD
    $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
    mysqli_set_charset($db, "utf8");

    include 'funcionesPedido.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu pedido</title>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel='stylesheet' href='pago.css'/>

</head>
<body>
    <div class="cabecera">
        <div class="d1">
            <a href="index.php">
             <img class="logo" src="Imagenes/iconosLogo/logo.png" alt="Logo página"/>
            </a>
        </div> 
         <div class="d2">
             <img class="icoCompra" src="Imagenes/iconosLogo/iconoCompra.png" alt="Icono de compra"/>
             <p id="cantidadCarrito">0</p> 

        </div>
    </div>
     
     <div class="cuerpo">
        <h1>Tu pedido</h1>
        <div class="contenedorPedido">              
       
            <?php            
               
                $precio=0;  //el precio de cada plato
                $precioLinea=0; //suma del precio total de cada linea
                $precioTotal=0; //precio total de todo el pedido (suma de cada línea)
                
                if(count($_SESSION['cart']) > 0){

                    foreach ($_SESSION['cart'] as $productId => $aDatos) {
                    
                        $productoNombre = obtenerNombrePlato($productId, $db);
                        $productoPrecio = obtenerPrecioPlato($productId, $db);
                        
                        $totalLinea = $aDatos['cantidad'] * $productoPrecio;
                        $precio=$precio + $totalLinea;
            
                        echo "<div class='lineaP'>";
                        echo "<a href='?idBorrar=$productId' class='botonEliminar' id='$productId'><img class='icoMenos' src='Imagenes/iconosLogo/iconoMenos.png'/></a>";
                        echo "<p class='cantidad'>x".$aDatos['cantidad']."</p>";
                        echo "<p class='nombreP'>".$productoNombre."</p>";
                        echo "<p class='precioL'>".$totalLinea." €</p>";
                        echo "<br>";
                        echo "</div>";
            

                    // echo $aDatos['cantidad']." ".$productoNombre." ".$totalLinea."<br><br>";            

                        
                        $precioTotal = $precioTotal + $totalLinea;
                    }

                    echo "<hr>";
                    echo "<p class='pTotal'>Precio total = ".$precioTotal." €<p>";
                    echo "<hr>";

                    ?>

                    <div class="contenedorForm">
                        <h3>Detalles de la entrega</h3>

                        <form class="formularioPago" action="guardarPedido.php" method="POST">
                                <div>
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" required>
                                </div>
                                <div>
                                    <label for="apellido1">Apellido 1:</label>
                                    <input type="text" id="apellido1" name="apellido1" required>
                                </div>
                                <div>
                                    <label for="apellido2">Apellido 2:</label>
                                    <input type="text" id="apellido2" name="apellido2">
                                </div>
                                <div>
                                    <label for="correoE">Correo Electrónico:</label>
                                    <input type="email" id="correoE" name="correoE" required>
                                </div>

                                <div> <!--Desplegable para indicar el tipo de entrega-->
                                <label for="tipoEntrega">Tipo de entrega:</label>
                                    <select id="tipoEntrega" name="tipoEntrega" required>
                                        <option value="recoger">Recoger en el local</option>
                                        <option value="domicilio">Entrega a domicilio</option>
                                    </select>
                                    </div>
                                
                                
                                
                                <div id="direcEnvio">
                                    <div>
                                        <label for="direccion">Dirección de envío:</label>
                                        <input type="text" id="direccion" name="direccion"></textarea>
                                    </div>
                                    <div>
                                        <label for="cp">Código postal:</label>
                                        <input type="number" id="cp" name="cp"></textarea>
                                    </div>
                                    <div>
                                        <label for="pob">Población:</label>
                                        <input type="text" id="pob" name="pob"></textarea>
                                    </div>
                                </div>

                                <button type="submit">Confirmar pedido</button>
                        </form>

                    </div>

                    <?php
                } else {
                    echo "<h2 class='titCarVacio'>No hay productos en la bolsa</h2>";
                }    
            ?>
        </div>
    </div>

      <!--Footer-->

      <div class="footer">
            <p>Pup´s Pantry</p>
            <p>600 630 621</p>

            <div class="condiciones">
                <a href="#">Aviso Legal</a>
                <a href="#">Política de Cookies</a>
                <a href="#">Accesibilidad</a>
            </div>

        </div>


    

    <script>
    $(document).ready(function() {
                $.ajax({
                    url: 'mostrarValorCarrito.php', // Ruta al script PHP que obtiene el valor del carrito
                    type: 'GET', // Método de solicitud
                    success: function(response) { // Función a ejecutar cuando la solicitud tiene éxito
                        $("#cantidadCarrito").text(response); // Actualizar el contador del carrito en el DOM
                    },
                    error: function(xhr, status, error) { // Función a ejecutar si hay un error en la solicitud
                        console.error('Error al obtener el valor del carrito:', error);
                    }
                });
            });      

            $(".botonEliminar").click(function() {
                console.log("Botón de restar pulsado");
                var productId = $(this).attr('id');
                console.log("ID del producto: " + productId);

                $.ajax({
                    url: 'restarCarrito.php',
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


            //Mirar

            // Verificar el valor inicial de tipoEntrega al cargar la página
            window.addEventListener("load", function() {
                var tipoEntrega = document.getElementById("tipoEntrega");
                var direccionE = document.getElementById("direcEnvio");
                var direccionInput = document.getElementById("direccion");

                function actualizarDireccion() {
                if (tipoEntrega.value === "domicilio") {
                    direccionE.style.display = "flex";
                    document.getElementById("direccion").required = true;
                } else {
                    direcEnvio.style.display = "none";
                    document.getElementById("direccion").required = false;
                }
            }


            actualizarDireccion();
            tipoEntrega.addEventListener("change", actualizarDireccion);

            }); 

    </script>
</body>
</html>

<!--
        IMPORTANTE .> CERRAR LAS VARIABLES DE SESIÓN 

-->

<?php

$db->close();

?>