<?php

namespace frontend\controllers;

use Exception;
use Yii;
use frontend\models\NuevoExpedienteForm;

class ExpedientesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        /* Yii::$app->session->setFlash(
            'success', 
        "Flash Action Index "); */
        $modelNuevoExp = new NuevoExpedienteForm();

        return $this->render('index',[
            'modelNuevoExp' =>  $modelNuevoExp,
        ]);
    }
    public function actionCrear()
    {
        $modelNuevoExp = new NuevoExpedienteForm();
        
        $loaded = $modelNuevoExp->load(Yii::$app->request->post());

        if(!$loaded){
            //normal flow
            return $this->redirect(['expedientes/index'])->send();

            /*  return $this->render('index', [
                'modelNuevoExp' => $modelNuevoExp,
            ]); */
        }

        if (!$modelNuevoExp->validate()) {
            Yii::$app->session->setFlash( 'danger',   "Error al validar los campos.." );
            return $this->render('index', [
                'modelNuevoExp' => $modelNuevoExp,
            ]);

        
        }
 
        // form inputs are valid, do something here
        
        $expCreationResult = $modelNuevoExp->createExpediente();
        Yii::$app->session->setFlash(
            $expCreationResult["success"]  ,
            $expCreationResult["MSG"]
        );
        
        if( $expCreationResult["success"]){
            //URL será la la del redirect.
            return $this->redirect(['expedientes/index'])->send();
        }
 
        if($expCreationResult["success"]){

            return $this->goHome();
        }
 
        
    }


    public function actionCreaTest()
    {
        $modelNuevoExp = new NuevoExpedienteForm();
        
        $loaded = $modelNuevoExp->load(Yii::$app->request->post());
/*         
        $modelNuevoExp->apellidoM = "asdasdsad";
      
        Yii::$app->session->setFlash( 'warning', ".".$modelNuevoExp->tipoTramiteId);
        Yii::$app->session->setFlash( 'success', ($loaded?"loaded":"noloaded" )."we" );
        Yii::$app->session->setFlash( 'danger',   ($modelNuevoExp->validate()?"validat":"novalid") ."we" );
 */

        if ($loaded) {
            
            if ($modelNuevoExp->validate()) {
                // form inputs are valid, do something here
               
               /*  $expCreationResult = $modelNuevoExp->createExpediente();

                Yii::$app->session->setFlash(
                    $expCreationResult["success"]?'success':'danger', 
                    $expCreationResult["MSG"]
                );

                if($expCreationResult["success"]){

                    return $this->goHome();
                } */
 
            }
        }
   
       /*  return $this->render('crear', [
            'modelNuevoExp' => $modelNuevoExp,
        ]); */
      /*   return $this->actionIndex(); */
        /* IF okey redirect to index. */
       /*  return $this->redirect(['expedientes/index'])->send(); */

        /* No okey,  */
        /* index uncluye el form de crear */
        return $this->render('index', [
            'modelNuevoExp' => $modelNuevoExp,
        ]);
        
    }
 
   



}
