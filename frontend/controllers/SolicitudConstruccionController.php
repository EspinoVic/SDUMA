<?php

namespace frontend\controllers;

use common\models\Contacto;
use common\models\Documento;
use common\models\Domicilio;
use common\models\Expediente;
use common\models\Persona;
use common\models\SolicitudConstruccion;
use common\models\SolicitudConstruccionHasDocumento;
use common\models\SolicitudConstruccionSearch;
use common\models\TipoTramiteHasDocumento;
use common\models\TipoTramite;
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
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
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
    function multi_implode($array, $glue)
    {
        $ret = '';

        foreach ($array as $item) {
            if (is_array($item)) {
                $ret .= $this->multi_implode($item, $glue) . $glue;
            } else {
                $ret .= $item . $glue;
            }
        }

        $ret = substr($ret, 0, 0 - strlen($glue));

        return $ret;
    }
    /**
     * Creates a new SolicitudConstruccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    //Debe traer el id de expediente
    public function actionCreate()
    {
        $CREATE_SOLI_EXPEDIENTE_NUMBER = 3;
        $modelSolicitudConstruccion = new SolicitudConstruccion();
        $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;
        $modelSolicitudConstruccion->id_Persona_CreadoPor = -1;
        $modelSolicitudConstruccion->id_Persona_ModificadoPor = -1;
        $modelSolicitudConstruccion->fechaCreacion = gmdate('Y-m-d\TH:i:s\Z');
        $modelSolicitudConstruccion->fechaModificacion = gmdate(
            'Y-m-d\TH:i:s\Z'
        );

        $propietarioPersona = new Persona(); //debería ser un array, por ahora lo dejo así
        $soliDomicilioNotif = new Domicilio();
        $soliDomicilioPredio = new Domicilio();
        $multiplesDomicilio = [$soliDomicilioNotif, $soliDomicilioPredio];

        $soliContacto = new Contacto();
        $soliContacto->id = -1;

        //$documentos[] = new Documento();
        $soliHasDocuments = array();//[] = new SolicitudConstruccionHasDocumento();

        $docsAvailableForCurrTraMite = TipoTramiteHasDocumento::findAll([
            'id_TipoTramite' => Expediente::findOne([
                'id' => $CREATE_SOLI_EXPEDIENTE_NUMBER,
            ])->id_TipoTramite,
        ]);

        foreach ($docsAvailableForCurrTraMite as $index => $currAvailable) {
            # code...
            $currSoliHasDocument = new SolicitudConstruccionHasDocumento();
            $currSoliHasDocument->id_Documento = $currAvailable ->id_Documento;
           // $currSoliHasDocument->documento = $currAvailable ->documento;
            $currSoliHasDocument->isEntregado = true; 
            $currSoliHasDocument->nombreArchivo = "Sin nombre $index"; 
            $currSoliHasDocument->path = "Sin path";
            $currSoliHasDocument->realNombreArchivo = "Sin nombre real";
            $soliHasDocuments[] =  $currSoliHasDocument;
        }

        // Yii::$app->session->setFlash( 'warning',   "IsPOST:". $this->request->isPost  );
        // Yii::$app->session->setFlash( 'danger',   "LoadModel:". $modelSolicitudConstruccion->load( $this->request->post() ) );
        /*       Yii::$app->session->setFlash( 'danger',   "ID Genero Construc:". $modelSolicitudConstruccion->id_GeneroConstruccion  ); */

        if ($this->request->isPost) {
            if (
                $modelSolicitudConstruccion->load($this->request->post()) &&
                $propietarioPersona->load($this->request->post()) &&
                $soliContacto->load($this->request->post()) &&
                Domicilio::loadMultiple(
                    $multiplesDomicilio,
                    $this->request->post()
                ) &&
                Domicilio::validateMultiple($multiplesDomicilio)
                /* && $modelSolicitudConstruccion->save() */
            ) {
                Yii::$app->session->setFlash('success', 'GOOD:');

                //return $this->redirect(['view', 'id' => $modelSolicitudConstruccion->id]);
            }
        } else {
            $modelSolicitudConstruccion->loadDefaultValues();
        }

        return $this->render('create', [
            'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
            'propietarioPersona' => $propietarioPersona,
            'soliDomicilioNotif' => $multiplesDomicilio[0],
            'soliDomicilioPredio' => $multiplesDomicilio[1],
            'soliContacto' => $soliContacto,
            'soliHasDocuments' => $soliHasDocuments,
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

        if (
            $this->request->isPost &&
            $model->load($this->request->post()) &&
            $model->save()
        ) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

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
     * @param int $id ID
     * @return SolicitudConstruccion the loaded model
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
