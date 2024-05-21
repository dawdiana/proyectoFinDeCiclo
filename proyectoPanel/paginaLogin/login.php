<?php

    $usuario_posteado = $_POST['usuario'];
    $contrasena_posteada = $_POST['contrasena'];

    if($usuario_posteado!=''){  //Venimos de enviar el formulario

        //Comprobar si el usuario y contraseña enviada por POST son correctos
        $query="SELECT * FROM restaurante WHERE usuario='$usuario_posteado' AND contrasena='$contrasena_posteada'";
        $query_result = mysqli_query($db, $query) or die('Query error');
        if (mysqli_num_rows($query_result) > 0) {

			$_SESSION['user'] = $usuario_posteado;
            $_SESSION['pass'] = $contrasena_posteada;
			header('Location: index.php?pag=pedidos');

        }else{
            //El usuario y contraseña no son correctos
            $mensajeError="El usuario y contraseña no son correctos";
        }

    }

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Master</title>
    <link rel='stylesheet' href='./paginaLogin/login.css'/>
</head>
<body>
    <div class="cabecera">
        <img class="logo" src="imagenesPanel/iconos/logoOrderMaster.png" alt="Logo de la página"/>
    </div>

    <div class="cuerpo">

        <div class="contenedorForm">
            
            <form class="formulario" action="index.php" method="post">
                <div class="etiquetaR">
                    <div class="icoLabel">
                        <img class="iconoU" src="imagenesPanel/iconos/iconoUsuario2.png" alt="Icono de usuario"/>
                        <label for="usuario">Usuario:</label>
                    </div>
                    <input type="text" id="usuario" name="usuario"/>
                </div>
                <div class="etiquetaR">
                    <div class="icoLabel">
                        <img class="iconoC" src="imagenesPanel/iconos/iconoCont.png" alt="Icono de contraseña"/>
                        <label for="contrasena">Contraseña:</label>
                    </div>
                    <input type="password" id="contrasena" name="contrasena"/>
                </div>
                <?php
                    echo '<div class="error">'.$mensajeError.'</div>';
                ?>
                <div class="contBoton">
                    <button class="boton" type="submit">Iniciar Sesión</button>
                </div>
                    

                <hr>

                <div class="dReg">
                    <p>¿No tienes cuenta?</p>
                    <a href="#">Formulario de registro</a>

                </div>
                
            </form>


        </div>



    </div>


</body>
</html>

