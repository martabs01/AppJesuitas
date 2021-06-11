<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario Inicial
        if(!isset($_POST["modificar"])) {
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
                    $id = $fila["idLugar"];
                    $nom = $fila["NombreLugar"];
                    echo '<option value="'.$id.'">'.$nom.'</option>';
                }
            }
            echo '</select>
                      <br><br>
                      <label for="lugar">Nombre Lugar</label>
                      <br><br>
                      <input type="text" name="lugar">
                      <br><br>
                      <input type="submit" name="modificar" value="MOFICAR LUGAR">
                      <br><br>
                      <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER</a>
                      <br>
            </form>';
        }else {
            //Consulta para dar de baja el lugar seleccionado
            $sql = "UPDATE lugares SET NombreLugar='".$_POST["lugar"]."' WHERE idlugar='".$_POST["lugares"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobar()>0){
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <br><br>
                Lugar modificado correctamente
                <br><br>
                <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER GESTION LUGARES</a>';
            }else{
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <label id="error">Error no existen lugares para modificar</label>
                <br><br>
                <a href="Insertar.php">Der de alta un lugar</a>';
            }
        }
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="../LoginGestionesAdmin/Inicio.php">Inicar Sesion</a>';
    }

?>
