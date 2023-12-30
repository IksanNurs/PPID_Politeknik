<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Submenu */

$this->title = 'Edit Submenu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submenu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="submenu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>