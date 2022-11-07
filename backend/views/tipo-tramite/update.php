<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoTramite $model */

$this->title = 'Update Tipo Tramite: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Tramites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-tramite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
