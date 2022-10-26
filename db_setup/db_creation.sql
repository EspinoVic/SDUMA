/*DROP DATABASE databasename;*/


/*Entidad MotivoConstruccion */
CREATE TABLE `sduma_db`.`motivoconstruccion`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0, 
  PRIMARY KEY (`id`)
  ) 
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
CREATE TABLE `sduma_db`.`contacto`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `Email` VARCHAR(45), 
  `Telefono` varchar(15) , 
  PRIMARY KEY (`id`)
  ) 
  ENGINE = InnoDB;


/*Entidad GeneroConstrucción*/
CREATE TABLE `sduma_db`.`generoconstruccion`
 (`id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL , 
  `deleted` BIT NOT NULL DEFAULT 0 , 
  PRIMARY KEY (`id`)
  ) 
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

/*Entidad Roles*/
CREATE TABLE `sduma_db`.`roles`
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

