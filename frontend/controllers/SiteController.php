<?php

namespace frontend\controllers;

use common\models\ConfigTramiteMotivoCuentaconDoc;
use common\models\ConstanciaEscritura;
use common\models\ConstanciaPosecionEjidal;
use common\models\Contacto;
use common\models\DirectorResponsableObra;
use common\models\Documento;
use common\models\Domicilio2;
use common\models\Escritura;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\ProbarActive;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use common\models\Persona;
use common\models\PersonaMoral;
use common\models\SolicitudConstruccion;
use common\models\SolicitudGenerica;
use common\models\SolicitudGenericaCuentaCon;
use common\models\TipoTramite;
use common\models\UploadFileVic;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup','about'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                    ,
                    [
                        'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                     
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSegunda(){

        $domicilioNotif = new Domicilio2();
        $domicilioPredio = new Domicilio2();
        $personaSolicita = new Persona();
        $personaMoralSolicita = new PersonaMoral();

        $modelEscritura = new Escritura();
        $modelConstanciaEscritura = new ConstanciaEscritura();
        $modelConstanciaPosecionEjidal = new ConstanciaPosecionEjidal();
        $modelSolicitudGenerica = new SolicitudGenerica();
        $modelTramiteMotivoCuentaConDoc = null;/*  array(); */
        $modelFilesRef_TramiteMotivoCuentaConDoc = array();
        
        $modelDRO = new DirectorResponsableObra();
        $modelPersonaDRO= new Persona();

        $modelPropietarios = array();
        $modelPropietarios[1] = new Persona();
        $modelContacto = new Contacto();
       
        $memoriaCalculoFile = new UploadFileVic(); // new UploadedFile();//file
        $mecanicaSuelosFile = new UploadFileVic();
        $licenciaConstruccionAreaPreexistenteFile = new UploadFileVic();
        $licenciaConstruccionAreaPreexistenteFile->scenario = UploadFileVic::SCENARIO_NO_MANDATORY_FILE;

        $modelDROList = DirectorResponsableObra::findAll(["isActivo"=>1]);

        if($this->request->isPost){
            $noPropietario =$this->request->post("noPropietario");
            $modelPropietarios[1]->load($this->request->post("Persona"),"propietario1");

            if(is_numeric($noPropietario) && $noPropietario > 1){
                for ($i=2; $i <=$noPropietario ; $i++) {  //index 1 ya fue asignado afuera 
                    $modelPropietarios[$i] = new Persona();
                    $modelPropietarios[$i]->load($this->request->post("Persona"),"propietario$i");
                }
            }
           // $modelSolicitudConstruccion->load($this->request->post());
            $modelSolicitudGenerica->load($this->request->post());
            // extraer vars para archivos
            $modelTramiteMotivoCuentaConDoc = ConfigTramiteMotivoCuentaconDoc::findAll(
                [
                    "id_TipoTramite"=>1,//TipoTramite::findOne(["nombre"=>"CONTRUCCION"]) //trámite construcción
                    "id_MotivoConstruccion"=>$modelSolicitudGenerica->id_MotivoConstruccion,
                    "id_SolicitudGenericaCuentaCon"=>$modelSolicitudGenerica->id_SolicitudGenericaCuentaCon,
                    //"doc"=>1,            
                ]
            );
            foreach ($modelTramiteMotivoCuentaConDoc as $key => $curr) {
                $modelFilesRef_TramiteMotivoCuentaConDoc["entregable$curr->id_Documento"] =  new UploadFileVic(); 

            }
           


        
            $personaSolicita->load($this->request->post("Persona"),"personaF");
            $modelPersonaDRO->load($this->request->post("Persona"),"DRO");
            $memoriaCalculoFile->myFile = UploadedFile::getInstance($memoriaCalculoFile,'myFile');
            if($memoriaCalculoFile->myFile){
                
                $memoriaCalculoFile->myFile->saveAs(
                    "C:\\sduma_files\\".$memoriaCalculoFile->myFile->baseName . 
                    "." . $memoriaCalculoFile->myFile->extension
                    ,false);
            }
            $licenciaConstruccionAreaPreexistenteFile->myFile = UploadedFile::getInstance($licenciaConstruccionAreaPreexistenteFile,'myFile');
                
        }

 /*        if(!$modelTramiteMotivoCuentaConDoc){

            //default EDIT: No hay default, viene definido por el post siempre.
            $modelTramiteMotivoCuentaConDoc = ConfigTramiteMotivoCuentaconDoc::findAll(
               [
                   "id_TipoTramite"=>1,
                   "id_MotivoConstruccion"=>1,
                   "id_SolicitudGenericaCuentaCon"=>1,
                   //"doc"=>1,            
               ]
           );
        }
 */

        return $this->render('segunda', [
             
            'domicilioNotif' => $domicilioNotif ,
            'domicilioPredio' => $domicilioPredio ,
            'personaSolicita' => $personaSolicita ,
            'personaMoralSolicita' => $personaMoralSolicita ,
            //'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
            'modelEscritura' => $modelEscritura,
            'modelConstanciaEscritura' => $modelConstanciaEscritura,
            'modelConstanciaPosecionEjidal' => $modelConstanciaPosecionEjidal,            
            'modelSolicitudGenerica' => $modelSolicitudGenerica,
            'modelTramiteMotivoCuentaConDoc'=> $modelTramiteMotivoCuentaConDoc,
            'modelFilesRef_TramiteMotivoCuentaConDoc'=> $modelFilesRef_TramiteMotivoCuentaConDoc,
            'memoriaCalculoFile' =>$memoriaCalculoFile,
            'licenciaConstruccionAreaPreexistenteFile' =>$licenciaConstruccionAreaPreexistenteFile,
            'mecanicaSuelosFile' => $mecanicaSuelosFile,
            'modelDRO' => $modelDRO,
            'modelPersonaDRO' => $modelPersonaDRO,
            'modelPropietarios' => $modelPropietarios,
            'modelContacto' => $modelContacto,
            'modelDROList' => $modelDROList
        ]);
         

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    private function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    private function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() 
        ) {

            
            $resSignup = $model->signup();
            
            /* error,danger,success,info,warning */
            if($resSignup["success"]){

                Yii::$app->session->setFlash('success', 
                "Gracias por su registro. Email de verificación fue enviada a su correo $model->email.");
                return $this->goHome();
            }else{
                    Yii::$app->session->setFlash('danger', 
                    $resSignup["MSG"]
                );
               
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);

    }


    public function actionProbarActiveR(){
        ProbarActive::insertarAlv();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Su email ha sido verificado!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'No fue posible verificar su cuenta con el link usado.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


    public function actionPersona()
    {
        $model = new \common\models\persona();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('persona', [
            'model' => $model,
        ]);
    }
}
