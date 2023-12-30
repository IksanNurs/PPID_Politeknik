    <?php

    use yii\helpers\Html;

    /* @var $this \yii\web\View */
    /* @var $content string */

    \dmstr\web\AdminLteAsset::register($this);
    \backend\assets\AppAsset::register($this);
    // \bedezign\yii2\audit\web\JSLoggingAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>PPID | <?= strip_tags($this->title) ?></title>
        <?php $this->head() ?>
        <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600" rel="stylesheet">
    </head>

    <body class="hold-transition skin-blue layout-top-nav fixed">
        <?php $this->beginBody() ?>
        <div class="wrapper">

            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>

        </div>

        <?php $this->endBody() ?>
    </body>

    </html>
    <?php $this->endPage() ?>