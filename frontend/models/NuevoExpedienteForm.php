<?php

namespace frontend\models;

use Yii;
use yii\base\Model; 
use Exception;

class NuevoExpedienteForm extends Model
{
    
    public $nombre;
    public $apellidoP;
    public $apellidoM;

    public $tipoTramiteId;


    public function attributeLabels()
    {    
        return array(

            'nombre' => 'Nombre',
            'apellidoP' => 'Apellido Paterno',
            'apellidoM' => 'Apellido Materno',
            'tipoTramiteId' => 'tipoTramiteId' 

        );
    
    }
    public function rules()
    {
        return [
         
            [['nombre','apellidoP'], 'required'], 
            [['nombre','apellidoP'], 'string', 'max' => 255 /* (new Persona)->getValidators()[1]->max */],
          
            ['apellidoM', 'string', 'max' => 255 ],

            ['tipoTramiteId', 'required' ],
            ['tipoTramiteId', 'integer' ],

        
        ];
    }


    public function createExpediente(){

        $sql ="  EXEC sp_create_expediente :nombre,:apellidoP,:apellidoM,:tipoTrámite,:idUserCreated; ";
        $params =[
                ':nombre'=>$this->nombre,
                ':apellidoP'=>$this->apellidoP,
                ':apellidoM'=>$this->apellidoM,
                ':tipoTrámite'=>$this->tipoTramiteId,
                ':idUserCreated'=>Yii::$app->user->identity->id ,
        ];
        $res = -1;
        try{
            $rows =  Yii::$app->db->createCommand($sql, $params) ->queryAll( );

            $res = $rows[0]["ROWS_INSERTED"] ;
            return ["success" => true,"MSG" => "Expediente creado."]; 
        }
        catch(Exception $ex){
            Yii::info($ex, $category = 'ERROR Execute command.');
            return ["success" => false, "MSG" => $ex->getMessage()];
        }
        Yii::info($res, $category = 'DB ACTION');
 
        
 
        

    }

}