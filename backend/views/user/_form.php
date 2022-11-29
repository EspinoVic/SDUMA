<?php

use common\models\Horario;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\User;
use common\models\UserLevel;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    
    
    
    <?=$form->field($model,"status")->dropDownList(
        $items = [
                User::STATUS_INACTIVE =>"Eliminado", 
                User::STATUS_INACTIVE =>"Inactivo", 
                User::STATUS_ACTIVE =>"Activo", 
                 ]
        )->label("Estado del usuario")        
        ?>

    <?=$form->field($model,"id_Horario")->dropDownList(
                $items = 
                ArrayHelper::map(
                    Horario::find( )->all(),
                    'id',/* closure too */
                    function ($currHorario){
                        return $currHorario->nombre." - ".$currHorario->inicioActividad." - ".$currHorario->finActividad;
                    }
                   
                )
            
        ) ?>

    <?=$form->field($model,"id_UserLevel")->dropDownList(
                $items = 
                ArrayHelper::map(
                    UserLevel::find( )->all(),
                    'id',/* closure too */
                    "Nombre"
                    )
                    
        ) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_Datos_Persona')->textInput() ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
