<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario inicial
        if(!isset($_POST["botonConsultar"])) {
            echo '
            <form action="#" method="POST">
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <label for="lugar">Lugares</label>
                <br><br>';
            //Desplegable con el nombre del lugar que vamos a seleccionar para consultar sus datos
            $datos = 'SELECT * FROM Lugares';
            $objeto->hacerConsultas($datos);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="lugar">';
                while ($fila = $objeto->extraerFilas()) {
                    $nom = $fila["NombreLugar"];
                    echo '<option value="'.$nom.'">'.$nom.'</option>';
                }
            }
            echo '</select>
                      <br>
                      <br>
                      <input type="submit" name="botonConsultar" value="CONSULTAR LUGAR">
                      <br><br>
                      <a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER</a>
                      <br>        
            </form>';
        }else {
            //Consulta de los datos cuya lugar ha sido seleccionado
            $sql = "SELECT * FROM lugares WHERE NombreLugar='".$_POST["lugar"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobarSelect()>0){
                $fila=$objeto->extraerFilas();
                $id = $fila["idLugar"];
                $nom=$fila["NombreLugar"];
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>   
                <br><br>ID LUGAR:'.$id.'<br>Lugar:'.$nom.
                    '<br><br><a href="../LoginGestionesAdmin/GestionLugares.php">VOLVER GESTION LUGARES</a>';
            }else{
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <br><br>
                <label id="error">Error consultar datos, no existen lugares aun</label>
                <br><br>
                <a href="Insertar.php">Dar de alta un lugar</a>';
            }
        }
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="../LoginGestionesAdmin/Inicio.php">Inicar Sesion</a>';
    }

?>
