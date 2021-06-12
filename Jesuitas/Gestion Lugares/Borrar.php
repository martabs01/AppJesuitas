<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario Inicial
        if(!isset($_POST["borrar"])) {
            echo '
            <form action="#" method="POST">
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <label for="lugar">Lugares</label>
                <br><br>';
            //Desplegable con el nombre de los lugares que vamos a seleccionar para darlo de baja
            $datos = 'SELECT * FROM Lugares';
            $objeto->hacerConsultas($datos);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="lugares">';
                while ($fila = $objeto->extraerFilas()) {
                    $nom = $fila["NombreLugar"];
                    echo '<option value="'.$nom.'">'.$nom.'</option>';
                }
            }
            echo '  </select>
                        <br><br>
                        <input type="submit" name="borrar" value="BORRAR LUGAR">
                        <br><br>
                        <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER</a>
                        <br>
            </form>';
        }else {
            //Consulta para dar de baja el lugar seleccionado
            $sql = "DELETE FROM lugares WHERE NombreLugar='".$_POST["lugares"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobar()>0){
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <br><br>
                Lugar borrado correctamente
                <br><br>
                <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER GESTION LUGARES</a>';
            }else{
                if($objeto->comprobar()<1){
                    echo '
                    <link rel=stylesheet href=../Estilos.css>
                    <div id="imagen"><img src="../jesuitas.png"></div>
                    <label id="error">Error no existen lugares todavia</label>
                    <br><br>
                    <a href="Insertar.php">Dar de alta un lugar</a>';
                }else{
                    echo '
                    <link rel=stylesheet href=../Estilos.css>
                    <div id="imagen"><img src="../jesuitas.png"></div>
                    <label id="error">Error lugar no borrado correctamente, el lugar esta asignado a una maquina</label>
                    <br><br>
                    <a href=Borrar.php>Volver borrar lugar</a>';
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
