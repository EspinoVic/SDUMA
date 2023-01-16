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
                <th scope="col">Nombre Archivo</th>
                <th scope="col">Acciones Archivo</th>
                <th scope="col"></th> 
            </tr>
        </thead>
        <tbody>

            <?php foreach ($soliHasDocuments as $id => $soliHasDocument) { ?>
                <tr <?php echo "id = 'docRow$id' "  ?> >                                     

                    <td>
                        <?php 
                            /* ob_start();
                            var_dump("Cycle rendering:".$id);
                            var_dump($soliHasDocument);
                            Yii::debug(ob_get_clean(),"FORM RENDER uwu") */
                        ?> 
                        <?= $form
                            ->field($soliHasDocument, "[$id]id_Documento", [
                                'options' => ['class' => 'col-md-1', 'display' => 'none'],
                            ])
                            ->hiddenInput()/* textInput() */
                            ->label(false) 
                        ?>
                        <?php echo $form
                            ->field($soliHasDocument, "[$id]isEntregado")
                            ->checkbox()
                            ->label(/* $soliHasDocument -> documento ->nombre  */Documento::findOne( ["id"=>$soliHasDocument->id_Documento]) -> nombre );
                             ?>
                     <!--    <input type="button" value="Delete Row" onclick="SomeDeleteRowFunction()"> -->
                        
                    </td>
                    <td><!-- border-0 -->
                        <span >
                            <?= $form->field(
                                $soliHasDocument,
                                "[$id]nombreArchivo",
                                
                            ) ->textInput(
                                     ['class' => 'border-0 disabled',
                                      ' readonly' => ""
                                     ]
                                ) -> label(false) ?> 
                       </span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger">Borrar</button>
                    </td>
                    <td>
                        <input class="form-control form-control-sm  " id="formFileSm" type="file">

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
