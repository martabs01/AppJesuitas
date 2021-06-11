<?php
    include 'ConfigBBDD.php';
    class consulta
    {
        public $mysqli;
        public $resultado;
        //Conexion base de datos
        function __construct()
        {
            $this->mysqli = new mysqli(servidor, usuario, password, basedatos);
        }
    //Preparacion de la consulta
        function hacerConsultas($sql)
        {
            $this->resultado = $this->mysqli->query($sql);
        }
    //Consultas Select
        function comprobarSelect()
        {
            return $this->resultado->num_rows;
        }
    //Consultas Insert, Delete, Update
        function comprobar(){
            return $this->mysqli->affected_rows;
        }
        function extraerFilas(){
            return $this->resultado->fetch_array();
        }
        //INICIO SESION USUARIOS ALUMNOS
        function iniciosesion($ip, $password){
            //Consulta a la base de datos
            $consulta = "SELECT * FROM maquinas WHERE ip=? ;";
            //Preparamos la consulta
            $consulta2 = $this->mysqli->prepare($consulta);
            $consulta2->bind_param("s",$ip);
            //Ejecutamos la consulta
            $consulta2->execute();
            //Obtenemos el resultado de la consulta
            $resultado=$consulta2->get_result();
            //Comprobamos usuario y contraseña
            if($resultado->num_rows>0){
                $fila = $resultado->fetch_array();
                if(password_verify($password,$fila["contraseña"])){
                    return true;
                }
            }
        }
        function admin($usuario, $password){
            //Consulta a la base de datos
            $consulta = "SELECT * FROM administrador WHERE usuario=? ;";
            //Preparamos la consulta
            $consulta2 = $this->mysqli->prepare($consulta);
            $consulta2->bind_param("s",$usuario);
            //Ejecutamos la consulta
            $consulta2->execute();
            //Obtenemos el resultado de la consulta
            $resultado=$consulta2->get_result();
            //Comprobamos usuario y contraseña
            if($resultado->num_rows>0){
                $fila = $resultado->fetch_array();
                if(password_verify($password,$fila["contraseña"])){
                    return true;
                }
            }
        }
        function numeroError(){
            return $this->mysqli->errno;
        }
        function comprobarError(){//comprobar error general
            $errno=$this->numeroError();
            if($errno==1062){
                $error="<span class='error'>ERROR: DATO REPETIDO</span><br>";
            }else{
                $error=$this->mysqli->error;
            }
            return $error;
        }
    }
?>
