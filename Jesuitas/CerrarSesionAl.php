<?php
    //Cerrar Sesion iniciada
    session_start();
    session_destroy();
    header('location:LoginAlumnos-Visitas/Inicio.php');
    exit();
?>
