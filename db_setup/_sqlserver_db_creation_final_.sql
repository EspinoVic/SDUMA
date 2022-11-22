CREATE TABLE sduma.dbo.MotivoConstruccion(
	id INT NOT NULL IDENTITY(1,1),
	nombre Nvarchar(45) NOT NULL,
	isActivo BIT NOT NULL Default 1,
	 PRIMARY KEY (id)
);

 
INSERT INTO [dbo].[MotivoConstruccion]
           ([nombre]
           ,[isActivo])
     VALUES 
      ('Licencia' , 1),
      ('Registro' , 1),
      ('Regularización' , 1),
      ('Rectificación' , 1);
 
GO


CREATE TABLE sduma.dbo.Domicilio (
	  id INT NOT NULL IDENTITY(1,1),
	  coloniaFraccBarrio NVARCHAR(90) NOT NULL,
	  calle NVARCHAR(45) NOT NULL,
	  numExt NVARCHAR(45) NULL,
	  numInt NVARCHAR(45) NULL,
	  cp NVARCHAR(10) NOT NULL, 
	  entreCallesH NVARCHAR(90) NULL,
	  entreCallesV NVARCHAR(90) NULL,
	   PRIMARY KEY (id)
  
  );


CREATE TABLE sduma.dbo.TipoPredio (
	  id INT NOT NULL IDENTITY(1,1),
	  nombre NVARCHAR(45) NOT NULL,
	  isActivo BIT NOT NULL DEFAULT 1,
	   PRIMARY KEY (id)

);
 

INSERT INTO [dbo].[TipoPredio]
           ([nombre]
           ,[isActivo])
     VALUES
           ('Urbano', 1),
           ('Rústico', 1);
GO


CREATE TABLE sduma.dbo.Contacto (
  id INT NOT NULL IDENTITY(1,1),
  email NVARCHAR(45) NOT NULL,
  telefono NVARCHAR(45) NOT NULL,
    PRIMARY KEY (id)

);


  CREATE TABLE sduma.dbo.GeneroConstruccion (
	  id INT NOT NULL IDENTITY(1,1) ,
	  nombre NVARCHAR(45) NOT NULL,
	  isActivo BIT NOT NULL DEFAULT 1,
	    PRIMARY KEY (id)
  
  );
 
 
INSERT INTO sduma.[dbo].[GeneroConstruccion]
           ([nombre]
           ,[isActivo])
     VALUES
          /* 1 */ ('Habitacional unifamiliar' , 1),
          /* 2 */ ('Muros' ,1),
          /* 3 */ ('Hoteles, Moteles, posadas y similares' ,1),
          /* 4 */ ('Comercial' ,1),
          /* 5 */ ('Industrial' ,1),
          /* 6 */ ('Educación' ,1),
          /* 7 */ ('Hospitales' ,1),
          /* 8 */ ('Centros recreativos' ,1)

           ;
 


CREATE TABLE  sduma.dbo.SubGeneroConstruccion (
  id INT NOT NULL IDENTITY(1,1),
  nombre NVARCHAR(255) NOT NULL,
  udm NVARCHAR(10) NOT NULL,
  tamanioLimiteInferior DECIMAL(8,4) NOT NULL,
  tamanioLimiteSuperior DECIMAL(8,4) NOT NULL,
  nombreTarifa NVARCHAR(255) NOT NULL,
  tarifa DECIMAL(8,5) NOT NULL,
  fechaCreacion DATETIME NOT NULL,
  anioVigencia NVARCHAR(45) NOT NULL,
  isActivo BIT NOT NULL DEFAULT 1,
  id_GeneroConstruccion INT NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_SubGeneroConstruccion_GeneroConstruccion1_idx (id_GeneroConstruccion ASC),
  CONSTRAINT fk_SubGeneroConstruccion_GeneroConstruccion1
    FOREIGN KEY (id_GeneroConstruccion)
    REFERENCES sduma.dbo.GeneroConstruccion (id)
);

USE [sduma]
GO

