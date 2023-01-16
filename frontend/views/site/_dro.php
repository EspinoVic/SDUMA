<?php 
/** @var common\models\DirectorResponsableObra $modelDRO */
/** @var common\models\Persona $modelPersonaDRO */
/** @var  $form */



use yii\bootstrap5\Html;
?>

<div class="persona-fisica row g3  border rounded-3  p-3 ">
    <h5><?= Html::encode('Director Responsable de Obra') ?></h5>       
    <?= $form->field($modelPersonaDRO, '[DRO]nombre',['options' => ['class' => 'col-md-8']])?>
    <?= $form->field($modelPersonaDRO, '[DRO]apellidoP',['options' => ['class' => 'col-md-5']])?>
    <?= $form->field($modelPersonaDRO, '[DRO]apellidoM',['options' => ['class' => 'col-md-5']])?>
    
    <?= $form
        ->field($modelDRO, 'cedula',['options' => ['class' => 'col-md-5']])
        ->label("Registro")
    ?>

</div>