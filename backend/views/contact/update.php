<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Contact */

$this->title = 'Edit Kontak: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contact-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>