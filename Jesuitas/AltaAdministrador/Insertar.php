<?php
    require_once '../OperacionesBBDD.php';
    $objeto=new consulta();
    //Formulario Inicial
    if(!isset($_POST["insertar"])) {
        echo '
                <form action="#" method="POST">
                   <link rel=stylesheet href=../Estilos.css>
                   <div id="imagen"><img src="../jesuitas.png"></div>
                   <label for="usuario">Usuario</label>
                   <br>
                   <input type="text" name="usuario">
                   <br><br>
                   <label for="contraseña">Contraseña</label>
                   <br>
                   <input type="text" name="password">
                   <br><br>
                   <label for="repetir">Repetir Contraseña</label>
                   <br>
                   <input type="text" name="rpassword">
                   <br><br>
                   <input type="submit" name="insertar" value="DAR DE ALTA ADMIN">
               </form>';
    }else {
        //Dar de alta admin
        if (empty($_POST["usuario"] && $_POST["password"] && $_POST["rpassword"])){
            echo '
                    El formulario no puede dejarse vacio
                    <br><br>
                    <a href="Insertar.php">Volver formulario inicial</a>';
        }else{
            if($_POST["password"]==$_POST["rpassword"]){
                $sql = "INSERT INTO administrador (usuario, contraseña) VALUES 
                ('".$_POST["usuario"]."', '".password_hash($_POST["password"],PASSWORD_DEFAULT)."')";
                $objeto->hacerConsultas($sql);
                if($objeto->comprobar()>0){
                    header('Location:../LoginGestionesAdmin/Inicio.php');
                }else{
                    echo '
                            Error administrador no añadido correctamente
                            <br><br>
                            <a href="Insertar.php">Volver a dar de alta</a>';
                }
            }else{
                echo'
                        Las contraseñas no coinciden
                        <br><br>
                        <a href="Insertar.php">Volver a dar de alta</a>';
            }
        }
    }
?>