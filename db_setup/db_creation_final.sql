START TRANSACTION;  

CREATE TABLE IF NOT EXISTS `mydb`.`MotivoConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`Domicilio` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `coloniaFraccBarrio` INT NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numExt` VARCHAR(45) NULL,
  `numInt` VARCHAR(45) NOT NULL,
  `cp` VARCHAR(45) NOT NULL,
  `entreCallesH` VARCHAR(90) NOT NULL,
  `entreCallesV` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`TipoPredio` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`Contacto` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`GeneroConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`SubGeneroConstruccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `udm` VARCHAR(10) NOT NULL,
  `tamanioLimiteInferior` DECIMAL(8,4) NOT NULL,
  `tamanioLimiteSuperior` DECIMAL(8,4) NOT NULL,
  `nombreTarifa` VARCHAR(45) NOT NULL,
  `tarifa` DECIMAL(8,5) NOT NULL,
  `fechaCreacion` DATETIME NOT NULL,
  `anioVigencia` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_GeneroConstruccion` INT NOT NULL,
  PRIMARY KEY (`id`, `id_GeneroConstruccion`),
  INDEX `fk_SubGeneroConstruccion_GeneroConstruccion1_idx` (`id_GeneroConstruccion` ASC) /* VISIBLE */,
  CONSTRAINT `fk_SubGeneroConstruccion_GeneroConstruccion1`
    FOREIGN KEY (`id_GeneroConstruccion`)
    REFERENCES `mydb`.`GeneroConstruccion` (`id`)
     )
ENGINE = InnoDB;
  

CREATE TABLE IF NOT EXISTS `mydb`.`TipoConstruccion` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` VARCHAR(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`TipoTramite` (
  `id` INT ZEROFILL NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` VARCHAR(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


 CREATE TABLE IF NOT EXISTS `mydb`.`Documento` (
  `is` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`is`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`TipoTramite_has_Documento` (
  `id_TipoTramite` INT NOT NULL,
  `id_Documento` INT NOT NULL,
  PRIMARY KEY (`id_TipoTramite`, `id_Documento`),
  INDEX `fk_TipoTramite_has_Documento_Documento1_idx` (`id_Documento` ASC) /* VISIBLE */,
  INDEX `fk_TipoTramite_has_Documento_TipoTramite_idx` (`id_TipoTramite` ASC) /* VISIBLE */,
  CONSTRAINT `fk_TipoTramite_has_Documento_TipoTramite`
    FOREIGN KEY (`id_TipoTramite`)
    REFERENCES `mydb`.`TipoTramite` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TipoTramite_has_Documento_Documento1`
    FOREIGN KEY (`id_Documento`)
    REFERENCES `mydb`.`Documento` (`is`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`SolicitudConstruccion_has_Documento` (
  `id_SolicitudConstruccion` INT NOT NULL,
  `id_Documento` INT NOT NULL,
  `isEntregado` BIT NOT NULL,
  `nombreArchivo` VARCHAR(128) NOT NULL,
  `path` VARCHAR(128) NOT NULL,
  `realNombreArchivo` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`id_SolicitudConstruccion`, `id_Documento`),
  INDEX `fk_SolicitudConstruccion_has_Documento_Documento1_idx` (`id_Documento` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_has_Documento_SolicitudConstruccio_idx` (`id_SolicitudConstruccion` ASC) /* VISIBLE */,
  CONSTRAINT `fk_SolicitudConstruccion_has_Documento_SolicitudConstruccion1`
    FOREIGN KEY (`id_SolicitudConstruccion`)
    REFERENCES `mydb`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_has_Documento_Documento1`
    FOREIGN KEY (`id_Documento`)
    REFERENCES `mydb`.`Documento` (`is`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`Persona` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidoP` VARCHAR(255) NOT NULL,
  `apellidoM` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`Horario` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `inicioActividad` TIME NULL DEFAULT '8:10:00',
  `finActividad` TIME NULL DEFAULT 13:00:00,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`Rol` (
  `Id` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `mydb`.`Usuario_has_Rol` (
  `Id_Usuario` INT NOT NULL,
  `Id_Rol` INT NOT NULL,
  `ver` BIT NOT NULL,
  `editar` BIT NOT NULL,
  `actualizar` BIT NOT NULL,
  `eliminar` BIT NOT NULL,
  PRIMARY KEY (`Id_Usuario`, `Id_Rol`),
  INDEX `fk_Usuario_has_Roles_Roles1_idx` (`Id_Rol` ASC) /* VISIBLE */,
  INDEX `fk_Usuario_has_Roles_Usuario1_idx` (`Id_Usuario` ASC) /* VISIBLE */,
  CONSTRAINT `fk_Usuario_has_Roles_Usuario1`
    FOREIGN KEY (`Id_Usuario`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Roles_Roles1`
    FOREIGN KEY (`Id_Rol`)
    REFERENCES `mydb`.`Rol` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `id` INT NOT NULL,
  `activo` BIT NOT NULL DEFAULT true,
  `id_Datos_Persona` INT NOT NULL,
  `id_Horario` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Datos_Persona`, `id_Horario`),
  INDEX `fk_Usuarios_Propietario1_idx` (`id_Datos_Persona` ASC) /* VISIBLE */,
  INDEX `fk_Usuario_Horario1_idx` (`id_Horario` ASC) /* VISIBLE */,
  CONSTRAINT `fk_Usuarios_Propietario1`
    FOREIGN KEY (`id_Datos_Persona`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Horario1`
    FOREIGN KEY (`id_Horario`)
    REFERENCES `mydb`.`Horario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`Expediente` (
  `id` DOUBLE NOT NULL,
  `idAnual` INT NOT NULL,
  `anio` INT NOT NULL,
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `estado` BIT NOT NULL DEFAULT 0,
  `id_Persona_Solicita` INT NOT NULL,
  `id_solicitudConstruccion` INT NOT NULL,
  `id_Usuario_CreadoPor` INT NOT NULL,
  `id_Usuario_modificadoPor` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona_Solicita`, `id_solicitudConstruccion`, `id_Usuario_CreadoPor`, `id_Usuario_modificadoPor`),
  INDEX `fk_Expediente_Propietario1_idx` (`id_Persona_Solicita` ASC) /* VISIBLE */,
  INDEX `fk_Expediente_SolicitudConstruccion1_idx` (`id_solicitudConstruccion` ASC) /* VISIBLE */,
  INDEX `fk_Expediente_Usuario1_idx` (`id_Usuario_CreadoPor` ASC) /* VISIBLE */,
  INDEX `fk_Expediente_Usuario2_idx` (`id_Usuario_modificadoPor` ASC) /* VISIBLE */,
  CONSTRAINT `fk_Expediente_Propietario1`
    FOREIGN KEY (`id_Persona_Solicita`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_SolicitudConstruccion1`
    FOREIGN KEY (`id_solicitudConstruccion`)
    REFERENCES `mydb`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_Usuario1`
    FOREIGN KEY (`id_Usuario_CreadoPor`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Expediente_Usuario2`
    FOREIGN KEY (`id_Usuario_modificadoPor`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`CorrSeguridadEstruc` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `abreviacion` VARCHAR(10) NOT NULL,
  `cedula` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_Persona` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona`),
  INDEX `fk_CorrSeguridadEstruc_Persona1_idx` (`id_Persona` ASC) /* VISIBLE */,
  CONSTRAINT `fk_CorrSeguridadEstruc_Persona1`
    FOREIGN KEY (`id_Persona`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`DirectorResponsableObra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `abreviación` VARCHAR(10) NOT NULL,
  `cedula` VARCHAR(45) NOT NULL,
  `isActivo` BIT NOT NULL DEFAULT 1,
  `id_Persona` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Persona`),
  INDEX `fk_DirectorResponsableObra_Persona1_idx` (`id_Persona` ASC) /* VISIBLE */,
  CONSTRAINT `fk_DirectorResponsableObra_Persona1`
    FOREIGN KEY (`id_Persona`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`SolicitudConstruccion` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `superficieTotal` INT NULL,
  `superficiePorConstruir` INT NULL,
  `superficiePreexistente` INT NULL,
  `Niveles` INT NULL,
  `Cajones` INT NULL,
  `COS` VARCHAR(45) NULL,
  `CUS` VARCHAR(45) NULL,
  `RPP` VARCHAR(45) NULL,
  `Tomo` VARCHAR(45) NULL,
  `FolioElec` VARCHAR(45) NULL,
  `CuentaCatastral` VARCHAR(45) NULL,
  `FechaCreacion` DATETIME NOT NULL,
  `FechaModificacion` DATETIME NOT NULL,
  `isDeleted` BIT NOT NULL DEFAULT 0,
  `id_Persona_CreadoPor` INT NOT NULL,
  `id_Persona_ModificadoPor` INT NOT NULL,
  `id_Persona_DomicilioNotificaciones` INT NOT NULL,
  `id_DomicilioPredio` INT NOT NULL,
  `id_MotivoConstruccion` INT NOT NULL,
  `id_Contacto` INT NULL,
  `id_TipoPredio` INT NULL,
  `id_TipoConstruccion` INT NOT NULL,
  `id_GeneroConstruccion` INT NOT NULL,
  `id_SubGeneroConstruccion` INT NULL,
  `id_DirectorResponsableObra` INT NULL,
  `id_CorrSeguridadEstruc` INT NULL,
  PRIMARY KEY (`Id`, `id_Persona_CreadoPor`, `id_Persona_ModificadoPor`, `id_Persona_DomicilioNotificaciones`, `id_DomicilioPredio`, `id_MotivoConstruccion`, `id_Contacto`, `id_TipoPredio`, `id_TipoConstruccion`, `id_GeneroConstruccion`, `id_SubGeneroConstruccion`, `id_DirectorResponsableObra`, `id_CorrSeguridadEstruc`),
  INDEX `fk_SolicitudConstruccion_Domicilio1_idx` (`id_Persona_DomicilioNotificaciones` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_MotivoConstruccion1_idx` (`id_MotivoConstruccion` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_Domicilio2_idx` (`id_DomicilioPredio` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_Contacto1_idx` (`id_Contacto` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_TipoPredio1_idx` (`id_TipoPredio` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_TipoConstruccion1_idx` (`id_TipoConstruccion` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_Usuario1_idx` (`id_Persona_CreadoPor` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_Usuario2_idx` (`id_Persona_ModificadoPor` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_GeneroConstruccion1_idx` (`id_GeneroConstruccion` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_SubGeneroConstruccion1_idx` (`id_SubGeneroConstruccion` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_DirectorResponsableObra1_idx` (`id_DirectorResponsableObra` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_CorrSeguridadEstruc1_idx` (`id_CorrSeguridadEstruc` ASC) /* VISIBLE */,
  CONSTRAINT `fk_SolicitudConstruccion_Domicilio1`
    FOREIGN KEY (`id_Persona_DomicilioNotificaciones`)
    REFERENCES `mydb`.`Domicilio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_MotivoConstruccion1`
    FOREIGN KEY (`id_MotivoConstruccion`)
    REFERENCES `mydb`.`MotivoConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_Domicilio2`
    FOREIGN KEY (`id_DomicilioPredio`)
    REFERENCES `mydb`.`Domicilio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_Contacto1`
    FOREIGN KEY (`id_Contacto`)
    REFERENCES `mydb`.`Contacto` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_TipoPredio1`
    FOREIGN KEY (`id_TipoPredio`)
    REFERENCES `mydb`.`TipoPredio` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_TipoConstruccion1`
    FOREIGN KEY (`id_TipoConstruccion`)
    REFERENCES `mydb`.`TipoConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_Usuario1`
    FOREIGN KEY (`id_Persona_CreadoPor`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_Usuario2`
    FOREIGN KEY (`id_Persona_ModificadoPor`)
    REFERENCES `mydb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_GeneroConstruccion1`
    FOREIGN KEY (`id_GeneroConstruccion`)
    REFERENCES `mydb`.`GeneroConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_SubGeneroConstruccion1`
    FOREIGN KEY (`id_SubGeneroConstruccion`)
    REFERENCES `mydb`.`SubGeneroConstruccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_DirectorResponsableObra1`
    FOREIGN KEY (`id_DirectorResponsableObra`)
    REFERENCES `mydb`.`DirectorResponsableObra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_CorrSeguridadEstruc1`
    FOREIGN KEY (`id_CorrSeguridadEstruc`)
    REFERENCES `mydb`.`CorrSeguridadEstruc` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `mydb`.`SolicitudConstruccion_has_Persona` (
  `SolicitudConstruccion_Id` INT NOT NULL,
  `Persona_id` INT NOT NULL,
  PRIMARY KEY (`SolicitudConstruccion_Id`, `Persona_id`),
  INDEX `fk_SolicitudConstruccion_has_Persona_Persona1_idx` (`Persona_id` ASC) /* VISIBLE */,
  INDEX `fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion1_idx` (`SolicitudConstruccion_Id` ASC) /* VISIBLE */,
  CONSTRAINT `fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion1`
    FOREIGN KEY (`SolicitudConstruccion_Id`)
    REFERENCES `mydb`.`SolicitudConstruccion` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudConstruccion_has_Persona_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



