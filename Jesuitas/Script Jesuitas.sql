
-- Base de datos BD_Jesuitas (viajes de los jesuitas)
-- DROP TABLE Jesuitas;
CREATE DATABASE IF NOT EXISTS Jesuitas DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE Jesuitas;

-- Estructura tabla Lugares
CREATE TABLE Lugares(
	idLugar tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	NombreLugar varchar(50) NOT NULL UNIQUE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Maquinas
CREATE TABLE Maquinas(
	ip char(15) NOT NULL PRIMARY KEY,
	lugar tinyint unsigned NULL UNIQUE,
	jesuita varchar(50) NOT NULL UNIQUE,
	nombreAlumno varchar(60) NOT NULL,
	contraseña char(255) NOT NULL,
	firma varchar(200) NOT NULL,
	CONSTRAINT Lugar_Maquina FOREIGN KEY (lugar) REFERENCES Lugares(idLugar)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Visita
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

CREATE UNIQUE INDEX Control_Visita ON Visita (ipLugar,ipJesuita);



INSERT INTO `lugares` (`idLugar`, `NombreLugar`) VALUES (NULL, 'Merida');
INSERT INTO `lugares` (`idLugar`, `NombreLugar`) VALUES (NULL, 'Jerusalen');
INSERT INTO `lugares` (`idLugar`, `NombreLugar`) VALUES (NULL, 'Roma');
INSERT INTO `lugares` (`idLugar`, `NombreLugar`) VALUES (NULL, 'Paris');
INSERT INTO `lugares` (`idLugar`, `NombreLugar`) VALUES (NULL, 'Marruecos');



-- El check de tipo alumno o administrador se controlaria desde otra programacion, para evitar errores pongo que el usuario por defecto sea de tipo alumno.