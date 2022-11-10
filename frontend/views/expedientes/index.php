<?php
/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
 
/** @var common\models\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use common\models\Expediente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>
 





<div class="modal fade  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Expediente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= $this->render("crear",['modelNuevoExp'=>$modelNuevoExp]) ?>

      </div>
       
    </div>
  </div>
</div>


<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Create Expediente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Nuevo Expediente
    </button>
    <button type="button" class="btn btn-secondary">Filtrar</button>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'idAnual',
            'anio',
            'fechaCreacion',
            'fechaModificacion',
            //'estado',
            //'id_Persona_Solicita',
            //'id_User_CreadoPor',
            //'id_User_modificadoPor',
            //'id_TipoTramite',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Expediente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>