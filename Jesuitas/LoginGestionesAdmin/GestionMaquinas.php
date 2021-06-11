<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        echo'
            <h1>¿Que gestion quiere realizar con la maquina?</h1>
            <a href="../Gestion%20Maquinas/Insertar.php">Insertar Maquina</a>
            <br><br>
            <a href="../Asignacion%20Lugar/AsignarLugar.php">Asignar Lugar a  la Maquina</a>
            <br><br>
            <a href="../Gestion%20Maquinas/Consultar.php">Consultar Maquina</a>
            <br><br>
            <a href="../Gestion%20Maquinas/Borrar.php">Borrar Maquina</a>
            <br><br>
            <a href="Gestiones.php">VOLVER A GESTIONES</a>';
    }else{
        echo ' 
                Debes iniciar sesion para acceder a este sitio
                <br><br>
                <a href="/Inicio.php">Inicar Sesion</a>';
    }
?>