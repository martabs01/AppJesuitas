<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        require_once '../OperacionesBBDD.php';
        $objeto=new consulta();
        if(!isset($_POST["insertar"])) {
            //Formulario incial
            echo '
            <form action="#" method="POST">
               <link rel=stylesheet href=../Estilos.css>
               <div id="imagen"><img src="../jesuitas.png"></div>
               <label for="ip">IP</label>
               <br>
               <input type="text" name="ip">
               <br><br>
               <label for="jesuita">Jesuita</label>
               <br>
               <input type="text" name="jesuita">
               <br><br>
               <label for="alumno">Alumno</label>
               <br>
               <input type="text" name="alumno">
               <br><br>
               <label for="contraseña">Contraseña</label>
               <br>
               <input type="text" name="password">
               <br><br>
               <label for="repetir">Repetir Contraseña</label>
               <br>
               <input type="text" name="rpassword">
               <br><br>
               <label for="firma">Firma</label>
               <br>
               <input type="text" name="firma">
               <br><br>
               <input type="submit" name="insertar" value="AÑADIR MÁQUINA">
               <br><br>
               <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER</a>
               <br>
           </form>';
        }else {
            //Dar de alta a una maquina
            if (empty($_POST["ip"] && $_POST["jesuita"] && $_POST["alumno"]
                && $_POST["password"] && $_POST["rpassword"] && $_POST["firma"])){
                echo '
                El formulario no puede dejarse vacio
                <br><br>
                <a href="Insertar.php">Volver formulario inicial</a>';
            }else{
                if($_POST["password"]==$_POST["rpassword"]){
                    $sql = "INSERT INTO maquinas (ip, jesuita, nombreAlumno, contraseña, firma) VALUES 
                    ('".$_POST["ip"]."', '".$_POST["jesuita"]."', '".$_POST["alumno"]."'
                    , '".password_hash($_POST["password"],PASSWORD_DEFAULT)."', '".$_POST["firma"]."')";
                    $objeto->hacerConsultas($sql);
                    if($objeto->comprobar()>0){
                        echo '
                        Maquina añadida correctamente
                        <br><br>
                        <a href="../LoginGestionesAdmin/GestionMaquinas.php">VOLVER GESTION MAQUINAS</a>';
                    }else{
                        if($objeto->comprobarError()){
                            echo $objeto->comprobarError();
                            echo '<a href="Insertar.php">Volver a insertar maquina</a>';
                        }
                    }
                }else{
                    echo'
                    Las contraseñas no coinciden
                    <br><br>
                    <a href="Insertar.php">Volver a insertar maquina</a>';
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

