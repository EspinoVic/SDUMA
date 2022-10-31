<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User2 $model */

$this->title = 'Create User2';
$this->params['breadcrumbs'][] = ['label' => 'User2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
