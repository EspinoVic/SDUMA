<?php

use common\models\Contacto;
use common\models\Domicilio;
use common\models\GeneroConstruccion;
use common\models\MotivoConstruccion;
use common\models\SolicitudConstruccion;
use common\models\SubGeneroConstruccion;
use common\models\TipoPredio;
use PhpParser\Node\Expr\Cast\Array_;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use   yii\widgets\ActiveField;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccionCreateForm $modelSolicitudConstruccionCreateForm */
/** @var yii\widgets\ActiveForm $form */

 
?>

<div class="solicitud-construccion-form">




    <?php $form = ActiveForm::begin(

        [
        'action' =>['solicitud-construccion/create'], 
        'id' => 'solicitudConstruccionForm', 
        'method' => 'post',
        'options' =>[
            'class' => 'row g-3'
            ]
        ]
    ); ?>

    <h5><?= Html::encode("Contacto") ?></h5> 
    <?
         
        $form->field($modelSolicitudConstruccionCreateForm->contacto, 'contacto_email',['options' => ['class' => 'col-md-3']]) ->textInput( ) ;
        $form->field($modelSolicitudConstruccionCreateForm->contacto, 'contacto_telefono',['options' => ['class' => 'col-md-3']])->textInput( ); 
 
    ?>

 


    <h5><?= Html::encode("Domicilio para notificaciones") ?></h5>
    
    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_Persona_DomicilioNotificaciones')->textInput() ?>
    <?= $this->render("_domicilio_fields",['domicilio'=> $modelSolicitudConstruccionCreateForm->personaDomicilioNotificaciones, 'form'=> $form]) ?>           


    <?=$form->field($modelSolicitudConstruccionCreateForm,"id_MotivoConstruccion")->dropDownList(
            $items = 
            ArrayHelper::map(
                MotivoConstruccion::findAll(['isActivo'=> 1]),
                'id',/* closure too */
                function($currentTipoTramite) {
                    return $currentTipoTramite['nombre'];/* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )

            
    )->label("Motivo de solicitud") ?>

    <h4>Información del predio </h4>
    <?=$form->field( $modelSolicitudConstruccionCreateForm,"id_TipoPredio",['options' => ['class' => 'col-md-3']]  )
        ->dropDownList(
           $items = 
           ArrayHelper::map(
               TipoPredio::findAll(['isActivo'=> 1]),
               'id',/* closure too */
               function($currentTipoTramite) {
                   return $currentTipoTramite['nombre'];/* .'-'.$currentTipoTramite['seconde parameter']; */
               }
            ) 
       )->label("Tipo de predio Dropdown") ?>

   <?= $form->field( $modelSolicitudConstruccionCreateForm,$attribute = 'superficieTotal',['options' => ['class' => 'col-md-3']])  ?>

   <?= $form->field($modelSolicitudConstruccionCreateForm, 'superficiePorConstruir',['options' => ['class' => 'col-md-3']])->textInput( ) ?>
   
   
   <h4>Información de la construcción</h4>
   
   
   <h5><?= Html::encode("Domicilio del predio") ?></h5>
   
    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_DomicilioPredio',['options' => ['class' => 'col-md-3']] )->textInput() ?>
    <?= $this->render("_domicilio_fields",['domicilio'=> $modelSolicitudConstruccionCreateForm->personaDomicilioNotificaciones, 'form'=> $form]) ?>           


    <h5><?= Html::encode("Detalles") ?></h5>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_GeneroConstruccion',['options' => ['class' => 'col-md-3']])
    ->dropDownList(  $items =
            ArrayHelper::merge(
                ['0' => 'Seleccione'],
                ArrayHelper::map( GeneroConstruccion::findAll(['isActivo'=> 1]), 'id', 'nombre') 
            ),
            ['onchange'=>'this.form.submit()'] //options
        )-> label('Genero de Construcción') 
    ?>
 <!-- ['onchange'=>'this.form.submit()'] //options -->
    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_SubGeneroConstruccion',['options' => ['class' => 'col-md-3']])
    ->dropDownList(  
            $items = 
            ArrayHelper::merge(
                ['0' => 'Seleccione genero'],
                ArrayHelper::map(
                SubGeneroConstruccion::findAll([
                    'isActivo'=> 1, 'id_GeneroConstruccion'=> $modelSolicitudConstruccionCreateForm->id_GeneroConstruccion ]),
                'id', 'nombre') 

            )
        )->label('Subgenero de Construcción') 
    ?>

    <div class ="row g3">
        
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'niveles',['options' => ['class' => 'col-md-3']])->textInput() ?>
     
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'cajones',['options' => ['class' => 'col-md-3']])->textInput() ?>
     
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'COS',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
     
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'CUS',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    </div>

    
    

    <div class="row g3">
        <!-- falta titulo de propiedad xd, agregarlo a DB  -->

        <?= $form->field($modelSolicitudConstruccionCreateForm, 'RPP',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelSolicitudConstruccionCreateForm, 'tomo',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'folioElec',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'cuentaCatastral',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccionCreateForm, 'superficiePreexistente',['options' => ['class' => 'col-md-3']])->textInput(['type'=>'numer']) ?>
    </div>



    <?= $form->field($modelSolicitudConstruccionCreateForm, 'fechaCreacion')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'fechaModificacion')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'isDeleted')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_Persona_CreadoPor')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_Persona_ModificadoPor')->textInput() ?>





    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_Contacto')->textInput() ?>


    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_TipoConstruccion')->textInput() ?>


    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_DirectorResponsableObra')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_CorrSeguridadEstruc')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccionCreateForm, 'id_Expediente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
