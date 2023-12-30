<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kontak';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-index">

    <?php
    $exportColumns = [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        'id',
        'contact_name',
        'description',
        'created_at:datetime',
        'updated_at:datetime',
        'createdBy.username:text:Created By',
        'updatedBy.username:text:Updated By',
    ];

    $exportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $exportColumns,
        'filename' => 'Contact',
        'fontAwesome' => true,
        'dropdownOptions' => [
            'label' => 'Export',
            'class' => 'btn btn-default'
        ],
        'target' => ExportMenu::TARGET_SELF,
        'exportConfig' => [
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_EXCEL => false,
            ExportMenu::FORMAT_HTML => false,
        ],
        'styleOptions' => [
            ExportMenu::FORMAT_EXCEL_X => [
                'font' => [
                    'color' => ['argb' => '00000000'],
                ],
                'fill' => [
                    // 'type' => PHPExcel_Style_Fill::FILL_NONE,
                    'color' => ['argb' => 'DDDDDDDD'],
                ],
            ],
        ],
        'pjaxContainerId' => 'grid',
    ]);
    $gridColumns = [
        [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['class' => 'text-right serial-column'],
            'contentOptions' => ['class' => 'text-right serial-column'],
        ],
        // 'id',
        'contact_name',
        [
            'attribute' => 'description',
            'format' => 'ntext',
            'contentOptions' => ['class' => 'text-wrap'],
        ],
        [
            'contentOptions' => ['class' => 'action-column nowrap text-left'],
            'header' => 'Action',
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url) {
                    return Html::a('', $url, ['class' => 'glyphicon glyphicon-eye-open btn btn-xs btn-default btn-text-info']);
                },
                'update' => function ($url) {
                    return Html::button('', [
                        'class' => 'glyphicon glyphicon-pencil btn btn-xs btn-default btn-text-warning showModalButton',
                        'value' => $url,
                        'title' => 'Edit Kontak'
                    ]);
                },
                'delete' => function ($url) {
                    return Html::a('', $url, [
                        'class' => 'glyphicon glyphicon-trash btn btn-xs btn-default btn-text-danger',
                        'data-method' => 'post',
                        'data-confirm' => 'Apakah Anda yakin ingin menghapus data ini?'
                    ]);
                },
            ],
        ],
        [
            'class' => 'kartik\grid\CheckboxColumn',
            'header' => Html::a('', Url::to(['delete']), ['data-method' => 'POST', 'data-pjax' => '1', 'data-confirm' => 'Apakah Anda yakin menghapus data ini?', 'class' => 'btn btn-xs btn-danger']),
            'name' => 'pilihHapus',
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['checked' => false];
            }

        ],

        // 'created_at:integer',
        // 'updated_at:integer',
        // 'created_by:integer',
        // 'updated_by:integer',
    ];
    ?>
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'pjax' => true,
        'hover' => true,
        'striped' => false,
        'bordered' => false,
        'toolbar' => [
            Html::button('<i class="fa fa-plus"></i> ' . 'Tambah', [
                'class' => 'btn btn-success showModalButton',
                'value' => 'create',
                'title' => 'Tambah Kontak'
            ]), Html::a('<i class="fa fa-repeat"></i> ' . 'Reload', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default']),
            '{toggleData}',
            // $exportMenu

        ],
        'panel' => [
            'type' => 'no-border transparent',
            'heading' => false,
            'before' => '{summary}',
            'after' => false,
        ],

        'panelBeforeTemplate' => '
            <div class="row">
                <div class="col-sm-8">
                    <div class="btn-toolbar kv-grid-toolbar" role="toolbar">
                        {toolbar}
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="pull-right">
                        {before}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        ',
        'pjaxSettings' => ['options' => ['id' => 'grid']],
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]);
    ActiveForm::end();
    ?>
</div>