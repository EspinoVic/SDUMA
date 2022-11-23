<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ExpedienteSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var string $nombre */
/** @var string $apellidoP */
/** @var string $apellidoM */
?>

<div class="expediente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'idAnual') ?>

    <?= $form->field($model, 'anio') ?>

    <?= $form->field($model, 'fechaCreacion') ?>

    <?= $form->field($model, 'fechaModificacion') ?>

    <?= Html::label("Nombre","nombre", ['class' => 'control-label'])  ?>
    <?= Html::input('text','nombre',$nombre, $options=['class'=>'form-control'/* ,'maxlength'=>10 *//* , 'style'=>'width:350px' */]) ?>

    <?= Html::label("Apellido Paterno","apellidoP", ['class' => 'control-label'])  ?>
    <?= Html::input('text','apellidoP',$apellidoP, $options=['class'=>'form-control'/* ,'maxlength'=>10 *//* , 'style'=>'width:350px' */]) ?>
 
    <?= Html::label("Apellido Materno","apellidoM", ['class' => 'control-label'])  ?>
    <?= Html::input('text','apellidoM',$apellidoM, $options=['class'=>'form-control'/* ,'maxlength'=>10 *//* , 'style'=>'width:350px' */]) ?>

   
    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'id_Persona_Solicita') ?>

    <?php // echo $form->field($model, 'id_User_CreadoPor') ?>

    <?php // echo $form->field($model, 'id_User_modificadoPor') ?>

    <?php // echo $form->field($model, 'id_TipoTramite') ?>

    <div class="form-group pt-3">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
