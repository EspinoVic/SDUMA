/*DROP DATABASE databasename;*/


/*Entidad MotivoConstruccion */
CREATE TABLE `sduma_db`.`motivoconstruccion`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0, 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

 /* Entidad Domicilio */
CREATE TABLE /* IF NOT EXISTS */ `sduma_db`.`domicilio` (
  `Id` INT NOT NULL,
  `coloniaFraccBarrio` INT NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numExt` VARCHAR(45) NULL,
  `numInt` VARCHAR(45) NOT NULL,
  `CP` VARCHAR(45) NOT NULL,
  `entreCallesH` VARCHAR(90) NOT NULL,
  `entreCallesV` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


/*Entidad TipoPredio*/
CREATE TABLE `sduma_db`.`tipopredio`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

/*Entidad contacto*/
CREATE TABLE `sduma_db`.`contacto` (
  `Id` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


/*Entidad GeneroConstrucción*/
CREATE TABLE `sduma_db`.`generoconstruccion`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;
CREATE TABLE `sduma_db`.`generoConstruccion` (
  `Id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `deleted` BIT NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


/*Entidad TipoConstrucción*/
CREATE TABLE `sduma_db`.`tipoconstruccion`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

/*Entidad TipoTramite*/
CREATE TABLE `sduma_db`.`tipotramite`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

/*Entidad Documento*/
CREATE TABLE `sduma_db`.`documento`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;



/*Entidad Persona*/
CREATE TABLE `sduma_db`.`persona`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `apellidoP` VARCHAR(45) NOT NULL , 
  `apellidoM` VARCHAR(45) , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;


/* Entidad Usuario */

CREATE TABLE `sduma_db`.`Usuario`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `id_Propietario` BIT NOT NULL , 
  `id_Horario` BIT NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

/* Entidad Horario */

CREATE TABLE `sduma_db`.`horario`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` BIT NOT NULL , 
  `inicioActividad` TIME NOT NULL DEFAULT '8:00:00', 
  `finActividad` TIME NOT NULL DEFAULT '13:00:00' , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;
INSERT INTO sduma_db.horario
(nombre)
VALUES('general');


/*Entidad Roles*/
CREATE TABLE `sduma_db`.`rol`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;

INSERT INTO sduma_db.rol
(nombre)
VALUES('externo'),('interno'),('administrador');


/*Entidad Usuario_has_Rol*/
CREATE TABLE `sduma_db`.`usuario_has_rol`
 (`id_usuario` INT NOT NULL,
  `id_rol` VARCHAR(45) NOT NULL, 
  `ver` BIT NOT NULL DEFAULT 0 , 
  `editar` BIT NOT NULL DEFAULT 0 , 
  `actualizar` BIT NOT NULL DEFAULT 0 , 
  `eliminar` BIT NOT NULL DEFAULT 0 , 
   
  ) 
  ENGINE = InnoDB;
