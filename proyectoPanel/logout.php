<?php

//Destuir sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o cualquier otra página
header("Location: ./");
exit;
?>