<?php
/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
 
/** @var common\models\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $nombre */
/** @var string $apellidoP */
/** @var string $apellidoM */
use common\models\Expediente;
use common\models\WidgetStyleVic;
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

<div class="modal fade  " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Label">Filtrar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <?php  echo $this->render('_search', ['model' => $searchModel,'nombre'=> $nombre, 'apellidoP'=>$apellidoP,'apellidoM'=>$apellidoM]); ?>
      </div>       
    </div>
  </div>
</div>

<!-- <p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p> -->

<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Create Expediente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Nuevo Expediente
    </button>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Filtrar</button>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       /*  'filterModel' => $searchModel, */
        'pager' => WidgetStyleVic::PagerStyle(),

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
              'label' => "Expediente #",
              'attribute' => 'tipoTramite.nombre',
              'value' => function($currExpediente){
                return $currExpediente->idAnual . "/".$currExpediente->anio;
              }
            ],
           // 'idAnual',
            //'anio',
            /* 'fechaCreacion:datetime',
            'fechaModificacion:datetime', */
            ['label'=>'Fecha creación',
                'value' => function($currExpediente){                    
                   return date("d/M/Y h:i a",  strtotime( $currExpediente->fechaCreacion)   );  
                }  
            ],
            /* ['label'=>'Fecha modificación',
                'value' => function($currExpediente){                    
                   return date("d/M/Y h:i a",  strtotime( $currExpediente->fechaModificacion)   );  
                }  
            ], */
            //'id_Persona_Solicita',
            //'id_User_CreadoPor',
            //'id_User_modificadoPor',Expediente
           // 'id_TipoTramite',
            [
              'label' => "Nombre",
              'attribute' => 'personaSolicita.nombre',
            ],
            [
              'label' => "Apellido Paterno",
              'attribute' => 'personaSolicita.apellidoP',
            ],
            [
              'label' => "Apellido Materno",
              'attribute' => 'personaSolicita.apellidoM',
            ],
            'estado',
            [
              'label' => "Tipo Trámite",
              'attribute' => 'tipoTramite.nombre',
              'value' => function($currExpediente){
                return $currExpediente->tipoTramite->nombre;
              }
            ],
            [

                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Expediente $model, $key, $index, $column) {
                    //return Url::toRoute([$action, 'id' => $model->id]);
                    if ($action == "update") {
                        /* index decidirá si debe redireccionar a create o update */
                      return Url::to(['solicitud-construccion/index', 'exp' => $key]);

                    }
                    return Url::to([$action, 'id' => $key]);

                 }
            ],
        ],
    ]); ?>


</div>