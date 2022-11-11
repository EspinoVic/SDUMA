<?php

namespace frontend\controllers;

use Exception;
use Yii;
use frontend\models\NuevoExpedienteForm;

use common\models\Expediente;
use common\models\ExpedienteSearch;
use yii\web\NotFoundHttpException;

class ExpedientesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new ExpedienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        /* Yii::$app->session->setFlash(
            'success', 
        "Flash Action Index "); */
        $modelNuevoExp = new NuevoExpedienteForm();
        
        return $this->render('index', [
            'modelNuevoExp' =>  $modelNuevoExp,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCrear()
    {
        $searchModel = new ExpedienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $modelNuevoExp = new NuevoExpedienteForm();
        
        $loaded = $modelNuevoExp->load(Yii::$app->request->post());

        //seguramente se va al link de expedientes/create
        if(!$loaded){
            //normal flow
            return $this->redirect(['expedientes/index'])->send();

            /*  return $this->render('index', [
                'modelNuevoExp' => $modelNuevoExp,
            ]); */
        }

       //Test forzar datos erroneos // $modelNuevoExp->nombre = "";
        //Ya no xd //si la data del modelo no se pudo validar, renderizará index bajo URL /create
        if (!$modelNuevoExp->validate()) {
            Yii::$app->session->setFlash( 'danger',   "Error al validar los campos.." );
            return $this->redirect(['expedientes/index'])->send();
           /*  return $this->render('index', [
                'modelNuevoExp' => $modelNuevoExp,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
 */
        
        }
 
        // form inputs are valid, do something here
        
        $expCreationResult = $modelNuevoExp->createExpediente();
        Yii::$app->session->setFlash(
            $expCreationResult["success"]  ?'success':'danger' ,
            $expCreationResult["MSG"]
        );
        
        return $this->redirect(['expedientes/index'])->send();

        /* if( $expCreationResult["success"]){
        
            
        }

        return $this->render('index', [
            'modelNuevoExp' => $modelNuevoExp,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); */
    }


       /**
     * Displays a single Expediente model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Expediente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Expediente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

        /**
     * Finds the Expediente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Expediente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expediente::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
