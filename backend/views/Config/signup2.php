<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 

use common\models\User2;
use common\models\Horario;

/** @var yii\web\View $this */
/** @var common\models\User2 $model */
/** @var ActiveForm $form */

/* $array = [
    ['id' => '123', 'name' => 'aaa', 'class' => 'x'],
    ['id' => '124', 'name' => 'bbb', 'class' => 'x'],
    ['id' => '345', 'name' => 'ccc', 'class' => 'y'],
];
 */
?>


 

<div class="signup2">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'auth_key') ?>
        <?= $form->field($model, 'password_hash') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'id_Datos_Persona') ?>
        <?= $form->field($model, 'status') ?>
       <!--  <?= $form->field($model, 'id_Horario') ?> -->
        <?= $form->field($model, 'password_reset_token') ?>
        <?= $form->field($model, 'verification_token') ?>
    
        <?= $form->field($model, 'id_Horario')->dropDownList(
            /* ArrayHelper::map(Horario::find()->all(),'id','inicioActividad'), */
            /* [10=>"uwu","vic"] */
            ArrayHelper::map(
                Horario::find()->all(),
                'id',
                function($HorarioModel){
                    return  $HorarioModel['nombre'].'  '.$HorarioModel['inicioActividad'].' - '.$HorarioModel['finActividad'];
                }

            ),
           /*  ArrayHelper::map($array, 'id', 'name', 'class'), */
            ['prompt'=>'Seleccione horario']
       )?> 

 

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- signup2 -->
