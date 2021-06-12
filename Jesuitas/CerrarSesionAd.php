<?php
    //Cerrar Sesion iniciada
    session_start();
    session_destroy();
    header('location:LoginGestionesAdmin/Inicio.php');
    exit();
?>
