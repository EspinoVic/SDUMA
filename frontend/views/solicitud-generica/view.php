<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SolicitudGenerica $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Genericas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="solicitud-generica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'statusSolicitud',
            'isSolicitaPersonaFisica',
            'superficieTotal',
            'niveles',
            'superficiePorConstruir',
            'areaPreExistente',
            'tipoTomaAgua',
            'numeroTomaAgua',
            'fechaPagoAguaOContrato',
            'numeroReciboAgua',
            'subeRecibo',
            'numeroPredial',
            'fechaPagoPredial',
            'altura',
            'metrosLineales',
            'id_MetrosLinealesDRO',
            'id_AlturaDRO',
            'id_PersonaFisica',
            'id_PersonaMoral',
            'id_Contacto',
            'id_DomicilioNotificaciones',
            'id_MotivoConstruccion',
            'id_SolicitudGenericaCuentaCon',
            'id_Escritura',
            'id_ConstanciaEscritura',
            'id_ConstanciaPosecionEjidal',
            'id_TipoPredio',
            'id_GeneroConstruccion',
            'id_SubGeneroConstruccion',
            'id_DomicilioPredio',
            'id_DirectorResponsableObra',
            'id_Archivo_MemoriaCalculo',
            'id_Archivo_MecanicaSuelos',
            'id_Archivo_LicenciaConstruccionAreaPreexistenteFile',
            'id_User_CreadoPor',
            'id_User_ModificadoPor',
            'fechaCreacion',
            'fechaModificacion',
        ],
    ]) ?>

</div>
