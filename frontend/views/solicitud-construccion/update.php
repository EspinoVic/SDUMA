<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SolicitudConstruccion $modelSolicitudConstruccion */

$this->title = 'Actualizar Solicitud Construccion, expediente. ' . $modelSolicitudConstruccion->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelSolicitudConstruccion->id, 'url' => ['view', 'id' => $modelSolicitudConstruccion->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?= Html::encode( 'Expediente: '. $modelSolicitudConstruccion->expediente->idAnual . '/' .$modelSolicitudConstruccion->expediente->anio) ?></h2>

    <?= $this->render('_form', [
        'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
    ]) ?>

</div>
