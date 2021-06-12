<?php
    //Cerrar Sesion iniciada
    session_start();
    session_destroy();
    header('location:Login-Visitas/Inicio.php');
    exit();
?>
