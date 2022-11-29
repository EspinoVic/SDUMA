<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
/* use kartik\datetime\DateTimePicker; */
/* use kartik\time\TimePicker; */

/** @var yii\web\View $this */
/** @var common\models\Horario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="horario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
<!-- https://demos.krajee.com/widget-details/datetimepicker -->
    <?= $form->field($model, 'inicioActividad') /* cambiar por textboxes alv */
         ->textInput()
         ->label("Inicio Actividad")
    ?>

    <?= $form->field($model, 'finActividad',)

        ->textInput()
        ->label("Fin Actividad")
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
