<?php 
/** @var common\models\Domicilio $domicilio */
/** @var  $form */


?>

<div class ="row g3">
    
    <?= $form->field($domicilio, 'calle',['options' => ['class' => 'col-md-6']])->textInput() ?>
    
    <?= $form->field($domicilio, 'coloniaFraccBarrio',['options' => ['class' => 'col-md-6']])->textInput() ?>
    
    <?= $form->field($domicilio, 'numExt',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, 'numInt',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, 'cp',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, 'entreCallesH', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($domicilio, 'entreCallesV', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

</div>

 
 