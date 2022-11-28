<?php

use common\models\Expediente;
use yii\helpers\Html;

/** @var yii\web\View $this  
* @var common\models\SolicitudConstruccion $modelSolicitudConstruccion  
* @var common\models\Contacto $soliContacto  
* @var common\models\Persona $propietarioPersona  
* @var common\models\Domicilio $soliDomicilioNotif  
* @var common\models\Domicilio $soliDomicilioPredio  
* @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments    
 * 
 */
$expenditenOwnerSoli = Expediente::findOne([
    'id' => $modelSolicitudConstruccion->id_Expediente,
]);
$this->title = 'Actualizar Solicitud  de Construcción '/*  . $model->id */;
$this->params['breadcrumbs'][] = ['label' => 'Solicitud  de Construcción', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitud-construccion-update">

    <h1><?= Html::encode($this->title) ?></h1>
 

    <?= $this->render('_form', [
        'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
        'propietarioPersona' => $propietarioPersona,
        'soliDomicilioNotif' => $soliDomicilioNotif,
        'soliDomicilioPredio' => $soliDomicilioPredio,
        'soliContacto' => $soliContacto,
        'soliHasDocuments' => $soliHasDocuments,
        'formAction' => "solicitud-construccion/update?exp=$expenditenOwnerSoli->id",
        'expenditenOwnerSoli' => $expenditenOwnerSoli
    ]) ?>
</div>
