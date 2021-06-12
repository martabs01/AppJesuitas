<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario Inicial
        if(!isset($_POST["insertar"])) {
            echo '
            <form action="#" method="POST">
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <label for="lugar">Nombre Lugar</label>
               <br>
               <input type="text" name="lugar">
               <br><br>
               <input type="submit" name="insertar" value="AÑADIR LUGAR">
               <br><br>
               <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER</a>
               <br>
            </form>';
        }else {
            //Comprobacion de los campos rellenos en el formulario
            if(empty($_POST["lugar"])){
                echo '
                Debe rellenar los campos del formulario
                <br><br>
                <a href="Insertar.php">Volver al formulario inicial</a>';
            }else{
                //Dar de alta a un lugar
                $sql = "INSERT INTO lugares (NombreLugar) VALUES 
            ('".$_POST["lugar"]."')";
                $objeto->hacerConsultas($sql);
                if($objeto->comprobar()>0){
                    echo '
                   <link rel=stylesheet href=../Estilos.css>
                   <div id="imagen"><img src="../jesuitas.png"></div>
                   <br>
                   Lugar añadido correctamente
                   <br><br>
                   <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER GESTION LUGARES</a>';
                }else{
                    echo '
                   <link rel=stylesheet href=../Estilos.css>
                   <div id="imagen"><img src="../jesuitas.png"></div>
                   <br>
                   <label id="error">Error lugar no añadido correctamente, este lugar ya existe</label>
                   <br><br>
                   <a href=Insertar.php>Volver añadir lugar</a>';
                }
            }
        }
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="../LoginGestionesAdmin/Inicio.php">Inicar Sesion</a>';
    }

?>

