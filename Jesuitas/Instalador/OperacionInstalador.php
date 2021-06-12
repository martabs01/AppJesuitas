<?php
        include '../ConfigBBDD.php';
        class instalador{
            public $mysqli;
            public $resultado;
            //Conexion base de datos
            function __construct()
            {
                $this->mysqli = new mysqli(servidor, usuario, password);
            }
            function instalador($sql)
            {
                $this->resultado = $this->mysqli->multi_query($sql);
            }
            function comprobar(){
                return $this->mysqli->affected_rows;
            }
        }

?>

