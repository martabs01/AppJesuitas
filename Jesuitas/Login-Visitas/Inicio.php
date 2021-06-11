<?php
    require_once '../OperacionesBBDD.php';
    $objeto=new consulta();
    if(!isset($_POST["inicio"])) {
        //Formulario inicial
        echo '<form action="#" method="POST">
           <link rel=stylesheet href=../Estilos.css>
                       <div id="imagen"><img src="../jesuitas.png"></div>
                      <label for="usuario">IP Maquina</label><br/>
                      <input type="text" name="ip"><br/><br/>
                      <label for="password">Contraseña</label><br/>
                      <input type="password" name="password"><br/><br/>
                      <input type="submit" name="inicio" value="INICIAR SESIÓN"><br/>
                      </form>';
    }else {
        //Comprobacion del usuario y contraseña
        if ($objeto->iniciosesion($_POST["ip"], $_POST["password"]) == true){
            //Iniciamos sesion y guardamos la ip de la maquina si el usuario y contraseña son correctos
            session_start();
            $_SESSION["ip"]=$_POST["ip"];
            //echo $_SESSION["ip"];
            //Redireccion a la pagina visitas
            header('Location: Visita.php');
        }else{
            //Si el usuario y contraseña son incorrectos nos muestra el formulario con un mesaje de error
            echo '<form action="#" method="POST">
                  <link rel=stylesheet href=../Estilos.css>
                  <div id="imagen"><img src="../jesuitas.png"></div>
                  <label for="usuario">IP Maquina</label><br/>
                  <input type="text" name="ip"><br/><br/>
                  <label for="password">Contraseña</label><br/>
                  <input type="password" name="password"><br/><br/>
                  <input type="submit" name="inicio" value="INICIAR SESIÓN"><br/>
                  </form>
            <div id="error">Error, usuario o contraseña incorrecto</div>';
        }
    }
?>
