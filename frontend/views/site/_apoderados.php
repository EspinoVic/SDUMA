<?php 
/** @var common\models\Persona $modelApoderados[] */

/** @var  $form */
/* @var $id */

use yii\bootstrap5\Html;
?>

<div class="apoderados-fields row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Apoderados',) ?></h5> 
    <div>
        <?= Html::label("Cantidad de Apoderados","noApoderados",["class"=>"form-label"])  ?>
        <?= Html::input("number","noApoderados",count($modelApoderados), ['class' => 'col-md-1 form-control',"step"=>"1","min" => 1,"onchange"=>"this.form.submit()"])  ?>
    </div>
    <br>
    <br>
    <?php foreach ($modelApoderados as $id => $currApoderado) { ?>
        <h6>Apoderado <?= Html::encode($id)  ?></h6>
        <?= $form->field($currApoderado, "[apoderado$id]nombre",['options' => ['class' => 'col-md-4']])?>
        <?= $form->field($currApoderado, "[apoderado$id]apellidoP",['options' => ['class' => 'col-md-4']])?>
        <?= $form->field($currApoderado, "[apoderado$id]apellidoM",['options' => ['class' => 'col-md-4']])?>
        <br>
    <?php }  ?> 
    

</div>