<?php
/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
 
/** @var common\models\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $nombre */
/** @var string $apellidoP */
/** @var string $apellidoM */
use common\models\Expediente;
use common\models\UtilVic;
use common\models\WidgetStyleVic;
use LDAP\Result;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample">Filtrar</button>

    <div class="collapse" id="collapseExample">
      <div class="card card-body">

        <?php echo $this->render('_search', ['model' => $searchModel,'nombre'=> $nombre, 'apellidoP'=>$apellidoP,'apellidoM'=>$apellidoM]); ?>

      </div>
    </div>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Nuevo Expediente
    </button> -->
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
            [
              'label' => "Tipo de trámite",               
              'value' => function($currExpediente){
                return $currExpediente->tipoTramite->nombre;
              }
            ],
            [
              'label' => "Solicita",
              'value' => function($currExpediente){
                $solicitaPersonaMoral =  $currExpediente->solicitudGenerica->personaMoral;
                $solicitaPersonaFisica =  $currExpediente->solicitudGenerica->personaFisica;
                $result = "ERROR OBTENIENDO";

                $result = $solicitaPersonaFisica? 
                    $solicitaPersonaFisica->nombre. " ". $solicitaPersonaFisica->apellidoP . " ". $solicitaPersonaFisica->apellidoM
                    :
                    $solicitaPersonaMoral->denominacion. " - ". $solicitaPersonaMoral->rfc 
                    ;

                return  $result;
              }              
            ],

            [
              'label' => "Estado",
              'value' => function($currExpediente){
                
                return Expediente::STATUS_EXPEDIENTE[$currExpediente->estado];
              }
            ],
            [

              'class' => ActionColumn::class,
              'urlCreator' => function ($action, Expediente $model, $key, $index, $column) {

                  if ($action == "view") {
                       //index decidirá si debe redireccionar a create o update 
                    return Url::to(['solicitud-generica/view', 'id' => $model->id]);
                  }

                  return Url::to([$action, 'id' => $key]);

                },
                'visibleButtons'=>[
                  /* 'view'=> function($model){
                      return $model->status!=1; //puede aparecer o no, segun el estado del modelo :0 awesome xd
                  }, */
                  'view' => true,
                  'update' => UtilVic::isEmployee(),
                  'delete' => UtilVic::isEmployee(),
              ]   
            ],
        ],
    ]); ?>


</div>