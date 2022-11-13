<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccion $model */

$this->title = 'Create Solicitud Construccion';
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
    ]) ?>

</div>
