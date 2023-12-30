<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Menu */

$this->title = 'Update Menu: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
