<?php
    require_once '../OperacionesBBDD.php';
    $objeto=new consulta();
    //Formulario Inicial
    if(!isset($_POST["inicio"])){
        echo'
            <form action="#" method="POST">
                <link rel="stylesheet" href="../Estilos.css">
                <div id="imagen"><img src="../jesuitas.png"></div>
                <label for="usuario">Nombre Usuario</label>
                <br>
                <input type="text" name="usuario">
                <br><br>
                <label for="contraseña">Contraseña</label>
                <br>
                <input type="password" name="password">
                <br><br>
                <input type="submit" name="inicio" value="INICIAR SESIÓN">
            </form>';
    }else{
        //Comprobacion del usuario y contraseña
        if ($objeto->admin($_POST["usuario"], $_POST["password"]) == true){
            //Iniciamos sesion y guardamos la ip de la maquina si el usuario y contraseña son correctos
            session_start();
            $_SESSION["usuario"]=$_POST["usuario"];
            //Redireccion a la pagina inicio gestiones
            header('Location: ../LoginGestionesAdmin/Gestiones.php');
        }else{
            if(empty($_POST["usuario"] && $_POST["password"]) ){
                echo'
                    <form action="#" method="POST">
                        <link rel="stylesheet" href="../Estilos.css">
                        <div id="imagen"><img src="../jesuitas.png"></div>
                        <label for="usuario">Nombre Usuario</label>
                        <br>
                        <input type="text" name="usuario">
                        <br><br>
                        <label for="contraseña">Contraseña</label>
                        <br>
                        <input type="password" name="password">
                        <br><br>
                        <input type="submit" name="inicio" value="INICIAR SESIÓN">
                    </form>
                    <div id="error">Debes rellenar los campos del formulario</div>';
            }else{
                //Si el usuario y contraseña son incorrectos nos muestra el formulario con un mesaje de error
                echo'
                    <form action="#" method="POST">
                        <link rel="stylesheet" href="../Estilos.css">
                        <div id="imagen"><img src="../jesuitas.png"></div>
                        <label for="usuario">Nombre Usuario</label>
                        <br>
                        <input type="text" name="usuario">
                        <br><br>
                        <label for="contraseña">Contraseña</label>
                        <br>
                        <input type="password" name="password">
                        <br><br>
                        <input type="submit" name="inicio" value="INICIAR SESIÓN">
                    </form>
                    <div id="error">Error, usuario o contraseña incorrecto</div>';
            }
        }
    }
?>
