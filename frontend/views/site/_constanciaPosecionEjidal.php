<?php 
/** @var common\models\ConstanciaPosecionEjidal $modelConstanciaPosecionEjidal */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div id='<?= $idContainer  ?>' class="constancia-escritura-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Datos de Constancia de Escritura') ?></h5>       
    <?= $form->field($modelConstanciaPosecionEjidal, 'noConstanciaPosEjidal',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelConstanciaPosecionEjidal, 'nombreQuienEmitio',['options' => ['class' => 'col-md-4']])?>
    <?= $form->field($modelConstanciaPosecionEjidal, 'fechaEmision',['options' => ['class' => 'col-md-4']])?>

</div>
