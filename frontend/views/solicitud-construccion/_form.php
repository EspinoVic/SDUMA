<?php

use common\models\CorrSeguridadEstruc;
use common\models\GeneroConstruccion;
use common\models\MotivoConstruccion;
use common\models\SolicitudConstruccion;
use common\models\SubGeneroConstruccion;
use common\models\DirectorResponsableObra;
use common\models\Expediente;
use common\models\TipoConstruccion;
use common\models\TipoPredio;
use PhpParser\Node\Expr\Cast\Array_;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

/**
 * @var common\models\SolicitudConstruccion $modelSolicitudConstruccion
 * @var common\models\Contacto $soliContacto
 * @var common\models\Persona $propietarioPersona
 * @var common\models\Domicilio $soliDomicilioNotif
 * @var common\models\Domicilio $soliDomicilioPredio
 * @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments
 */

$expenditenOwnerSoli = Expediente::findOne([
    'id' => $modelSolicitudConstruccion->id_Expediente,
]);
?>

<div class="solicitud-construccion-form">

    <?php $form = ActiveForm::begin([
        'action' => ['solicitud-construccion/create'],
        'id' => 'solicitudConstruccionForm',
        'method' => 'post',
        'options' => [
            'class' => 'row g-3',
        ],
    ]); ?>

    <h3><?= 'Solicitud para expediente: ' .
        $expenditenOwnerSoli->idAnual .
        '/' .
        $expenditenOwnerSoli->anio ?></h5> 
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_Expediente', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ]) /* ->textInput() */
        ->hiddenInput()
        ->label(false) ?>
    
    <?= $form
        ->field($modelSolicitudConstruccion, 'fechaCreacion', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>
    <?= $form
        ->field($modelSolicitudConstruccion, 'fechaModificacion', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>

    <?= $form
        ->field($modelSolicitudConstruccion, 'isDeleted', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_Persona_ModificadoPor', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->hiddenInput()
        ->label(false) ?>


    <?= $form
        ->field($modelSolicitudConstruccion, 'id_Persona_CreadoPor', [
            'options' => ['class' => 'col-md-1', 'display' => 'none'],
        ])
        ->/* textInput()-> */ hiddenInput()
        ->label(false) ?>

    <h4>Propietario</h4>

    
    <?= $form
        ->field($propietarioPersona, 'nombre', [
            'options' => ['class' => 'col-md-7'],
        ])
        ->textInput() ?>
    <?= $form
        ->field($propietarioPersona, 'apellidoP', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->textInput() ?>
    <?= $form
        ->field($propietarioPersona, 'apellidoM', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->textInput() ?>
 
 
    <h5><?= Html::encode('Contacto') ?></h5> 
    
    <?= $form->field($modelSolicitudConstruccion, 'id_Contacto')->textInput() ?>


    <?= $form
        ->field($soliContacto, 'email', ['options' => ['class' => 'col-md-3']])
        ->textInput() ?>

    <?= $form
        ->field($soliContacto, 'telefono', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->textInput() ?>


    <h5><?= Html::encode('Domicilio para notificaciones') ?></h5>       
    <?= $form
        ->field(
            $modelSolicitudConstruccion,
            'id_Persona_DomicilioNotificaciones',
            ['options' => ['class' => 'col-md-3']]
        )
        ->textInput() ?>
    <?= $this->render('_domicilio_fields', [
        'domicilio' => $soliDomicilioNotif,
        'form' => $form,
        'id' => '0',
    ]) ?>           

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_MotivoConstruccion')
        ->dropDownList(
            $items = ArrayHelper::map(
                MotivoConstruccion::findAll(['isActivo' => 1]),
                'id' /* closure too */,
                function ($currentTipoTramite) {
                    return $currentTipoTramite[
                        'nombre'
                    ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )
        )
        ->label('Motivo de solicitud') ?>


    <h4>Información del predio </h4>
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_TipoPredio', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->dropDownList(
            $items = ArrayHelper::map(
                TipoPredio::findAll(['isActivo' => 1]),
                'id' /* closure too */,
                function ($currentTipoTramite) {
                    return $currentTipoTramite[
                        'nombre'
                    ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )
        )
        ->label('Tipo de predio Dropdown') ?>

   <?= $form->field(
       $model = $modelSolicitudConstruccion,
       $attribute = 'superficieTotal',
       ['options' => ['class' => 'col-md-3']]
   ) ?>

   <?= $form
       ->field($modelSolicitudConstruccion, 'superficiePorConstruir', [
           'options' => ['class' => 'col-md-3'],
       ])
       ->textInput() ?>
   

    <h5><?= Html::encode('Domicilio del predio') ?></h5>   
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_DomicilioPredio', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->textInput() ?>
    <?= $this->render('_domicilio_fields', [
        'domicilio' => $soliDomicilioPredio,
        'form' => $form,
        'id' => '1',
    ]) ?>           



   
    
   <h4>Información de la construcción</h4>
   
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_GeneroConstruccion', [
           'options' => ['class' => 'col-md-3'],
       ])
       ->dropDownList(
           $items = ArrayHelper::merge(
               ['0' => 'Seleccione'],
               ArrayHelper::map(
                   GeneroConstruccion::findAll(['isActivo' => 1]),
                   'id',
                   'nombre'
               )
           ),
           ['onchange' => 'this.form.submit()'] //options
       )
       ->label('Genero de Construcción') ?>
 <!-- ['onchange'=>'this.form.submit()'] //options -->
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_SubGeneroConstruccion', [
           'options' => ['class' => 'col-md-3'],
       ])
       ->dropDownList(
           $items = ArrayHelper::merge(
               ['0' => 'Seleccione genero'],
               ArrayHelper::map(
                   SubGeneroConstruccion::findAll([
                       'isActivo' => 1,
                       'id_GeneroConstruccion' =>
                           $modelSolicitudConstruccion->id_GeneroConstruccion,
                   ]),
                   'id',
                   'nombre'
               )
           )
       )
       ->label('Subgenero de Construcción') ?>
    
    <?= $form
        ->field($modelSolicitudConstruccion, 'id_TipoConstruccion', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione Tipo Construcción'],
                ArrayHelper::map(
                    TipoConstruccion::findAll([
                        'isActivo' => 1,
                    ]),
                    'id',
                    'nombre'
                )
            )
        )
        ->label('Tipo Construcción') ?>
    




    <div class ="row g3">
        
        <?= $form
            ->field($modelSolicitudConstruccion, 'niveles', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput() ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'cajones', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput() ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'COS', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>
     
        <?= $form
            ->field($modelSolicitudConstruccion, 'CUS', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

    </div>

    <?= $form
        ->field($modelSolicitudConstruccion, 'superficiePreexistente', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->textInput(['type' => 'numer']) ?>



    <div class="row g3">
        <!-- falta titulo de propiedad xd, agregarlo a DB  -->

        <?= $form
            ->field($modelSolicitudConstruccion, 'RPP', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'tomo', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'folioElec', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

        <?= $form
            ->field($modelSolicitudConstruccion, 'cuentaCatastral', [
                'options' => ['class' => 'col-md-3'],
            ])
            ->textInput(['maxlength' => true]) ?>

    </div>

    <?= $form
        ->field($modelSolicitudConstruccion, 'id_DirectorResponsableObra', [
            'options' => ['class' => 'col-md-6'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione Director'],
                ArrayHelper::map(
                    DirectorResponsableObra::findAll([
                        'isActivo' => 1,
                    ]),
                    'id',
                    function ($currentDirector) {
                        return $currentDirector['id'] .
                            ' - ' .
                            $currentDirector['abreviaicion'] .
                            '. ' .
                            $currentDirector['nombre'] .
                            ' ' .
                            $currentDirector['apellidoP'] .
                            ' ' .
                            $currentDirector['apellidoM'] .
                            ' ' .
                            $currentDirector['cedula'];
                    }
                )
            )
        )
        ->label('Director Responsable de Obra') ?>
   <?= $form
       ->field($modelSolicitudConstruccion, 'id_CorrSeguridadEstruc', [
           'options' => ['class' => 'col-md-6'],
       ])
       ->dropDownList(
           $items = ArrayHelper::merge(
               ['0' => 'Seleccione Corr. Seguridad'],
               ArrayHelper::map(
                   CorrSeguridadEstruc::findAll([
                       'isActivo' => 1,
                   ]),
                   'id',
                   function ($currentDirector) {
                       return $currentDirector['id'] .
                           ' - ' .
                           $currentDirector['abreviaicion'] .
                           '. ' .
                           $currentDirector['nombre'] .
                           ' ' .
                           $currentDirector['apellidoP'] .
                           ' ' .
                           $currentDirector['apellidoM'] .
                           ' ' .
                           $currentDirector['cedula'];
                   }
               )
           )
       )
       ->label('Corr. Seguridad Estructural') ?>
 
    <h4>Entregables</h4>

    <table class="table   table-hover">
        <thead>
            <tr>
                <th scope="col">Entregable</th>
                <th scope="col">Nombre Archivo</th>
                <th scope="col">Acciones</th>
                <th scope="col"></th>
 
            </tr>
        </thead>
        <tbody>

            <?php foreach ($soliHasDocuments as $id => $soliHasDocument) { ?>
            <tr onclick="">
                <td>
                    <?php echo $form
                        ->field($soliHasDocument, "[$id]nombreArchivo")
                        ->checkbox([
                            $soliHasDocument->isEntregado ? 'checked' : '' => '',
                        ])
                        ->label($soliHasDocument->documento->nombre); ?>
                </td>
                <td>
                    <span >Archivo cargado.jpeg</span>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger">Borrar</button>
                </td>
                <td>
                    <input class="form-control form-control-sm  " id="formFileSm" type="file">

                </td>
            </tr>
        <?php } ?>


        
        </tbody>
    </table>
 
  

 
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
