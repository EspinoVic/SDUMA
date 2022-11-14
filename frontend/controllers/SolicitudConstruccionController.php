<?php

namespace frontend\controllers;

use common\models\Contacto;
use common\models\SolicitudConstruccion;
use common\models\SolicitudConstruccionSearch;
use frontend\models\SolicitudConstruccionCreateForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolicitudConstruccionController implements the CRUD actions for SolicitudConstruccion model.
 */
class SolicitudConstruccionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all SolicitudConstruccion models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudConstruccionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudConstruccion model.
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
     * Creates a new SolicitudConstruccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SolicitudConstruccionCreateForm/* CreateForm */();
        Yii::$app->session->setFlash( 'success',   "IsPOST:". $this->request->isPost  );
        Yii::$app->session->setFlash( 'warning',   "ContactoNull? ->".is_null($model->contacto) );
  /*       Yii::$app->session->setFlash( 'danger',   "ID Genero Construc:". $model->id_GeneroConstruccion  ); */

        if ($this->request->isPost) {
            //si la carga del modelo falla, entonces sale del if renderiza los errores, si ocupo un onChange en un DROPDOWN, podría funcionar
            if ($model->load($this->request->post()) /* $model->save() */) {
                if(!$model->validate()){
                    Yii::$app->session->setFlash( 'danger',   "Error al validar los campos.." );
                    return $this->render('create', [
                        'modelSolicitudConstruccionCreateForm' => $model,
                    ]);   
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
          //  $model->loadDefaultValues();
        }


        return $this->render('create', [
            'modelSolicitudConstruccionCreateForm' => $model,
        ]);
    }

    /**
     * Updates an existing SolicitudConstruccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /* Si fue un POST, significa que envió el formulario para wardar cambios, 
        
        */
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        /* Si fue un get, entonces solo busca el modelo y lo renderiza */

        Yii::$app->session->setFlash( 'warning',   "Contacto null:". is_null($model->contacto) );
        if(is_null($model->contacto)){
            
            $model->contacto = new Contacto();
             
        }
        Yii::$app->session->setFlash( 'warning',   "Contacto null2 xd:". is_null($model->contacto) );

     /*    if(is_null($model->contacto)){
            
            $model->contacto = new Contacto();
            $model->contacto->id = -1;
            $model->contacto->email = "";
            $model->contacto->telefono = "";
        
        } */
        
        return $this->render('update', [
            'modelSolicitudConstruccion' => $model,
        ]);
    }

    /**
     * Deletes an existing SolicitudConstruccion model.
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
     * Finds the SolicitudConstruccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return SolicitudConstruccion the loaded model
     * @param int $id ID
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudConstruccion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
