<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MotivoConstruccion $model */

$this->title = 'Update Motivo Construccion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Motivo Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motivo-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
