<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="expediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAnual')->textInput() ?>

    <?= $form->field($model, 'anio')->textInput() ?>

    <?= $form->field($model, 'fechaCreacion')->textInput() ?>

    <?= $form->field($model, 'fechaModificacion')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'id_Persona_Solicita')->textInput() ?>

    <?= $form->field($model, 'id_User_CreadoPor')->textInput() ?>

    <?= $form->field($model, 'id_User_modificadoPor')->textInput() ?>

    <?= $form->field($model, 'id_TipoTramite')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
