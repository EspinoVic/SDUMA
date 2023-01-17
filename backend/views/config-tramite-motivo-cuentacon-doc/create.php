<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ConfigTramiteMotivoCuentaconDoc $model */

$this->title = 'Create Config Tramite Motivo Cuentacon Doc';
$this->params['breadcrumbs'][] = ['label' => 'Config Tramite Motivo Cuentacon Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-tramite-motivo-cuentacon-doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
