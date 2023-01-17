<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="config-tramite-motivo-cuentacon-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_TipoTramite')->textInput() ?>

    <?= $form->field($model, 'id_MotivoConstruccion')->textInput() ?>

    <?= $form->field($model, 'id_SolicitudGenericaCuentaCon')->textInput() ?>

    <?= $form->field($model, 'id_Documento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
