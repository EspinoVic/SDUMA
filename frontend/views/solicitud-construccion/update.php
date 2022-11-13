<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccion $model */

$this->title = 'Update Solicitud Construccion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
