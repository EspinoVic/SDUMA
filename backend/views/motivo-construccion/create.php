<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MotivoConstruccion $model */

$this->title = 'Create Motivo Construccion';
$this->params['breadcrumbs'][] = ['label' => 'Motivo Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motivo-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
