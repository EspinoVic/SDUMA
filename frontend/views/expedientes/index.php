<?php
/** @var yii\web\View $this */
/** @var common\models\NuevoExpedienteForm $modelNuevoExp */
?>
 


<h1 class="title">Expedientes</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Nuevo Expediente
</button>
<button type="button" class="btn btn-secondary">Filtrar</button>


<div class="modal fade  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Expediente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= $this->render("crear",['modelNuevoExp'=>$modelNuevoExp]) ?>

      </div>
       
    </div>
  </div>
</div>


<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
