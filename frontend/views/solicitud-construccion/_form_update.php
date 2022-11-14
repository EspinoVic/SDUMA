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
/** @var common\models\SolicitudConstruccion $modelSolicitudConstruccion */
/** @var yii\widgets\ActiveForm $form */

 
?>

<div class="solicitud-construccion-form">




    <?php $form = ActiveForm::begin(

        [
        'action' =>['solicitud-construccion/update'], 
        'id' => 'solicitudConstruccionForm', 
        'method' => 'post',
        'options' =>[
            'class' => 'row g-3'
            ]
        ]
    ); ?>

    <h5><?= Html::encode("Contacto") ?></h5> 
    <?
        if(is_null($modelSolicitudConstruccion->contacto))
        {
            $form->field($modelSolicitudConstruccion->contacto, 'id',['options' => ['class' => 'col-md-3']]);   
            $form->field($modelSolicitudConstruccion->contacto, 'email',['options' => ['class' => 'col-md-3']]) ->textInput( ) ;
            $form->field($modelSolicitudConstruccion->contacto, 'telefono',['options' => ['class' => 'col-md-3']])->textInput( ); 
        }else{
            $form->field($modelSolicitudConstruccion->contacto, 'id',['options' => ['class' => 'col-md-3']]);
            $form->field($modelSolicitudConstruccion->contacto, 'email',['options' => ['class' => 'col-md-3']]) ->textInput( ) ;
            $form->field($modelSolicitudConstruccion->contacto, 'telefono',['options' => ['class' => 'col-md-3']])->textInput( ); 
        }
    ?>

 


    <h5><?= Html::encode("Domicilio para notificaciones") ?></h5>
    
    <?= $form->field($modelSolicitudConstruccion, 'id_Persona_DomicilioNotificaciones')->textInput() ?>
    <?= $this->render("_domicilio_fields",['domicilio'=> $modelSolicitudConstruccion->personaDomicilioNotificaciones, 'form'=> $form]) ?>           


    <?=$form->field($modelSolicitudConstruccion,"id_MotivoConstruccion")->dropDownList(
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
    <?=$form->field( $modelSolicitudConstruccion,"id_TipoPredio",['options' => ['class' => 'col-md-3']]  )
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

   <?= $form->field( $modelSolicitudConstruccion,$attribute = 'superficieTotal',['options' => ['class' => 'col-md-3']])  ?>

   <?= $form->field($modelSolicitudConstruccion, 'superficiePorConstruir',['options' => ['class' => 'col-md-3']])->textInput( ) ?>
   
   
   <h4>Información de la construcción</h4>
   
   
   <h5><?= Html::encode("Domicilio del predio") ?></h5>
   
    <?= $form->field($modelSolicitudConstruccion, 'id_DomicilioPredio',['options' => ['class' => 'col-md-3']] )->textInput() ?>
    <?= $this->render("_domicilio_fields",['domicilio'=> $modelSolicitudConstruccion->personaDomicilioNotificaciones, 'form'=> $form]) ?>           


    <h5><?= Html::encode("Detalles") ?></h5>

    <?= $form->field($modelSolicitudConstruccion, 'id_GeneroConstruccion',['options' => ['class' => 'col-md-3']])
    ->dropDownList(  $items =
            ArrayHelper::merge(
                ['0' => 'Seleccione'],
                ArrayHelper::map( GeneroConstruccion::findAll(['isActivo'=> 1]), 'id', 'nombre') 
            ),
            ['onchange'=>'this.form.submit()'] //options
        )-> label('Genero de Construcción') 
    ?>
 <!-- ['onchange'=>'this.form.submit()'] //options -->
    <?= $form->field($modelSolicitudConstruccion, 'id_SubGeneroConstruccion',['options' => ['class' => 'col-md-3']])
    ->dropDownList(  
            $items = 
            ArrayHelper::merge(
                ['0' => 'Seleccione genero'],
                ArrayHelper::map(
                SubGeneroConstruccion::findAll([
                    'isActivo'=> 1, 'id_GeneroConstruccion'=> $modelSolicitudConstruccion->id_GeneroConstruccion ]),
                'id', 'nombre') 

            )
        )->label('Subgenero de Construcción') 
    ?>

    <div class ="row g3">
        
        <?= $form->field($modelSolicitudConstruccion, 'niveles',['options' => ['class' => 'col-md-3']])->textInput() ?>
     
        <?= $form->field($modelSolicitudConstruccion, 'cajones',['options' => ['class' => 'col-md-3']])->textInput() ?>
     
        <?= $form->field($modelSolicitudConstruccion, 'COS',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
     
        <?= $form->field($modelSolicitudConstruccion, 'CUS',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    </div>

    
    

    <div class="row g3">
        <!-- falta titulo de propiedad xd, agregarlo a DB  -->

        <?= $form->field($modelSolicitudConstruccion, 'RPP',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelSolicitudConstruccion, 'tomo',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccion, 'folioElec',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccion, 'cuentaCatastral',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($modelSolicitudConstruccion, 'superficiePreexistente',['options' => ['class' => 'col-md-3']])->textInput(['type'=>'numer']) ?>
    </div>



    <?= $form->field($modelSolicitudConstruccion, 'fechaCreacion')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'fechaModificacion')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'isDeleted')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'id_Persona_CreadoPor')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'id_Persona_ModificadoPor')->textInput() ?>





    <?= $form->field($modelSolicitudConstruccion, 'id_Contacto')->textInput() ?>


    <?= $form->field($modelSolicitudConstruccion, 'id_TipoConstruccion')->textInput() ?>


    <?= $form->field($modelSolicitudConstruccion, 'id_DirectorResponsableObra')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'id_CorrSeguridadEstruc')->textInput() ?>

    <?= $form->field($modelSolicitudConstruccion, 'id_Expediente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
