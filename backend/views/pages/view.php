<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Laman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="news-view">

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
                'title',
                'publish_at:date',
                'author.name:text:Author',
                'content:html',
                [
                    'attribute' => 'photo',
                    'value' => function ($model) {
                        return  $model->photo ? Html::img(Url::toRoute('news/file-news?id=' . $model->id), ['style' => 'width:250px; height:100px']) : Null;
                    },
                    'format' => 'html'
                ],
                //'views:integer',
                'statusHtml:raw:Status',
                // 'created_at:datetime',
                // 'updated_at:datetime',
                // 'createdBy.username:text:Created By',
                // 'updatedBy.username:text:Updated By',
            ],
        ]) ?>
    </div>

</div>