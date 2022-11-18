<?php

namespace frontend\controllers;

use common\models\Contacto;
use common\models\Documento;
use common\models\Domicilio;
use common\models\Expediente;
use common\models\Persona;
use common\models\SolicitudConstruccion;
use common\models\SolicitudConstruccionHasDocumento;
use common\models\SolicitudConstruccionHasPersona;
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

        $propietarioPersona = new Persona(); //debería ser un array, por ahora lo dejo así
        $soliDomicilioNotif = new Domicilio();
        $soliDomicilioPredio = new Domicilio();
        $multiplesDomicilio = [$soliDomicilioNotif, $soliDomicilioPredio];

        $soliContacto = new Contacto();

        $soliHasDocuments = []; //[] = new SolicitudConstruccionHasDocumento();
       /*  Yii::$app->request -> post() */
        if ($this->request->isPost) {
            $countSoliHasDocument = count(
                $this->request->post('SolicitudConstruccionHasDocumento') //no funciona con el nombre de la tabla, ya que los "_" se quitan y se usa CamelCase, y cuando esos campos se devuelven del form al POST, vienen en CamelCase, por lo tanto no hacen match con el table name
            );
 
            for ($i = 0; $i < $countSoliHasDocument; $i++) {
                $soliHasDocuments[$i] = new SolicitudConstruccionHasDocumento();
                $soliHasDocuments[$i]->id_SolicitudConstruccion = $CREATE_SOLI_EXPEDIENTE_NUMBER;
                $soliHasDocuments[$i]->id_Documento = $i;
            }
             if (
                $modelSolicitudConstruccion->load($this->request->post()) &&
                $propietarioPersona->load($this->request->post()) &&
                $soliContacto->load($this->request->post()) &&
                Domicilio::loadMultiple(
                    $multiplesDomicilio,
                    $this->request->post()
                ) &&
                Domicilio::validateMultiple($multiplesDomicilio) &&
                SolicitudConstruccionHasPersona::loadMultiple(
                    $soliHasDocuments,
                    $this->request->post()
                )
             ) {
                Yii::$app->session->setFlash('success', 'GOOD:');
                Yii::$app->session->setFlash('warning', "nombreArchivo1:".$soliHasDocuments[0] -> nombreArchivo);

                //return $this->redirect(['view', 'id' => $modelSolicitudConstruccion->id]);
            }
        } else {
            //cuando no es post
            $modelSolicitudConstruccion->loadDefaultValues();
            $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;
            $modelSolicitudConstruccion->id_Persona_CreadoPor = -1;
            $modelSolicitudConstruccion->id_Persona_ModificadoPor = -1;
            $modelSolicitudConstruccion->fechaCreacion = gmdate(
                'Y-m-d\TH:i:s\Z'
            );
            $modelSolicitudConstruccion->fechaModificacion = gmdate(
                'Y-m-d\TH:i:s\Z'
            );
            $soliContacto->id = -1;
            //los docs availables solo la primera vez (cuando se hace un GET), luego el usuario podrá descartar los que no ocupe☺
            $docsAvailableForCurrTraMite = TipoTramiteHasDocumento::findAll([
                'id_TipoTramite' => Expediente::findOne([
                    'id' => $CREATE_SOLI_EXPEDIENTE_NUMBER,
                ])->id_TipoTramite,
            ]);

            foreach ($docsAvailableForCurrTraMite as $index => $currAvailable) {
                $currSoliHasDocument = new SolicitudConstruccionHasDocumento();
                $currSoliHasDocument->id_Documento =  $currAvailable->id_Documento;
                // $currSoliHasDocument->documento = $currAvailable ->documento;
                $currSoliHasDocument->isEntregado = true;
                $currSoliHasDocument->nombreArchivo = "Sin nombre $index";
                $currSoliHasDocument->path = 'Sin path';
                $currSoliHasDocument->realNombreArchivo = 'Sin nombre real';
                $soliHasDocuments[] = $currSoliHasDocument; //crea nuevo en la ultima posicion
            }
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
