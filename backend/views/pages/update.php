<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Pages */

$this->title = 'Update Laman: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Laman', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
