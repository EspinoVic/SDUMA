<?php

use common\models\SubGeneroConstruccion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SubGeneroConstruccionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sub Genero Construccions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-genero-construccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sub Genero Construccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'udm',
            'tamanioLimiteInferior',
            'tamanioLimiteSuperior',
            //'nombreTarifa',
            //'tarifa',
            //'fechaCreacion',
            //'anioVigencia',
            //'isActivo',
            //'id_GeneroConstruccion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SubGeneroConstruccion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