INSERT INTO sduma.[dbo].[SubGeneroConstruccion]
           ([nombre]
           ,[udm]
           ,[tamanioLimiteInferior]
           ,[tamanioLimiteSuperior]
           ,[nombreTarifa]
           ,[tarifa]
           ,[fechaCreacion]
           ,[anioVigencia]
           ,[isActivo]
           ,[id_GeneroConstruccion])
     VALUES
          (
            'Interés social o Popular'
           ,'m2'
           ,0
           ,60.9999
           ,'Hasta un máximo de 60m2'
           ,8.13
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Habitacional ... */
          ,(
            'Interés social o Popular'
           ,'m2'
           ,61
           ,90.9999
           ,'De 61 m2 y hasta 90m2'
           ,14.94
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Habitacional ... */
          ,(
            'Interés social o Popular'
           ,'m2'
           ,91
           ,120.9999
           ,'De 91 m2 y hasta 120m2'
           ,17.65
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Habitacional ... */
          ,(
            'Media'
           ,'m2'
           ,121
           ,150.9999
           ,'Hasta un máximo de 150m2'
           ,29.90
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Media ... */
          ,(
            'Media'
           ,'m2'
           ,151
           ,180.9999
           ,'Hasta un máximo de 180m2'
           ,35.34
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Media ... */
          ,(
            'Residencial'
           ,'m2'
           ,181
           ,210.9999
           ,'Hasta un máximo de 210m2'
           ,43.49
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Residencial ... */
          ,(
            'Residencial'
           ,'m2'
           ,211
           ,-1 /* infinito xd */
           ,'Excediento 210m2'
           ,49.98
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,1
          )/* Residencial ... */            
          ,(
            'Muros'
           ,'m'
           ,0
           ,2.5099
           ,'Hasta un máximo de 2.5m'
           ,9.48
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,2
          )/* Muros ... */
          ,(
            'Muros'
           ,'m'
           ,2.51
           ,3.5099
           ,'De 2.51m hasta 3.50m'
           ,14.94
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,2
          )/* Muros ... */
          ,(
            'Muros'
           ,'m'
           ,3.51
           ,4.5099
           ,'De 3.51m hasta 4.50m'
           ,17.65
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,2
          )/* Muros ... */
          ,(
            'Muros'
           ,'m'
           ,4.51
           ,-1
           ,'De 3.51m hasta 4.50m'
           ,17.65
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,2
          )/* Muros ... */
          ,(
            'Hoteles, moteles, posadas y similares'
           ,'m'
           ,0
           ,-1
           ,'Sin medida especifica'
           ,29.90
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,3
          )/* Hoteles, moteles, posadas y similares... */
          ,(
            'Comercial'
           ,'m'
           ,0
           ,-1
           ,'Mercados'
           ,8.13
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,4
          )/* Comercial */
          ,(
            'Comercial'
           ,'m'
           ,0
           ,100.9999
           ,'Locales comeciales hasta 100m2'
           ,20.37
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,4
          )/* Comercial */
          ,(
            'Comercial'
           ,'m'
           ,100.1
           ,-1
           ,'Locales comeciales mayores a 100m2, tiendas autoservicio, centros comerciales y similares'
           ,37.44
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,4
          )/* Comercial */
          ,(
            'Agroindustrial'
           ,'m'
           ,-1
           ,-1
           ,'Mediana y grande'
           ,2.69
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Agroindustrial */
          ,(
            'Agroindustrial'
           ,'m'
           ,-1
           ,-1
           ,'Pequeña'
           ,4.04
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Agroindustrial */
          ,(
            'Agroindustrial'
           ,'m'
           ,-1
           ,-1
           ,'Micro'
           ,5.40
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Agroindustrial */
          ,(
            'Otros'
           ,'m'
           ,-1
           ,-1
           ,'Mediana y grande'
           ,5.40
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Otros */
          ,(
            'Otros'
           ,'m'
           ,-1
           ,-1
           ,'Pequeña'
           ,6.77
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Otros */
          ,(
            'Otros'
           ,'m'
           ,-1
           ,-1
           ,'Micro'
           ,6.77
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Otros */
          ,(
            'Administración'
           ,'m'
           ,-1
           ,-1
           ,'Oficinas en general'
           ,28.97
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,5 
          )/* Administración */
          ,(
            'Educación'
           ,'m2'
           ,-1
           ,-1
           ,'Popular'
           ,6.77
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,6 
          )/* Educacion pop */
          ,(
            'Educación'
           ,'m2'
           ,-1
           ,-1
           ,'Medio'
           ,10.84
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,6 
          )/* Educacion Medio */
          ,(
            'Educación'
           ,'m2'
           ,-1
           ,-1
           ,'Residencial'
           ,14.87
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,6 
          )/* Educacion Residencial */
          ,(
            'Educación'
           ,'m2'
           ,-1
           ,-1
           ,'Comercial'
           ,19.01
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,6 
          )/* Educacion Comercial */
          ,(
            'Hospital'
           ,'m2'
           ,-1
           ,-1
           ,'Popular'
           ,12.23
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,7
          )/* Hospital Pop */
          ,(
            'Hospital'
           ,'m2'
           ,-1
           ,-1
           ,'Medio'
           ,20.37
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,7
          )/* Hospital Medio */
          ,(
            'Hospital'
           ,'m2'
           ,-1
           ,-1
           ,'Residencial'
           ,27.18
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,7
          )/* Hospital Residencial */
          ,(
            'Hospital'
           ,'m2'
           ,-1
           ,-1
           ,'Comercial'
           ,29.90
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,7
          )/* Hospital Comercial */
          ,(
            'Centros diversos: bar, discotecas, centros nocturnos, botaneros, peñar, billares, palenques y/o similares'
           ,'m2'
           ,-1
           ,-1
           ,'Centros diversos: bar, discotecas, centros nocturnos, botaneros, peñar, billares, palenques y/o similares'
           ,36.71
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,8
          )/* Centros recreativos */
          ,(
            'Social/público sin lúcro: Centros deportivos, gimnasios y similares'
           ,'m2'
           ,-1
           ,-1
           ,'Centros sociales comunitarios'
           ,2.69
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,8
          )/* Centros recreativos. */
          ,(
            'Social/público sin lúcro: Centros deportivos, gimnasios y similares'
           ,'m2'
           ,-1
           ,-1
           ,'Centros de meditación y religiosos'
           ,4.04
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,8
          )/* Centros recreativos. */
          ,(
            'Social/público sin lúcro: Centros deportivos, gimnasios y similares'
           ,'m2'
           ,-1
           ,-1
           ,'Cooperativas comunitarias'
           ,9.48
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,8
          )/* Centros recreativos. */
          ,(
            'Social/público sin lúcro: Centros deportivos, gimnasios y similares'
           ,'m2'
           ,-1
           ,-1
           ,'Centros de preparación dogmática'
           ,20.37
           ,GETDATE()
           ,YEAR(GETDATE())
           ,1
           ,8
          )/* Centros recreativos. */
            
GO


CREATE TABLE  sduma.dbo.TipoConstruccion (
  id INT NOT NULL IDENTITY(1,1) ,
  nombre NVARCHAR(45) NOT NULL,
  isActivo NVARCHAR(45) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
  
  );

INSERT INTO [dbo].[TipoConstruccion]
           ([nombre]
           ,[isActivo])
     VALUES
           ('Dos plantas',1);
GO


CREATE TABLE sduma.dbo.TipoTramite (
	  id INT NOT NULL IDENTITY(1,1),
	  nombre NVARCHAR(45) NOT NULL,
	  isActivo NVARCHAR(45) NOT NULL DEFAULT 1,
	  PRIMARY KEY (id)
);

INSERT INTO sduma.dbo.TipoTramite ( nombre)
 VALUES ('CONSTRUCCION');
 --Numero oficial, etc...

 CREATE TABLE sduma.dbo.Documento (
	  id INT NOT NULL IDENTITY(1,1),
	  nombre NVARCHAR(255) NOT NULL,
	  isActivo BIT NOT NULL DEFAULT 1,
	  PRIMARY KEY (id)
  );

  
INSERT INTO [dbo].[Documento]
           ([nombre]
           ,[isActivo])
     VALUES
       ('Escritura inscrita en el registro público de la propiedad', 1),
		   ('Identificación oficial del propietario', 1),
		   ('Recibo de agua actualizado', 1),
		   ('Recibo de pago predial actualizado', 1),
		   ('Constancia físcal de no adeutos municipales', 1),
		   ('Constancia de alineamiento', 1),
		   ('Licencia de uso de suelo', 1),
		   ('Plano técnivo a escala del proyecto pretendiendo hasta 35m2', 1),
		   ('Proyecto ejecutivo según reglamento', 1),
		   ('Fotografías del inmueble motivo de la solicitud', 1),
		   ('Pago de derechos', 1),
		   ('Acreditación de personalidad e interé jurídico.', 1);


CREATE TABLE sduma.dbo.TipoTramite_has_Documento (
  id_TipoTramite INT NOT NULL,
  id_Documento INT NOT NULL,
  PRIMARY KEY (id_TipoTramite, id_Documento),
  INDEX fk_TipoTramite_has_Documento_Documento_idx (id_Documento ASC) ,
  INDEX fk_TipoTramite_has_Documento_TipoTramite_idx (id_TipoTramite ASC) ,
  CONSTRAINT fk_TipoTramite_has_Documento_TipoTramite
    FOREIGN KEY (id_TipoTramite)
    REFERENCES sduma.dbo.TipoTramite (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_TipoTramite_has_Documento_Documento1
    FOREIGN KEY (id_Documento)
    REFERENCES sduma.dbo.Documento (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

--PROBAR ESTOS ON DELETE/UPDATE NO ACTION;
INSERT INTO [dbo].[TipoTramite_has_Documento]
           ([id_TipoTramite],[id_Documento])
           VALUES
           (1,1),
           (1,2),
           (1,3),
           (1,4),
           (1,5),
           (1,6),
           (1,7),
           (1,8),
           (1,9),
           (1,10),
           (1,11),
           (1,12);


CREATE TABLE sduma.dbo.Persona (
  id INT NOT NULL IDENTITY(1,1) ,
  nombre NVARCHAR(255) NOT NULL,
  apellidoP NVARCHAR(255) NOT NULL,
  apellidoM NVARCHAR(255) NULL,
  PRIMARY KEY (id)
  
  );


CREATE TABLE sduma.dbo.Horario (
  id INT NOT NULL IDENTITY(1,1)  ,
  nombre NVARCHAR(45) NOT NULL,
  inicioActividad TIME NOT NULL DEFAULT '8:00:00',
  finActividad TIME NOT NULL DEFAULT '13:00:00',
  PRIMARY KEY (id)
  
);

INSERT INTO sduma.dbo.Horario ( nombre,inicioActividad, finActividad) 
VALUES ('Horario Externo', '0:00:00','23:59:59');

INSERT INTO sduma.dbo.Horario ( nombre) 
VALUES ('DEFAULT');

CREATE TABLE sduma.dbo.Rol (
  id INT NOT NULL IDENTITY(1,1),
  nombre NVARCHAR(45) NULL,
  PRIMARY KEY (id)
  
);
/* 
CREATE TABLE  sduma.dbo.Rol (
  id INT NOT NULL IDENTITY(1,1),
  nombre NVARCHAR(45) NULL,
  id_User INT NULL,
  ver BIT NULL,
  editar BIT NULL,
  actualiza BIT NULL,
  borrar BIT NULL,
  PRIMARY KEY (id),
  INDEX fk_Rol_User1_idx (id_User ASC),
  CONSTRAINT fk_Rol_User1
    FOREIGN KEY (id_User)
    REFERENCES sduma.dbo.[user] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	); */

INSERT INTO sduma.dbo.Rol (  nombre) 
VALUES 
( 'ADMIN'),
( 'INTERNO'),
('EXTERNO');

CREATE TABLE sduma.dbo.User_has_Rol (
  id_User INT NOT NULL,
  id_Rol INT NOT NULL,
  ver BIT NOT NULL DEFAULT 1,
  editar BIT NOT NULL DEFAULT 1,
  actualizar BIT NOT NULL DEFAULT 1,
  eliminar BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (id_User, id_Rol),
  INDEX fk_User_has_Roles_Roles_idx (id_Rol ASC),
  INDEX fk_User_has_Roles_User_idx (id_User ASC),
  CONSTRAINT fk_User_has_Roles_User1
    FOREIGN KEY (id_User)
    REFERENCES sduma.dbo.[User] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_User_has_Roles_Roles1
    FOREIGN KEY (id_Rol)
    REFERENCES sduma.dbo.[Rol](id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE  sduma.dbo.UserLevel (
  id INT NOT NULL IDENTITY(1,1),
  Nombre NVARCHAR(45) NOT NULL,
  PRIMARY KEY (id)
 );
INSERT INTO sduma.dbo.UserLevel (Nombre) VALUES ( 'EXTERNO');
INSERT INTO sduma.dbo.UserLevel (Nombre) VALUES ( 'INTERNO');
INSERT INTO sduma.dbo.UserLevel (Nombre) VALUES ( 'ADMINISTRADOR');


--Se a�aden foreign keys faltantes a la tabla user,  
--se modifico la tabla en la migration de yii2.
--TRUNCATE TABLE  sduma.dbo.[user];


ALTER TABLE sduma.dbo.[user]
ADD CONSTRAINT fk_Users_Propietario
    FOREIGN KEY (id_Datos_Persona)
    REFERENCES sduma.dbo.Persona (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

ALTER TABLE sduma.dbo.[user]
ADD CONSTRAINT fk_User_Horario
    FOREIGN KEY (id_Horario)
    REFERENCES sduma.dbo.Horario (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

ALTER TABLE sduma.dbo.[user]
ADD CONSTRAINT fk_User_UserLevel
    FOREIGN KEY (id_UserLevel)
    REFERENCES sduma.dbo.UserLevel (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	;

/* ALTER TABLE sduma.dbo.[user]
ADD created_at datetime2 NOT NULL;

ALTER TABLE sduma.dbo.[user]
ADD created_at datetime2 ;
 */
--ALTER TABLE sduma.dbo.[user]
--ADD CONSTRAINT DV_User_Horario
--DEFAULT 1 FOR id_Horario;

--ALTER TABLE sduma.dbo.[user]
--ADD CONSTRAINT DV_User_UserLevel
--DEFAULT 1 FOR id_UserLevel;

CREATE INDEX fk_Users_Propietario_idx ON sduma.dbo.[user](id_Datos_Persona ASC);
CREATE INDEX fk_User_Horario_idx ON  sduma.dbo.[user](id_Horario ASC);




CREATE TABLE  sduma.dbo.CorrSeguridadEstruc (
  id INT NOT NULL IDENTITY(1,1),
  titulo NVARCHAR(45) NOT NULL,
  abreviacion NVARCHAR(10) NOT NULL,
  cedula NVARCHAR(45) NULL,
  isActivo BIT NOT NULL DEFAULT 1,
  id_Persona INT NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_CorrSeguridadEstruc_idPersona_idx (id_Persona ASC)  ,
  CONSTRAINT fk_CorrSeguridadEstruc_Persona1
    FOREIGN KEY (id_Persona)
    REFERENCES sduma.dbo.Persona (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


CREATE TABLE sduma.dbo.DirectorResponsableObra (
  id INT NOT NULL IDENTITY(1,1),
  titulo NVARCHAR(45) NOT NULL,
  abreviacion NVARCHAR(10) NOT NULL,
  cedula NVARCHAR(45) NOT NULL,
  isActivo BIT NOT NULL DEFAULT 1,
  id_Persona INT NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_DirectorResponsableObra_Persona_idx (id_Persona ASC) ,
  CONSTRAINT fk_DirectorResponsableObra_Persona1
    FOREIGN KEY (id_Persona)
    REFERENCES sduma.dbo.Persona (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE sduma.dbo.Expediente (
  id INT NOT NULL IDENTITY(1,1),
  idAnual INT NOT NULL,
  anio INT NOT NULL,
  fechaCreacion DATETIME NOT NULL,
  fechaModificacion DATETIME NOT NULL,
  estado BIT NOT NULL DEFAULT 0,
  id_Persona_Solicita INT NOT NULL,
  /* id_solicitudConstruccion INT NOT NULL, */
  id_User_CreadoPor INT NOT NULL,
  id_User_modificadoPor INT NOT NULL,
  id_TipoTramite INT NOT NULL,
  PRIMARY KEY (id/*, idAnual, */ /* ,id_Persona_Solicita, id_solicitudConstruccion, */ /* id_User_CreadoPor, id_User_modificadoPor */),
  INDEX fk_Expediente_PersonaSolicita_idx (id_Persona_Solicita ASC)  ,
/*   INDEX fk_Expediente_SolicitudConstruccion_idx (id_solicitudConstruccion ASC)  , */
  INDEX fk_Expediente_UserCreadoPor_idx (id_User_CreadoPor ASC)  ,
  INDEX fk_Expediente_UserModificadoPor_idx (id_User_modificadoPor ASC)  ,
  INDEX fk_Expediente_TipoTramite_idx (id_TipoTramite ASC)  ,
  CONSTRAINT fk_Expediente_Propietario1
    FOREIGN KEY (id_Persona_Solicita)
    REFERENCES sduma.dbo.Persona (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Expediente_UserCreadoPor
    FOREIGN KEY (id_User_CreadoPor)
    REFERENCES sduma.dbo.[user] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Expediente_UserModifPor
    FOREIGN KEY (id_User_modificadoPor)
    REFERENCES sduma.dbo.[user] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Expediente_TipoTramite
    FOREIGN KEY (id_TipoTramite)
    REFERENCES sduma.dbo.[TipoTramite] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	);

CREATE TABLE sduma.dbo.SolicitudConstruccion (
  id INT NOT NULL IDENTITY(1,1),
  superficieTotal INT NULL,
  superficiePorConstruir INT NULL,
  superficiePreexistente INT NULL,
  niveles INT NULL,
  cajones INT NULL,
  COS NVARCHAR(45) NULL,
  CUS NVARCHAR(45) NULL,
  RPP NVARCHAR(45) NULL,
  tomo NVARCHAR(45) NULL,
  folioElec NVARCHAR(45) NULL,
  cuentaCatastral NVARCHAR(45) NULL,
  fechaCreacion DATETIME NOT NULL,
  fechaModificacion DATETIME NOT NULL,
  isDeleted BIT NOT NULL DEFAULT 0,
  id_User_CreadoPor INT NOT NULL,
  id_User_ModificadoPor INT NOT NULL,
  id_DomicilioNotificaciones INT NOT NULL,
  id_DomicilioPredio INT NOT NULL,
  id_MotivoConstruccion INT NOT NULL,
  id_Contacto INT NULL,
  id_TipoPredio INT NULL,
  id_TipoConstruccion INT NOT NULL,
  id_GeneroConstruccion INT NOT NULL,
  id_SubGeneroConstruccion INT NULL,
  id_DirectorResponsableObra INT NULL,
  id_CorrSeguridadEstruc INT NULL,
  id_Expediente INT NOT NULL,
  PRIMARY KEY (id),
  INDEX fk_SolicitudConstruccion_DomicilioNotif_idx (id_DomicilioNotificaciones ASC) ,
  INDEX fk_SolicitudConstruccion_MotivoConstruccion1_idx (id_MotivoConstruccion ASC) ,
  INDEX fk_SolicitudConstruccion_DomicilioPredio_idx (id_DomicilioPredio ASC) ,
  INDEX fk_SolicitudConstruccion_Contacto_idx (id_Contacto ASC) ,
  INDEX fk_SolicitudConstruccion_TipoPredio_idx (id_TipoPredio ASC) ,
  INDEX fk_SolicitudConstruccion_TipoConstruccion_idx (id_TipoConstruccion ASC) ,
  INDEX fk_SolicitudConstruccion_UserCreadoPor_idx (id_User_CreadoPor ASC) ,
  INDEX fk_SolicitudConstruccion_UserModificadoPor_idx (id_User_ModificadoPor ASC) ,
  INDEX fk_SolicitudConstruccion_GeneroConstruccion_idx (id_GeneroConstruccion ASC) ,
  INDEX fk_SolicitudConstruccion_SubGeneroConstruccion_idx (id_SubGeneroConstruccion ASC) ,
  INDEX fk_SolicitudConstruccion_DirectorResponsableObra_idx (id_DirectorResponsableObra ASC) ,
  INDEX fk_SolicitudConstruccion_CorrSeguridadEstruc_idx (id_CorrSeguridadEstruc ASC) ,
  INDEX fk_SolicitudConstruccion_Expediente_idx (id_Expediente ASC),
  CONSTRAINT fk_SolicitudConstruccion_DomicilioNotif
    FOREIGN KEY (id_DomicilioNotificaciones)
    REFERENCES sduma.dbo.Domicilio (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_MotivoConstruccion1
    FOREIGN KEY (id_MotivoConstruccion)
    REFERENCES sduma.dbo.MotivoConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_DomicilioPredio
    FOREIGN KEY (id_DomicilioPredio)
    REFERENCES sduma.dbo.Domicilio (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_Contacto1
    FOREIGN KEY (id_Contacto)
    REFERENCES sduma.dbo.Contacto (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_TipoPredio1
    FOREIGN KEY (id_TipoPredio)
    REFERENCES sduma.dbo.TipoPredio (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_TipoConstruccion1
    FOREIGN KEY (id_TipoConstruccion)
    REFERENCES sduma.dbo.TipoConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_UserCreadoPor
    FOREIGN KEY (id_User_CreadoPor)
    REFERENCES sduma.dbo.[user] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_UserModificadoPor
    FOREIGN KEY (id_User_ModificadoPor)
    REFERENCES sduma.dbo.[user] (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_GeneroConstruccion1
    FOREIGN KEY (id_GeneroConstruccion)
    REFERENCES sduma.dbo.GeneroConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_SubGeneroConstruccion1
    FOREIGN KEY (id_SubGeneroConstruccion)
    REFERENCES sduma.dbo.SubGeneroConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_DirectorResponsableObra1
    FOREIGN KEY (id_DirectorResponsableObra)
    REFERENCES sduma.dbo.DirectorResponsableObra (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_CorrSeguridadEstruc1
    FOREIGN KEY (id_CorrSeguridadEstruc)
    REFERENCES sduma.dbo.CorrSeguridadEstruc (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_Expediente1
    FOREIGN KEY (id_Expediente)
    REFERENCES sduma.dbo.Expediente (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);





CREATE TABLE sduma.dbo.SolicitudConstruccion_has_Persona (
  SolicitudConstruccion_Id INT NOT NULL,
  Persona_id INT NOT NULL,
  PRIMARY KEY (SolicitudConstruccion_Id, Persona_id),
  INDEX fk_SolicitudConstruccion_has_Persona_Persona_idx (Persona_id ASC)  ,
  INDEX fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion_idx (SolicitudConstruccion_Id ASC)  ,
  CONSTRAINT fk_SolicitudConstruccion_has_Persona_SolicitudConstruccion1
    FOREIGN KEY (SolicitudConstruccion_Id)
    REFERENCES sduma.dbo.SolicitudConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_has_Persona_Persona1
    FOREIGN KEY (Persona_id)
    REFERENCES sduma.dbo.Persona (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


CREATE TABLE  sduma.dbo.SolicitudConstruccion_has_Documento (
  id_SolicitudConstruccion INT NOT NULL,
  id_Documento INT NOT NULL,
  isEntregado BIT NOT NULL,
  nombreArchivo NVARCHAR(128) NULL,
  [path] NVARCHAR(128) NULL,
  realNombreArchivo NVARCHAR(90) NULL,
  PRIMARY KEY (id_SolicitudConstruccion, id_Documento),
  INDEX fk_SolicitudConstruccion_has_Documento_Documento_idx (id_Documento ASC)  ,
  INDEX fk_SolicitudConstruccion_has_Documento_SolicitudConstruccio_idx (id_SolicitudConstruccion ASC)  ,
  CONSTRAINT fk_SolicitudConstruccion_has_Documento_SolicitudConstruccion1
    FOREIGN KEY (id_SolicitudConstruccion)
    REFERENCES sduma.dbo.SolicitudConstruccion (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_SolicitudConstruccion_has_Documento_Documento1
    FOREIGN KEY (id_Documento)
    REFERENCES sduma.dbo.Documento (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	);


CREATE TYPE SoliHasDocParam AS TABLE(
     /*  id_SolicitudConstruccion INT NOT NULL, */ /* El SP le da el valor */
      id_Documento INT NOT NULL,
      isEntregado BIT NOT NULL,
      nombreArchivo NVARCHAR(128) NULL,
      [path] NVARCHAR(128) NULL,
      realNombreArchivo NVARCHAR(90) NULL
    );
 