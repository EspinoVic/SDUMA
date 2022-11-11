<?php

use common\models\CorrSeguridadEstruc;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CorrSeguridadEstrucSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Corr Seguridad Estrucs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corr-seguridad-estruc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Corr Seguridad Estruc', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'abreviacion',
            'cedula',
            'isActivo',
            //'id_Persona',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CorrSeguridadEstruc $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
