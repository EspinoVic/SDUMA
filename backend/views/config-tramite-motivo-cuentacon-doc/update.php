<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */

$this->title = 'Update Config Tramite Motivo Cuentacon Doc: ' . $model->id_Documento;
$this->params['breadcrumbs'][] = ['label' => 'Config Tramite Motivo Cuentacon Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_Documento, 'url' => ['view', 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="config-tramite-motivo-cuentacon-doc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
