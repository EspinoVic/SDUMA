<?php 
/** @var common\models\SolicitudGenerica $modelSolicitudGenerica */
/** @var file $mecanicaSuelosFile */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
?>

<div class="niveles-fields row g3  p-3 ">
        
    <?= $form
        ->field($modelSolicitudGenerica, 'niveles', [
            'options' => 
            [
                'class' => 'col-md-4'        
                ,'onchange'=> 'nivelesChange(event)'
            ]
        ])
        ->textInput(['type' => 'number',"min"=>1]) ?>


    <?= $form
    ->field($mecanicaSuelosFile, '[mecanicaSuelos]myFile',['options' => ['class' => 'col-md-4',"id"=>"inputFilemecanicaSuelos","style"=>"display:none"]])
    ->fileInput([/* 'multiple' => true,  */'accept' => '.pdf,.jpeg,.jpg,.png']) 
    ->label("Mecánica de suelos (subir archivo)")        
    ?>
  
    <script>
        const inputFilemecanicaSuelos = document.getElementById("inputFilemecanicaSuelos");


        const nivelesChange = function(event){
            //desbloquea FIRMA DRO
            let source = event.target || event.srcElement;
            let nivelesInput = source.value;
            
            if(nivelesInput >= 3){
                inputFilemecanicaSuelos.style.display = "block";
            }
            else{
                inputFilemecanicaSuelos.style.display = "none";
                
            }
        }

    </script>
</div>
