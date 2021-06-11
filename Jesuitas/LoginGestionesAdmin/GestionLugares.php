<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        echo'
            <h1>¿Que gestion quiere realizar con los lugares?</h1>
            <a href="../Gestion%20Lugares/Insertar.php">Insertar Lugar</a>
            <br><br>
            <a href="../Gestion%20Lugares/Consultar.php">Modificar Lugar</a>
            <br><br>
            <a href="../Gestion%20Lugares/Consultar.php">Consultar Lugar</a>
            <br><br>
            <a href="../Gestion%20Lugares/Borrar.php">Borrar Lugar</a>
            <br><br>
            <a href="Gestiones.php">VOLVER A GESTIONES</a>';
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="/Inicio.php">Inicar Sesion</a>';
    }
?>