<?php 
/** @var common\models\Domicilio $domicilio */
/** @var  $form */
/* @var $tipoDom */

?>

<div class ="row g3">
    
    <?= $form->field($domicilio, "[$tipoDom]calle",['options' => ['class' => 'col-md-6']])->textInput( /* [ 'name'=>"uwu" ] */) ?>
    
    <?= $form->field($domicilio, "[$tipoDom]coloniaFraccBarrio", ['options' => ['class' => 'col-md-6']])->textInput() ?>
    
    <?= $form->field($domicilio, "[$tipoDom]numExt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$tipoDom]numInt",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$tipoDom]cp",['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$tipoDom]entreCallesH", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($domicilio, "[$tipoDom]entreCallesV", ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

</div>
