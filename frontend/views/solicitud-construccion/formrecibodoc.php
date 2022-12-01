
<?php

use common\models\Documento;
use common\models\Expediente;
use yii\bootstrap5\Html;
/* @var common\models\Expediente  $expediente */
/* @var common\models\SolicitudConstruccion $solicitudConstruccion*/
/* @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments
?>
<?php  
  /* $baseUrl = Yii::$app ->baseUrl; 
  $cs = Yii::$app->getClientScript();
  //$cs->registerScriptFile($baseUrl.'/js/yourscript.js');
  $cs->registerCssFile($baseUrl.'/css/printStyle.css'); */
/*     $assets = '../css';

    $baseUrl = Yii::$app ->assetManager->publish($assets); */
/*     ob_start();
    var_dump($baseUrl);
    Yii::debug(ob_get_clean(),"set css"); */
    // $this->registerCss("uwu",["href"=>$assets . '/printStyle.css']);
    //$this->registerLinkTag(["href"=> $assets . '/printStyle.css',"rel"=>"stylesheet"])
    $this->registerCss("
    
@page
{
  size:A4;
  margin: 0;
  
}
/* @media print{ */
    html,body  {
        width: 210mm;
        height: 297mm;
        max-width: 210mm;
        max-height: 297mm;
         
      }
      #print-btn
      { 
         /*  background-color: red; */
        /* display: none;
        visibility: none; */
      }
      
    
    .recibo-doc{

        outline: solid 1px black;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
    }
    
    .recibo-doc > .recibo-doc__title{
    
    }
    
    .recibo-doc > .entregables{
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        /* justify-content: space-evenly; */
    }

/* } */
    ");

  /*  Html::tag('link', '', $options); */
   // Yii::$app ->clientScript()->registerCssFile(  $baseUrl . '/css/style.css');

?>
<div class="recibo-doc">
    <div class="recibo-doc__title">
        <div>DIRECCIÓN DE DESARROLLO URBANO</div>
        <div>VENTANILLA DE ATENCIÓN AL PÚBLICO (TRÁMITES)</div>
        <div>RECIBO DE DOCUMENTACIÓN</div>
    </div>

    <div>
        <?= 'EXPEDIENTE: ' . $expediente->idAnual . '/' . $expediente->anio ?>
    </div> 

    <div>
        <?= "Fecha de respuesta: "."_______"." / "."________" ?>
    </div>

    <div>
        <?= 
            "RECIBÍ DEL (LA) C. "
            .$expediente->personaSolicita->nombre." "
            .$expediente->personaSolicita->apellidoP." "
            .$expediente->personaSolicita->apellidoM
        ?>
    </div>

    <button id="print-btn" onclick="window.print();return false; ">
    Imprimir
    </button>

    <div>
        DOCUMENTOS ENTREGADOS
    </div>
    <div class="entregables">
        <?php foreach ($soliHasDocuments as $id => $soliHasDocument) { ?>
            <div <?="id = 'entregableElement$id' "  ?> >
                <span>
                    <?= Html::checkbox("[$id]id_Documento",$soliHasDocument->isEntregado,
                        [
                            'options' => ['class' => 'col-md-1', 'display' => 'none'],
                        ]);
                    ?>
                </span>

                <span>                    
                    <?= Html::label(Documento::findOne( ["id"=>$soliHasDocument->id_Documento/* /84 */]) -> nombre ,"[$id]id_Documento")  ?>            
                </span>

            </div>
        <?php } ?>
    </div>

<div>
    URUAPAN, MICH. A <?= date('d');  ?> DE <?= date('F');  ?> DEL <?= date('Y');  ?>
</div>
<div>
    RECIBIÓ: <?= Yii::$app->user->identity->username  ?>
</div>
 
 
    
</div>
 