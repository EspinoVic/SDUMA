
<?php

use common\models\Documento;
use common\models\Expediente;
use yii\bootstrap5\Html;
/* @var common\models\SolicitudConstruccionHasDocumento $soliHasDocuments

/* @var common\models\Expediente  $expediente */
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
      
     /*  body{
          background-color: red;
      } */
      
      .recibo-doc{
      
        outline: solid 1px black;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
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

    <button id="print-btn" onclick="window.print();return false; ">
    Imprimir
    </button>

    <table id="tableEntregables" class="table   table-hover">
        <thead>
            <tr>
                <th scope="col"> </th>
                <th scope="col">nombre</th>
                
            

            </tr>
        </thead>
        <tbody>
            <?php foreach ($soliHasDocuments as $id => $soliHasDocument) { ?>
                    <tr <?php echo "id = 'docRow$id' "  ?> >
            <td>
                            <?= Html::checkbox("[$id]id_Documento",$soliHasDocument->isEntregado,
                                [
                                    'options' => ['class' => 'col-md-1', 'display' => 'none'],
                                ]);
                            ?>
                        </td>
                    <td>
                        
                        <?= Html::label(Documento::findOne( ["id"=>$soliHasDocument->id_Documento/* /84 */]) -> nombre ,"[$id]id_Documento")  ?>            
                    </td>

                    </tr>
                <?php } ?>
        </tbody>
    </table>
    
</div>

<script>
   
</script>