<?php 
/** @var common\models\Documentos[] $modelEntregables */
/** @var  $form */
/* @var $id */
use yii\bootstrap5\Html;
use common\models\Documento;
?>

<?php if($modelEntregables):  ?> 
    <table id="tableEntregables" class="table table-hover  ">
        <thead>
            <tr>                                   
                <th scope="col">Entregable</th>
                <th scope="col">Subir Archivo</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($modelEntregables as $id => $currEntregable) { ?>
                <tr <?php echo "id = 'docRow$id' "  ?> >                                     

                    <td>                        
                        <?= $form
                            ->field($currEntregable->documento, "[$id]id", [
                                'options' => ['class' => 'col-md-1', 'display' => 'none'],
                            ])
                            ->hiddenInput()/* textInput() */
                            ->label(false) 
                        ?>    
                        <?= 
                            Html::label($currEntregable->documento->nombre)
                        ?>     
                                 
                    </td>
                    <td>
                        <input class="form-control form-control-sm  " id="" type="file">
                    </td>
                </tr>
            <?php } ?>


        
        </tbody>
    </table>

<?php else:?>
    <div class="row g3 border rounded-3  p-3">

        <h5>Elija una motivo de solicitud y el documento con el que cuenta, para poder subir la documentación necesaria.</h5>
    </div>

<?php endif;  ?> 
