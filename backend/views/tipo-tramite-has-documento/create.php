<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoTramiteHasDocumento $model */

$this->title = 'Create Tipo Tramite Has Documento';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Tramite Has Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-tramite-has-documento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
