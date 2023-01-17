<?php

use common\models\ConfigTramiteMotivoCuentaconDoc;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\ConfigTramiteMotivoCuentaconDocSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Config Tramite Motivo Cuentacon Docs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-tramite-motivo-cuentacon-doc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Config Tramite Motivo Cuentacon Doc', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_TipoTramite',
            'id_MotivoConstruccion',
            'id_SolicitudGenericaCuentaCon',
            'id_Documento',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ConfigTramiteMotivoCuentaconDoc $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite]);
                 }
            ],
        ],
    ]); ?>


</div>
