 
<?php echo yii\bootstrap5\Nav::widget([
 
 'options'=>[
    'class' => ['list-group']
 ],
 'params' => $_GET,
 'items'=>[
     [
       'label'=> 'Motivo Construccion',
       'url' => ['/mymain/MotivoConstrucion'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ],
       /* 'active' => true */
     ],
     [
       'label'=> 'Tipo Predio',
       'url' => ['/mymain/TipoPredio'],
       'linkOptions' =>['class'=> 'list-group-item list-group-item-action' ]

     ]
 ]
])
?>

<!--  -->
<!-- <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    The current link item
  </a>
  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
  <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
</div> -->

 