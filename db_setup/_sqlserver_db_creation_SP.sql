CREATE PROCEDURE dbo.sp_create_user
    @username nvarchar(255),
    @email nvarchar(255),
    @password_hash nvarchar(255),
    @auth_key nvarchar(32),
    @password_reset_token nvarchar(255),
    @verification_token nvarchar(255),
    @nombre nvarchar(255),
    @apellidoP nvarchar(255),
    @apellidoM nvarchar(255) 
    
 AS
    BEGIN TRY
        DECLARE @rowsInserted INT = @@ROWCOUNT;

        BEGIN TRANSACTION CreateUserTran;
            
            SET NOCOUNT ON ;
            
            IF( EXISTS ( SELECT TOP 1 * FROM sduma.dbo.[user] WHERE username = @username ))--solo si es agente
            BEGIN ;
                THROW 54321, 'Ese nombre de usuario ya existe.',1;
            END;

            IF( EXISTS ( SELECT TOP 1 * FROM sduma.dbo.[user] WHERE email = @email ))--solo si es agente
            BEGIN ;
                THROW 54322, 'Ese email ya está asociado a una cuenta.',1;
            END;

            INSERT INTO sduma.dbo.Persona ( nombre, apellidoP, apellidoM) 
            VALUES ( @nombre, @apellidoP, @apellidoP);        
            
           

            DECLARE @personaInsertedIndex int = (SELECT SCOPE_IDENTITY() );
            SET @rowsInserted = @@ROWCOUNT;

            INSERT INTO sduma.dbo.[user] (
                [username],
                [auth_key], [password_hash], [password_reset_token], 
                [email], [status], 
              --  [created_at], [updated_at], 
                [id_Datos_Persona], [id_Horario], [id_UserLevel],
                [verification_token],
                createdAt, updatedAt
                ) 
            VALUES (
                @username, 
                @auth_key, @password_hash, @password_reset_token, 
                @email, '9', --INACTIVE
              --  SYSDATETIME() , SYSDATETIME(),
                @personaInsertedIndex, --Persona PK id inserted
                '1', '1',
                @verification_token,
                SYSDATETIME() , SYSDATETIME()
            );

            SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

        COMMIT TRANSACTION CreateUserTran;
        SELECT  @rowsInserted AS ROWS_INSERTED;
    END TRY
    
    BEGIN CATCH
		DECLARE @ERROR_NUM INT = ERROR_NUMBER();
          
        DECLARE @ERROR_MSG nvarchar = ERROR_MESSAGE(); --return error as string or raised exception

		DECLARE @ERROR_STATE INT = ERROR_STATE();
        --RAISE  EXCEPTION 
        ROLLBACK TRANSACTION CreateUserTran;
        THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;

    END CATCH


INSERT INTO [dbo].[Persona]
           ([nombre]
           ,[apellidoP]
           ,[apellidoM])
     VALUES
           ('Victor Alfonso'
           ,'Pérez'
           ,'Espino');
           
INSERT INTO [dbo].[user]
           ([username]
           ,[auth_key]
           ,[password_hash]
           ,[password_reset_token]
           ,[email]
           ,[status]
           ,[id_Datos_Persona]
           ,[id_Horario]
           ,[id_UserLevel]
           ,[createdAt]
           ,[updatedAt]
           ,[verification_token])
     VALUES
           ('Vic1'
           ,'e1wsnPlf-eGIEhdTeeZuqvNXPtM0PrPL'
           ,'$2y$13$vRqw/BkT1gYME0sX4tZ3MeXlKo1aBaywIjHl2yCSE3Cqf1iI3Tej.'
           ,NULL
           ,'ap.vicespino@gmail.com'
           ,10
           ,1
           ,1
           ,3
           ,'2022-11-08 11:23:41.947'
           ,'2022-11-08 11:23:41.947'
           ,'NmUSiARLUvE-raQgNIsvh61ibRfhtk_R_1667928221'
		   )
GO

  		
CREATE PROCEDURE dbo.sp_create_expediente
    @nombre nvarchar(255),
    @apellidoP nvarchar(255),
    @apellidoM nvarchar(255),
    @tipoTramite INT,
    @idUserCreated INT 
    
 AS
    BEGIN TRY
        DECLARE @rowsInserted INT = 0;
		DECLARE @newIdAnual INT;

        BEGIN TRANSACTION CreateExpediente;
            SET NOCOUNT ON 
            IF NOT (EXISTS ( SELECT  TOP (1) id FROM sduma.dbo.TipoTramite WHERE id = @tipoTramite))
            BEGIN ;
                THROW 54323, 'El tipo de trámite no existe.',1;
            END;   


            DECLARE @currentYear INT = YEAR(GETDATE());

            /* DECLARE @nextIdAnual INT =  */
            IF NOT EXISTS( SELECT TOP(1) *  FROM dbo.Expediente AS Expe ORDER BY id DESC )
                BEGIN 
                    SET  @newIdAnual = 1;
                END
            ELSE
                BEGIN 
                    SELECT TOP(1) @newIdAnual =
                        CASE 
                        -- WHEN ( NOT (EXISTS (anio) ) ) THEN  1/* no hay rows */
                            WHEN anio = @currentYear THEN  idAnual + 1 
                            WHEN anio < @currentYear THEN 1 /*  cuando el  */
                            ELSE /* Exp.anio > @currentYear */ -1
                        END
                    FROM dbo.Expediente AS Expe ORDER BY id DESC;
                END


            IF(@newIdAnual = -1)
            BEGIN ;
                THROW 54324, 'Incoherencia en fechas de expedientes. -> SP_54323_C_EXPEDIENTE ',1;
            END;   


            INSERT INTO sduma.dbo.Persona ( nombre, apellidoP, apellidoM) 
            VALUES ( @nombre, @apellidoP, @apellidoP);                               

            DECLARE @personaInsertedIndex int = (SELECT SCOPE_IDENTITY() );
            SET @rowsInserted = @@ROWCOUNT;
            
            INSERT INTO [dbo].[Expediente]
                    (
					 [idAnual]
                    ,[anio]
                    ,[fechaCreacion]
                    ,[fechaModificacion]
                    ,[estado]
                    ,[id_Persona_Solicita]
                    ,[id_User_CreadoPor]
                    ,[id_User_modificadoPor]
                    ,[id_TipoTramite]

					)
                VALUES
                    (@newIdAnual
                    ,@currentYear
                    ,GETDATE()
                    ,GETDATE()
                    ,1
                    ,@personaInsertedIndex
                    ,@idUserCreated 
                    ,@idUserCreated 
                    , @tipoTramite
                    )
            SET @rowsInserted = @rowsInserted + @@ROWCOUNT;

            COMMIT TRANSACTION CreateExpediente;
            SELECT  @rowsInserted AS ROWS_INSERTED;
    END TRY    
    BEGIN CATCH
		 
        --RAISE  EXCEPTION 
        ROLLBACK TRANSACTION CreateExpediente;
        THROW; --@ERROR_NUM, @ERROR_MSG, @ERROR_STATE;

    END CATCH       

GO
--TEST

/* CREATE PROCEDURE dbo.testSP
 AS
 Insert into dbo.Persona ("uwu","uwu2","uwu3")    */