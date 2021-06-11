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
               <label for="lugar">Maquinas</label>
               <br><br>';
            //Desplegable con el ip de las maquinas que vamos a seleccionar para darlade baja
            $datos = 'SELECT * FROM Maquinas';
            $objeto->hacerConsultas($datos);
            if ($objeto->comprobarSelect() > 0) {
                echo '<select name="maquina">';
                while ($fila = $objeto->extraerFilas()) {
                    $nom = $fila["ip"];
                    echo '<option value="'.$nom.'">'.$nom.'</option>';
                }
            }
            echo ' </select>
                       <br><br>
                       <input type="submit" name="borrar" value="BORRAR MÁQUINA">
                       <br><br>
                       <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER</a>
                       <br>
            </form>';
        }else {
            //Consulta para dar de baja la maquina cuya ip ha sido seleccionada
            $sql = "DELETE FROM maquinas WHERE ip='".$_POST["maquina"]."'";
            $objeto->hacerConsultas($sql);
            if($objeto->comprobar()>0){
                echo 'Maquina borrada correctamente
                      <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER GESTION MAQUINAS</a>';
            }else{
                echo 'Error maquina no borrada correctamente';
            }
        }
    }else{
        echo ' 
            Debes iniciar sesion para acceder a este sitio
            <br><br>
            <a href="../LoginGestionesAdmin/Inicio.php">Inicar Sesion</a>';
    }

?>
