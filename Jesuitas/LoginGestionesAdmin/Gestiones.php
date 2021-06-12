<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        echo '
        <h1>HOLA ADMIN ¿QUE DESEA HACER?</h1>
        <a href="GestionMaquinas.php">Gestionar Maquinas</a>
        <br><br>
        <a href="GestionLugares.php">Gestionar Lugares</a>
        <br><br>
        <a href="../CerrarSesionAd.php">CERRAR SESION</a>';
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="/Inicio.php">Inicar Sesion</a>';
    }
?>
