<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Profil */

$this->title = 'Edit Profil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profil', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profil-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>