<?php 

use yii\bootstrap5\Html;
use common\models\Documento;
use yii\helpers\Url;
/** @var yii\web\View $this */

/* 
* $expediente common\models\Expediente
* $solicitudConstruccion common\models\SolicitudConstruccion
* $soliHasDocuments common\models\SolicitudConstruccionHasDocumento  
*/
/** @var common\models\SolicitudGenerica $expedienteAImprimir  */


frontend\assets\AppAsset::register($this);
/* frontend/web/ */
/*  $this->registerCssFile(

   "/assets/2ed5987d/dist/css/bootstrap.min.css"
); */
/* $this->registerCssFile(
    //"/assets/2ed5987d/dist/css/bootstrap.min.css"

   "../../db_setup/bootstrap-5.0.2-dist/css/vic.css"
);
$this->registerJsFile(

   "/../../db_setup/bootstrap-5.0.2-dist/js/bootstrap.min.js"
);
 */
$cs = file_get_contents('../../db_setup/bootstrap-5.0.2-dist/css/bootstrap.min.css');
 $this->registerCss(
    $cs
 );
$this->registerCss('
.vic{

    outline: 8px ridge rgba(170, 50, 220, .6);
    border-radius: 2rem;
}
    @page {
        /* size: 7in 9.25in;
        margin: 0 0 0 0; */
        min-width: 100%;

    }
    h1 {
        color:red;
    }
    @print{
    
        h1 {
            color:red;
        }
    }
        body, main {
            padding: 0;
        }
        body > main {
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            padding: 0;
        }
        nav,.navbar,header, footer{
            display:none;
            visibility: hidden;
            max-heigth: 1px;
            display: block !improtant;
            margin: 0px !important;
            border: 0px !important;
            padding: 0px !important;
        }


        main > .container{
            padding-top:0;
        }

    
    .print-soli-cont{    
            min-width: A4;
    
        font-size: 12pt;
    }
        .title-secretary{
            font-size: 15pt;
        }
        .title-secretary-secondary{
            font-size: 16pt;
        }
    .outlined-box{
        outline: solid 1px black;
    }

    .inverted-colors{
            background-color:gray;
            color:white;
            
        }

        

        
    ');

?> 

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->head() ?>

    <title><?= Html::encode($this->title) ?></title>
    
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<div class="container-xl outlined-box p-2 m-1 vic ">
    <div class="row  ">
    test
    </div>
    <a href="#" class="btn btn-primary ">asdasd</a>
</div>

<h1>asdasdasd</h1>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();