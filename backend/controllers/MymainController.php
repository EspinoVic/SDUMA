<?php

namespace backend\controllers;

class MymainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUwu()
    {
        return $this->render('uwu');
    }

}
