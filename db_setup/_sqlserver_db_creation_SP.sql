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
            DECLARE @rowsInserted INT = @@ROWCOUNT;

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


--TEST

CREATE PROCEDURE dbo.testSP
 AS
 Insert into dbo.Persona ("uwu","uwu2","uwu3")   