<?php

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

$this->title = 'Create Solicitud Construccion';
$this->params['breadcrumbs'][] = ['label' => 'Solicitud Construccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-construccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelSolicitudConstruccion' => $modelSolicitudConstruccion,
        'propietarioPersona' => $propietarioPersona,
        'soliDomicilioNotif' => $soliDomicilioNotif,
        'soliDomicilioPredio' => $soliDomicilioPredio,
        'soliContacto' => $soliContacto,
        'soliHasDocuments' => $soliHasDocuments,

    ]) ?>

</div>
