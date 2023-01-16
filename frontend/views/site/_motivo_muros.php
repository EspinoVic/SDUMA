<?php 
/** @var common\models\SolicitudGenerica[] $modelSolicitudGenerica */
/** @var  $form */
use yii\bootstrap5\Html;
use common\models\Documento;
?>


<div class="row g3 px-3 pt-3">

    <h6><?= Html::encode('Muros') ?></h6>       
    <?= $form
    ->field($modelSolicitudGenerica, 'altura',['options' => ['class' => 'col-md-5']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" , "min"=>"0",'onchange'=> 'alturaChange(event)']) 
    ?>
    <!-- SI es mayor a 2.5, desbloquear FIRMA DRO-->

    <?= $form
    ->field($modelSolicitudGenerica, 'firmaAlturaDRO',['options' => ['class' => 'col-md-5',"id"=>"inputTxtfirmaAlturaDRO","style"=>"display:none"]])
    ->textInput() 
    ?>
</div>

<div class="row g3 px-3 pb-3">


    <?= $form
    ->field($modelSolicitudGenerica, 'metrosLineales',['options' => ['class' => 'col-md-5']])
    ->textInput(['maxlength' => true, "type"=>"number", "step"=>"0.01" ,"min"=>"0",'onchange'=> 'metrosLinealesChange(event)']) 
    ?>

    <?= $form
    ->field($modelSolicitudGenerica, 'firmaMetrosLinealesDRO',['options' => ['class' => 'col-md-5',"id"=>"inputTxtfirmaMetrosLinealesDRO","style"=>"display:none"]])
    ->textInput() 
    ?>
    <!-- SI es mayor 30 metros lineales, desbloquear FIRMA DRO-->

</div>


<script>	

    const firmaAlturaDRO = document.getElementById("inputTxtfirmaAlturaDRO");
    const inputTxtfirmaMetrosLinealesDRO = document.getElementById("inputTxtfirmaMetrosLinealesDRO");


    const alturaChange = function(event){
        //desbloquea FIRMA DRO
        let source = event.target || event.srcElement;
        let alturaInput = source.value;
        
        if(alturaInput >= 2.5){
            firmaAlturaDRO.style.display = "block";
        }
        else{
            firmaAlturaDRO.style.display = "none";
            
        }
    }
    const metrosLinealesChange = function(event){
        //desbloquea FIRMA DRO
        let source = event.target || event.srcElement;
        let metrosLinealesInput = source.value;

        if(metrosLinealesInput > 30){
            inputTxtfirmaMetrosLinealesDRO.style.display = "block";
        }
        else{
            inputTxtfirmaMetrosLinealesDRO.style.display = "none";
            
        }
    }

</script>