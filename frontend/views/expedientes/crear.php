<?php

use common\models\TipoTramite;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
/** @var ActiveForm $form */
?>
<div class="expedientes-crear">

    <?php $form = ActiveForm::begin(
            [
            'action' =>['expedientes/crear'], 
            'id' => 'forum_post', 
            'method' => 'post',
            ]
        ); ?>

        <?=$form->field($modelNuevoExp,"tipoTramiteId")->dropDownList(
                $items = 
                ArrayHelper::map(
                    TipoTramite::findAll(['isActivo'=> 1]),
                    'id',/* closure too */
                    function($currentTipoTramite) {
                        return $currentTipoTramite['nombre'];/* .'-'.$currentTipoTramite['seconde parameter']; */
                    }
                )
            /*    ,$options = [
                'id' => 'uwu',
                //'onchange' => 'selecOther()',
                'class' => 'form-select',
            ]   */
                
        ) ?>
 
        <?=$form->field($modelNuevoExp,"nombre")->textInput() ?>
        <?=$form->field($modelNuevoExp,"apellidoP")->textInput() ?>
        <?=$form->field($modelNuevoExp,"apellidoM")->textInput() ?>
        
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- expedientes-crear -->
