<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
backend\assets\AppAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$sidebarCollapse = '';
/* if (($sidebarCollapse_config = \backend\models\Config::findOne(['key' => 'SidebarCollapsed'])) !== null) {
    if ($sidebarCollapse_config->value == 1) $sidebarCollapse = 'sidebar-collapse';
} */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= strip_tags($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400" rel="stylesheet">
</head>

<body class="hold-transition  sidebar-mini fixed <?= $sidebarCollapse ?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php
    yii\bootstrap\Modal::begin([
        'header'        => '<span id="modalHeaderTitle"></span>',
        'headerOptions' => ['id' => 'modalHeader', 'style' => 'background-image: linear-gradient(#1FBFA2 10%, #011F26 100%);color:white;text-align:center;'],
        'id'            => 'modal-universe',
        'size'          => 'modal-md',
        // 'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::getAlias('@web/img/loader.gif') . "'></div></div>";
    yii\bootstrap\Modal::end();
    ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>