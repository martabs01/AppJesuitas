<?php
    require_once 'OperacionInstalador.php';
    $objeto=new instalador();
    if(!isset($_POST["lanzar"])) {
    echo '<h1>Bienvenido, pulse para lanzar la app</h1>
            <br>
            <form action="#" method="post">
                <input type="submit" name="lanzar" value="LANZAR APP">
            </form>
            ';
    } else{
        $instalador ="
        CREATE DATABASE IF NOT EXISTS Jesuitas DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
        USE Jesuitas;
        
        CREATE TABLE Lugares(
            idLugar tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            NombreLugar varchar(50) NOT NULL UNIQUE
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
        
        CREATE TABLE Maquinas(
            ip char(15) NOT NULL PRIMARY KEY,
            lugar tinyint unsigned NULL UNIQUE,
            jesuita varchar(50) NOT NULL UNIQUE,
            nombreAlumno varchar(60) NOT NULL,
            contraseña char(255) NOT NULL,
            firma varchar(200) NOT NULL,
            CONSTRAINT Lugar_Maquina FOREIGN KEY (lugar) REFERENCES Lugares(idLugar)
            )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
        
        CREATE TABLE Visita(
            idVisita  smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            ipLugar char(15) NOT NULL,
            ipJesuita char(15) NOT NULL,
            fechaHora datetime NOT NULL default NOW(),
            CONSTRAINT Lugar_Visita FOREIGN KEY (ipLugar) REFERENCES Maquinas(ip),
            CONSTRAINT Jesuita_Visita FOREIGN KEY (ipJesuita) REFERENCES Maquinas(ip),
            CONSTRAINT CHK_IP CHECK(ipJesuita<>ipLugar)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
        
        CREATE TABLE Administrador(
            usuario char(30) NOT NULL PRIMARY KEY,
            contraseña varchar(255) NOT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
        
        CREATE UNIQUE INDEX Control_Visita ON Visita (ipLugar,ipJesuita);";
        $objeto->instalador($instalador);
        if($objeto->comprobar()>0){
            header('Location:../AltaAdministrador/Insertar.php');
        }else{
            echo '
                                Error al lanzar la app
                                <br><br>
                                <a href="LanzarApp.php">Volver</a>';
        }
    }
?>
