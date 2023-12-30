<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\News */

$this->title = 'Edit Berita: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>