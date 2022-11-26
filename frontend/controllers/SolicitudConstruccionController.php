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
use PDO;
use PDOException;
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

    /* 
    Este action deberá ser llamado desde ExpedientesController.
    Aqui decidirá si la solicitud del expediente irá a edición o creación.
    */
    public function actionIndex($exp){

        $soliExp = SolicitudConstruccion::findOne(["id_Expediente" => $exp]);

        if($soliExp){
                return $this->redirect(['update', 'exp' => $soliExp->id]);

        }else{
            return $this->redirect(['create', 'exp' => $exp]);
        }

    }
    /**
     * Lists all SolicitudConstruccion models.
     *
     * @return string
     * @deprecated
     */
    public function actionIndexDeprecated()
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
    public function actionCreate($exp)
    {
        $CREATE_SOLI_EXPEDIENTE_NUMBER = $exp;

        $modelSolicitudConstruccion = new SolicitudConstruccion();

        $propietarioPersona     = new Persona(); //debería ser un array, por ahora lo dejo así
        $soliDomicilioNotif     = new Domicilio();
        $soliDomicilioPredio    = new Domicilio();
        $multiplesDomicilio     = [$soliDomicilioNotif, $soliDomicilioPredio];
        $soliContacto           = new Contacto();
        $soliHasDocuments       = [];  

         if ($this->request->isPost) {
            /* Si el array de modelos fuera estatico, se podría hacer con el count comentado */
           /*  $countSoliHasDocument = count(
                $this->request->post('SolicitudConstruccionHasDocumento') //no funciona con el nombre de la tabla, ya que los "_" se quitan y se usa CamelCase, y cuando esos campos se devuelven del form al POST, vienen en CamelCase, por lo tanto no hacen match con el table name
            );
            Yii::$app->session->setFlash('danger', 'CountSoliDoc:'.$countSoliHasDocument); */
           // var_dump($this->request->post('SolicitudConstruccionHasDocumento'));
            foreach ($this->request->post('SolicitudConstruccionHasDocumento') as $key => $value/* modelo de soliHasDoc */) {

                $soliHasDocuments[$key] = new SolicitudConstruccionHasDocumento();
                $soliHasDocuments[$key]->id_SolicitudConstruccion =
                 /*PROBAR CON -1, YA QUE ESTE VALOR DEBERÁ SERR MANEJADO POR EL sp, CUANDO LA SOLICITUD SEA CREAdA. -1 */
                 $CREATE_SOLI_EXPEDIENTE_NUMBER;
                
               
            }
            $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;

            if (
                $modelSolicitudConstruccion->load($this->request->post()) &&
                $propietarioPersona->load($this->request->post()) &&
                $soliContacto->load($this->request->post()) &&
                Domicilio::loadMultiple(
                    $multiplesDomicilio,
                    $this->request->post()
                ) &&
                Domicilio::validateMultiple($multiplesDomicilio) &&
                SolicitudConstruccionHasDocumento::loadMultiple(
                    $soliHasDocuments,
                    $this->request->post()
                )
                && SolicitudConstruccionHasDocumento::validateMultiple($soliHasDocuments)
            ) {
                Yii::$app->session->setFlash('success', 'GOOD:');
                
                if($modelSolicitudConstruccion -> id_DirectorResponsableObra == 0){
                    
                    $modelSolicitudConstruccion -> id_DirectorResponsableObra = null;
                }
                if($modelSolicitudConstruccion -> id_CorrSeguridadEstruc == 0){
                    $modelSolicitudConstruccion -> id_CorrSeguridadEstruc = null;
                }
                if($modelSolicitudConstruccion -> id_SubGeneroConstruccion == 0){
                    $modelSolicitudConstruccion -> id_SubGeneroConstruccion = null;
                }


                //Yii::$app->session->setFlash('warning', "nombreArchivo1:".$soliHasDocuments[0] -> nombreArchivo);
                $modelSolicitudConstruccion ->createSolicitudExpediente (
                                $propietarioPersona,  
                                $soliDomicilioNotif ,
                                $soliDomicilioPredio,
                                $soliContacto,  
                                $soliHasDocuments,
                                Yii::$app->user->identity->id   
                );
                

                
                //return $this->redirect(['view', 'id' => $modelSolicitudConstruccion->id]);
            }
        } else {
            //cuando no es post
            $modelSolicitudConstruccion->loadDefaultValues();
            $modelSolicitudConstruccion->id_Expediente = $CREATE_SOLI_EXPEDIENTE_NUMBER;
            $modelSolicitudConstruccion->id_User_ModificadoPor = -1;
            $modelSolicitudConstruccion->id_User_ModificadoPor = -1;
            $modelSolicitudConstruccion->fechaCreacion = gmdate(
                'Y-m-d\TH:i:s\Z'
            );
            $modelSolicitudConstruccion->fechaModificacion = gmdate(
                'Y-m-d\TH:i:s\Z'
            );
            $modelSolicitudConstruccion->id_Contacto = -1; 
            $modelSolicitudConstruccion->id_DomicilioNotificaciones = -1; 
            $modelSolicitudConstruccion->id_DomicilioPredio = -1; 
            $soliContacto->id = -1;
            $soliDomicilioNotif -> id = -1;
            $soliDomicilioPredio -> id = -1;
            //los docs availables solo la primera vez (cuando se hace un GET), luego el usuario podrá descartar los que no ocupe☺
            $docsAvailableForCurrTraMite = TipoTramiteHasDocumento::findAll([
                'id_TipoTramite' => Expediente::findOne([
                    'id' => $CREATE_SOLI_EXPEDIENTE_NUMBER,
                ])->id_TipoTramite,
            ]);

            foreach ($docsAvailableForCurrTraMite as $index => $currAvailable) {
                $currSoliHasDocument = new SolicitudConstruccionHasDocumento();
                $currSoliHasDocument->id_Documento =  $currAvailable->id_Documento/* *84 */;
                // $currSoliHasDocument->documento = $currAvailable ->documento;
                $currSoliHasDocument->isEntregado = true;
                $currSoliHasDocument->nombreArchivo = "Sin nombre $currAvailable->id_Documento";
                $currSoliHasDocument->path = 'Sin path';
                $currSoliHasDocument->realNombreArchivo = 'Sin nombre real';
                $soliHasDocuments[$index] = $currSoliHasDocument; //crea nuevo en posición index
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
    public function actionUpdate($exp)
    {
        //solicitudConstruccionTable, Desde el modelo se pueden cargar todos los datos relacionados.
        $model = $this->findModel($exp);


        return $this->render('create', [
            'modelSolicitudConstruccion' => $model->modelSolicitudConstruccion,
            'propietarioPersona' => $model->propietarioPersona,
            'soliDomicilioNotif' => $model->multiplesDomicilio[0],
            'soliDomicilioPredio' => $model->multiplesDomicilio[1],
            'soliContacto' => $model->soliContacto,
            'soliHasDocuments' => $model->soliHasDocuments,
        ]);
        /* if (
            $this->request->isPost &&
            $model->load($this->request->post()) &&
            $model->save()
        ) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'modelSolicitudConstruccion' => $model,
        ]); */
    }


    public function actionTvp(){


        $image1 = "asdasd";
        $image2 = "asdasd";
        $image3 = "asdasd";

        $items = [
            ['0062836700', 367, "2009-03-12", 'AWC Tee Male Shirt', '20.75', $image1],
            ['1250153272', 256, "2017-11-07", 'Superlight Black Bicycle', '998.45', $image2],
            ['1328781505', 260, "2010-03-03", 'Silver Chain for Bikes', '88.98', $image3],
        ];

        // Create a TVP input array
        $tvpType = 'TVPParam';
        $tvpInput = array($tvpType => $items);

        // To execute the stored procedure, either execute a direct query or prepare this query:
        $callTVPOrderEntry = "{call TVPOrderEntry(:CustID, :Items, :OrdNo, :OrdDate)}";
        $custCode = 'SRV_123';
        $ordNo = 0;
        $ordDate = null;
        try {
            ob_start();
            
            $c = new PDO("sqlsrv:Server=localhost\\SDUMA_DB;Database=sduma", "sa", "vic");
            var_dump($c);
            var_dump("UWU");
            var_dump(Yii::$app->db);
            Yii::debug(ob_get_clean(),__METHOD__);
 

            $stmt = $c->prepare($callTVPOrderEntry);
            $stmt->bindParam(":CustID", $custCode);
            $stmt->bindParam(":Items", $tvpInput, PDO::PARAM_LOB);
            // 3 - OrdNo output
            $stmt->bindParam(":OrdNo", $ordNo, PDO::PARAM_INT, 10);
            // 4 - OrdDate output
            $stmt->bindParam(":OrdDate", $ordDate, PDO::PARAM_STR, 20);
            $stmt->execute();
        } catch (PDOException $ex) {
            Yii::info($ex, $category = 'ERROR Execute command.');

        }
                        /*  $stmt = sqlsrv_query($conn, $callTVPOrderEntry, $params);
        if (!$stmt) {
            print_r(sqlsrv_errors());
        }
        sqlsrv_next_result($stmt); */
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
