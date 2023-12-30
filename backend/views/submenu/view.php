<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Submenu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submenu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="submenu-view">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> ' . 'Update', ['update', 'id' => $model->id], [
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
                'id_menu:integer',
                'sub_title',
                'sub_url:url',
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'format' => 'html',
                    'headerOptions' => ['class' => 'text-left'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        if ($model->status == '1') {
                            return '<span class="label label-success">Aktif</span>';
                        } else {
                            return '<span class="label label-danger">Non Aktif</span>';
                        }
                    }
                ],
                //'category.name:text:Category',
                // 'created_at:datetime',
                // 'updated_at:datetime',
                // 'createdBy.username:text:Created By',
                // 'updatedBy.username:text:Updated By',
            ],
        ]) ?>
    </div>

</div>