<?php
    require_once '../OperacionesBBDD.php';
    $objeto=new consulta();
    session_start();
    if(!isset($_POST["visitar"])) {
        //Formulario inicial
        if(isset($_COOKIE)){
            echo'Ultimo lugar visitado:</br>';
            for($c=0;$c<5;$c++){
                if(isset($_COOKIE[$c])){
                    echo $_COOKIE[$c].'<br>';
                }
            }
        }
        echo '<form action="#" method="POST">
           <link rel=stylesheet href=../Estilos.css>
           <div id="imagen"><img src="../jesuitas.png"></div>
           <label for="lugar">Lugares</label><br/><br/>';
        //Desplegable con el nombre de los lugares
        //TENGO QUE GUARDAR LA IP EN LA TABLA LUGARES, PARA ESO TENGO QUE HACER UNA CONSULTA DE DOS TABLAS
        $datos = "SELECT * FROM maquinas M JOIN lugares L ON M.lugar = L.idLugar and M.ip<>'".$_SESSION["ip"]."'";
        $objeto->hacerConsultas($datos);
        if ($objeto->comprobarSelect() > 0) {
            echo '<select name="lugar">';
            while ($fila = $objeto->extraerFilas()) {
                $nom = $fila["NombreLugar"];
                $iplugar=$fila["ip"];
                echo '<option value="'.$iplugar.'">'.$nom.'</option>';
            }
        }
        echo '  </select>
                   <br/><br/><input type="submit" name="visitar" value="REALIZAR VISITA"><br><br>
                   <a href="../CerrarSesion.php">Cerrar Sesion</a>
                   </form>';
    }else {
            //Insertar una visita realizada correctamente
            $sql = "INSERT INTO visita (ipLugar, ipJesuita, fechaHora) VALUES ('".$_POST["lugar"]."','".$_SESSION["ip"]."',now())";
            //print_r($sql);
            $objeto->hacerConsultas($sql);
            if($objeto->comprobar()>0){

                echo '<link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                </br>Visita realizada correctamente</br>
                <a href=visita.php>Volver</a>';
                //Creacion de la cookie
                //$cookie ="SELECT l.NombreLugar FROM lugares l INNER JOIN maquinas m ON l.idLugar=m.lugar
                //INNER JOIN visita v ON v.ipLugar=m.ip where v.idVisita=(SELECT MAX(idVisita) FROM visita)";
                $cookie="SELECT l.NombreLugar FROM lugares l INNER JOIN maquinas m ON l.idLugar=m.lugar
                INNER JOIN visita v ON v.ipLugar=m.ip ORDER BY v.idVisita DESC LIMIT 5";
                $objeto->hacerConsultas($cookie);
                //Consulta al ultimo lugar visitado
                if($objeto->comprobarSelect()>0){
                    $i=0;
                    while ($fila=$objeto->extraerFilas()) {
                        setcookie($i,$fila["NombreLugar"],time()+36000);
                        $i++;
                    }
                    //setcookie("visitas",$lugar,time()+36000);

                }
            }else{
                echo '<link rel=stylesheet href=../Estilos.css>
                <div id="imagen"><img src="../jesuitas.png"></div>
                </br>
                <label id="error">ERROR , VISITA NO REALIZADA CORRECTAMENTE.
                    </br>El lugar ya ha sido visitado anteriormente
                </label>
                </br></br>
                <a href=visita.php>Volver a realizar visita</a>';
            }
    }
?>