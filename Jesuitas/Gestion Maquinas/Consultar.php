<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario Inicial
        if(!isset($_POST["botonConsultar"])) {
            echo '
            <form action="#" method="POST">
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <label for="lugar">Maquinas</label>
               <br><br>';
            //Desplegable con el ip de las maquinas que vamos a seleccionar para consultar sus datos
            $datos = 'SELECT * FROM Maquinas';
            $objeto->hacerConsultas($datos);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="maquina">';
                while ($fila = $objeto->extraerFilas()) {
                    $nom = $fila["ip"];
                    echo '<option value="'.$nom.'">'.$nom.'</option>';
                }
            }
            echo '  </select>
                       <br><br>
                       <input type="submit" name="botonConsultar" value="CONSULTAR MÁQUINA">
                       <br><br>
                       <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER</a>
                       <br>
            </form>';
        }else {
            //Consulta de los datos cuya ip de la maquina ha sido seleccionada
            $sql = "SELECT * FROM maquinas WHERE ip='".$_POST["maquina"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobarSelect()>0){
                $fila=$objeto->extraerFilas();
                $ip = $fila["ip"];
                $lugar=$fila["lugar"];
                $jesuita=$fila["jesuita"];
                $alumno=$fila["nombreAlumno"];
                $firma=$fila["firma"];
                echo '
                <link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                <br><br>
                IP maquina:'.$ip.'<br>Lugar:'.$lugar.'<br>Jesuita:'.$jesuita.'<br>Alumno:'.$alumno.'<br>Firma:'.$firma.
                    '<br><br>
                <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER GESTION MAQUINAS</a>';
            }else{
                if($objeto->comprobarSelect()<1){
                    echo '
                    <link rel=stylesheet href=../Estilos.css>
                    <div id="imagen"><img src="../jesuitas.png"></div>
                    <br><br>
                    <label id="error">Error consultar datos, no existen maquinas aun</label>
                    <br><br>
                    <a href="Insertar.php">Dar de alta maquina</a>';
                }else{
                    echo '
                    <link rel=stylesheet href=../Estilos.css>
                    <div id="imagen"><img src="../jesuitas.png"></div>
                    <br><br>
                    <label id="error">Error consultar datos</label>
                    <br><br>
                    <a href="Consultar.php">Volver consultar maquina</a>';
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
