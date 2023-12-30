<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Subcategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subcategory', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="subcategory-view">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> '. 'Update', ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ' . 'Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="detail-view-container">
        <?= DetailView::widget([
            'options' => ['class' => 'table detail-view'],
            'model' => $model,
            'attributes' => [
                // 'id',
                'name',
                'category.name:text:Category',
                // 'created_at:datetime',
                // 'createdBy.username:text:Created By',
                // 'updated_at:datetime',
                // 'updatedBy.username:text:Updated By',
            ],
        ]) ?>
    </div>
    
</div>
