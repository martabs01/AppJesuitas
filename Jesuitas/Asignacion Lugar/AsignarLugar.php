<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        //Formulario Inicial
        if(!isset($_POST["botonAsignar"])) {
            echo '
            <form action="#" method="POST">
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <label for="lugar">Maquinas</label>
               <br>';
            //Desplegable con el ip de las maquinas que queremos asignar un lugar
            $datos = 'SELECT * FROM maquinas WHERE lugar IS NULL';
            $objeto->hacerConsultas($datos);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="maquina">';
                while ($fila = $objeto->extraerFilas()) {
                    $ip = $fila["ip"];
                    echo '<option value="'.$ip.'">'.$ip.'</option>';
                }
            }
            echo '</select>
                      <br><br>
                      <label for="lugar">Lugares</label>
                      <br><br>';
            //Desplegable con nombre kugar que queremos asignar
            $lugar = 'SELECT * FROM Lugares';
            $objeto->hacerConsultas($lugar);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="lugar">';
                while ($fila = $objeto->extraerFilas()) {
                    $id= $fila["idLugar"];
                    $nom = $fila["NombreLugar"];
                    echo '<option value="'.$id.'">'.$nom.'</option>';
                }
            }
            echo '  </select>
                        <br><br>
                        <input type="submit" name="botonAsignar" value="ASIGNAR LUGAR">
                        <br><br>
                        <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER</a>
                        <br>
            </form>';
        }else {
            //Consulta de los datos cuya ip de la maquina ha sido seleccionada
            $sql = "UPDATE maquinas SET lugar = '".$_POST["lugar"]."' WHERE maquinas.ip='".$_POST["maquina"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobar()>0){
                echo '
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <br><br>
               Maquina modificada correctamente
               <br><br>
               <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER GESTION MAQUINAS</a>';
            }else{
                echo '
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <br><br>
               <label for="error" id="error">Error al modificar maquina, este lugar ya tiene asignada una maquina</label>
               <br><br>
               <a href="AsignarLugar.php">Volver editar maquina</a>';
            }
        }
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="../LoginGestionesAdmin/Inicio.php">Inicar Sesion</a>';
    }

?>
