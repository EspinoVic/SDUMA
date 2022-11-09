<?php

use common\models\TipoTramite;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */
/** @var ActiveForm $form */
?>
<div class="expedientes-crear">

    <?php $form = ActiveForm::begin(); ?>

        <?= Html::label(
                $content = 'Tipo de trámite',
                $for = 'selectTipoTramite',
                $options = [
                    'class' => 'form-label',
                ]
            ) ?>            
        <?= Html::dropDownList(
            'selectTipoTramite', //name
            $selection = null, //select
            $items = 
            ArrayHelper::map(
                TipoTramite::findAll(['isActivo'=> 1]),
                'id',/* closure too */
                function($model) {
                    return $model['nombre'];/* .'-'.$model['seconde parameter']; */
                }
            )
            
            ,
            /* [
                '0' => 'Selecciona tramite',
                '2' => 'Licencia',
                '3' => 'Registro',
                '4' => 'Regularización',
                '5' => 'Rectificación',
                '1' => 'Otro',
            ], */ //items
            $options = [
                'id' => 'selectTipoTramite',
                /* 'onchange' => 'selecOther()', */
                'class' => 'form-select',
            ] //options
        ) ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- expedientes-crear -->
