<?php
    include 'Config.php';
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
    }
?>
