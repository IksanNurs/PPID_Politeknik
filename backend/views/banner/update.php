<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Banner */

$this->title = 'Edit Banner: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banner', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>