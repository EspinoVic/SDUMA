<?php
/** @var yii\web\View $this */
/** @var common\models\Domicilio2 $domicilioNotif */
/** @var common\models\Domicilio2 $domicilioPredio */
/** @var common\models\Persona $personaSolicita */
/** @var common\models\PersonaMoral $personaMoralSolicita */
/** @var common\models\SolicitudConstruccion $modelSolicitudConstruccion */
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var common\models\Documento $modelEntregables[] */
/** @var common\models\DirectorResponsableObra $modelDRO */
/** @var common\models\Persona $modelPersonaDRO */
/** @var file $licenciaConstruccionAreaPreexistenteFile */
/** @var common\models\Contacto $modelContacto */

/** @var yii\web\View $this */
/** @var yii\web\View $this */

use common\models\GeneroConstruccion;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MotivoConstruccion;
use common\models\SolicitudGenericaCuentaCon;
use common\models\SubGeneroConstruccion;
use common\models\TipoPredio;
use yii\web\JsExpression;
 ?>
<h1>Solicitud Construcción V2</h1>



<?php $form = ActiveForm::begin( [        
        'action' => [ 'site/segunda'],

        /*'id' => 'solicitudConstruccionForm',
        'method' => 'post',
        */'options' => [
          'enctype' => 'multipart/form-data'
            //'class' => 'row g-3',
        ],
    ]); ?>

  <section class="tipoPersona">
    <h5><?= Html::encode('Tipo de persona') ?></h5>       
    
    <input type="radio" class="form-check-input" value="Física" checked onchange="solicitaTipoPersonaChange('F')" name="rbTipoPersonagod" id="idRbPFisica" >Fisica</input>
    <input type="radio" class="form-check-input" value="Moral"   onchange="solicitaTipoPersonaChange('M')" name="rbTipoPersonagod" id="idRbPMoral" >Moral</input>
  </section>

  <br>
  <?= $this->render("_persona",["persona"=>$personaSolicita,"form"=>$form,"idContainer"=>"contTramitaPersonaF"]) ?>
 
  <?= $this->render("_persona_moral",["personaMoral"=>$personaMoralSolicita,"form"=>$form,"idContainer"=>"contTramitaPersonaM"]) ?>
  <br>
 
  <?= $this->render("_contacto",["form"=>$form,"modelContacto"=> $modelContacto])  ?>
  <br>
  
  <script>
 
 
    document.addEventListener("DOMContentLoaded", function(event) {
      solicitaTipoPersonaChange()
    });
    const solicitaTipoPersonaChange = function (whatRender){
      if(whatRender=='M'){
        //hide Fisica
        //Show moral
        document.getElementById("contTramitaPersonaF").style.display = "none";
        document.getElementById("contTramitaPersonaM").style.display = "flex";
      }
      else if(whatRender=='F'){
        //show Fisica
        //hide moral
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }else{//initial
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }
    }
  </script>
  
  <?php  
    echo $this->render('_domicilio_fields', [
            'domicilio' => $domicilioNotif,
            'form' => $form,
            'id' => '0',//index del objeto domicilio
            'tipoDomicilio'=> "Domicilio para notificaciones"
        ]) ?>  

  <br>

    <h5><?= Html::encode('Motivo de Solicitud') ?></h5>       
    <div class="row">

      <?= $form
        ->field($modelSolicitudGenerica, 'id_MotivoConstruccion',['options' => ['class' => 'col-md-4']])
        ->dropDownList(
            $items = 
            ArrayHelper::merge(
              ["-1"=>"Seleccione"],                        
              ArrayHelper::map(
                  MotivoConstruccion::findAll(['isActivo' => 1]),
                  'id' /* closure too */,
                  function ($currentTipoTramite) {
                      return $currentTipoTramite[
                          'nombre'
                      ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                  }
              )
            )
        )
        ->label('Motivo de solicitud') 
        ?>

        <?= $form
              ->field($modelSolicitudGenerica, 'id_SolicitudGenericaCuentaCon',['options' => ['class' => 'col-md-4']])
              ->dropDownList(
                  $items = 
                  ArrayHelper::merge(
                      ["null"=>"Seleccione"],                        
                      ArrayHelper::map(
                          SolicitudGenericaCuentaCon::findAll(['isActivo' => 1]),
                          'id' /* closure too */,
                          function ($currentSolicitudGenericaCuentaCon) {
                              return $currentSolicitudGenericaCuentaCon[
                                  'nombre'
                              ]; /* .'-'.$currentSolicitudGenericaCuentaCon['seconde parameter']; */
                          }
                      )
                    ),
                    ['onchange'=> new JsExpression('cuentaConChange(event)'  )]
              )
              ->label('Cuenta con') 
              ?>

    </div>
  
  <br>
  <?= $this->render("_escritura",['modelEscritura'=>$modelEscritura,'form'=>$form, 'idContainer'=>"contEscrituraFields"])  ?>
  <?= $this->render("_constanciaEscritura",['modelConstanciaEscritura'=>$modelConstanciaEscritura,'form'=>$form, 'idContainer'=>"contConstanciaEscrituraFields"])  ?>
  <?= $this->render("_constanciaPosecionEjidal",['modelConstanciaPosecionEjidal'=>$modelConstanciaPosecionEjidal,'form'=>$form, 'idContainer'=>"contConstanciaPosecionEjidalFields"])  ?>
  <br>

  <script  type="text/javascript">


   /*  document.addEventListener("DOMContentLoaded", function(event) {
      motivoSolicitudChange()
    }); */
    const motivoSolicitudChange = function (event){
      let source = event.target || event.srcElement;
      let whatRender = source.value;
      if(whatRender=='1'){
        //hide Fisica
        //Show moral
        document.getElementById("contTramitaPersonaF").style.display = "none";
        document.getElementById("contTramitaPersonaM").style.display = "flex";
      }
      else if(whatRender=='2'){
        //show Fisica
        //hide moral
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }else{//initial
        document.getElementById("contTramitaPersonaF").style.display = "flex";
        document.getElementById("contTramitaPersonaM").style.display = "none";
      }
    }
    
    const contEscrituraFields = document.getElementById("contEscrituraFields");
    const contConstanciaEscrituraFields = document.getElementById("contConstanciaEscrituraFields");
    const contConstanciaPosecionEjidalFields = document.getElementById("contConstanciaPosecionEjidalFields");


    const cuentaConChange = function (event) {
      

      contEscrituraFields.style.display = "none";
      contConstanciaEscrituraFields.style.display = "none";
      contConstanciaPosecionEjidalFields.style.display = "none";

      let source = event.target || event.srcElement;
      let whatRender = source.value;
      
      switch (whatRender) {
        case "1"://Escritura
          contEscrituraFields.style.display = "flex";

          break;
          case "2": //Constancia Escritura
            contConstanciaEscrituraFields.style.display = "flex";
          break;
          case "3": //Constancia Poseción Ejidal
            contConstanciaPosecionEjidalFields.style.display = "flex";
          break;
        default:
          break;
      }
      
    }
    cuentaConChange();

  </script>

  <?= $this->render("_entregables",["modelEntregables"=>$modelEntregables,"form"=>$form])  ?>
  <br>
  <div class="row g3 border rounded-3  p-3">
    <h4>Información del predio </h4>
    <?= $form
        ->field($modelSolicitudGenerica, 'id_TipoPredio', [
            'options' => ['class' => 'col-md-3'],
        ])
        ->dropDownList(
            $items = ArrayHelper::map(
                TipoPredio::findAll(['isActivo' => 1]),
                'id' /* closure too */,
                function ($currentTipoTramite) {
                    return $currentTipoTramite[
                        'nombre'
                    ]; /* .'-'.$currentTipoTramite['seconde parameter']; */
                }
            )
        )
        ->label('Tipo de predio Dropdown') ?>

    <?= $form->field(
          $model = $modelSolicitudGenerica,
          $attribute = 'superficieTotal',
          ['options' => ['class' => 'col-md-3']]
      ) ?>
  </div>
<br>
  <div class="row g3 border rounded-3  p-3">
    
    <h4>Información de la construcción</h4>
    
    <?= $form
        ->field($modelSolicitudGenerica, 'id_GeneroConstruccion', [
            'options' => ['class' => 'col-md-4'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione género'],
                ArrayHelper::map(
                    GeneroConstruccion::findAll(['isActivo' => 1]),
                    'id',
                    'nombre'
                )
            ),
            ['onchange' => 'this.form.submit()'] //options
        )
        ->label('Genero de Construcción') ?>

    <?= $form
        ->field($modelSolicitudGenerica, 'id_SubGeneroConstruccion', [
            'options' => ['class' => 'col-md-5'],
        ])
        ->dropDownList(
            $items = ArrayHelper::merge(
                ['0' => 'Seleccione subgenero'],
                ArrayHelper::map(
                    SubGeneroConstruccion::findAll([
                        'isActivo' => 1,
                        'id_GeneroConstruccion' =>
                            $modelSolicitudGenerica->id_GeneroConstruccion,
                    ]),
                    'id',
                    function($currSubGenero){
                        return $currSubGenero->nombre." - ".$currSubGenero->nombreTarifa;
                    }
                    
                )
            )
        )
        ->label('Subgenero de Construcción') ?>


      <?= $this->render("_niveles",["form"=>$form,"mecanicaSuelosFile"=>$mecanicaSuelosFile,"modelSolicitudGenerica"=>$modelSolicitudGenerica])  ?>
        
      <?php if($modelSolicitudGenerica->id_GeneroConstruccion == GeneroConstruccion::findOne(["nombre"=>"Muros"])->id):  ?> 
        <?= $this->render("_motivo_muros",['form'=>$form, 'modelSolicitudGenerica'=> $modelSolicitudGenerica])  ?>
      <?php else:  ?> 
        <?= $this->render("_motivo_todos",['form'=>$form,'memoriaCalculoFile'=>$memoriaCalculoFile ,'modelSolicitudGenerica'=> $modelSolicitudGenerica,'licenciaConstruccionAreaPreexistenteFile'=>$licenciaConstruccionAreaPreexistenteFile])  ?>
      <?php endif;  ?> 

    </div>
    <br>
      <?= $this->render('_domicilio_fields', [
            'domicilio' => $domicilioPredio,
            'form' => $form,'id' => '1',//index del objeto domicilio
            'tipoDomicilio'=> "Domicilio de predio"
        ]) ?>  
    <br>
    <?= $this->render("_dro",["form"=>$form,"modelDRO"=>$modelDRO,"modelPersonaDRO"=>$modelPersonaDRO])  ?>

    <br>
      
    <?= $this->render("_apoderados",["form"=>$form,"modelApoderados"=>$modelApoderados])  ?>

<br>
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
 


 