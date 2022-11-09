<?php

namespace frontend\controllers;

use Exception;
use Yii;
use frontend\models\NuevoExpedienteForm;

class ExpedientesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCrear()
    {
        $model = new NuevoExpedienteForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here

                $expCreationResult = $model->createExpediente();

                Yii::$app->session->setFlash(
                    $expCreationResult["success"]?'success':'danger', 
                    $expCreationResult["MSG"]
                );

                if($expCreationResult["success"]){

                    return $this->goHome();
                }
 
            }
        }

        return $this->render('crear', [
            'model' => $model,
        ]);
        
    }
 
   



}
