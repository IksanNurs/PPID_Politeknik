<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use common\models\entity\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategory';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="subcategory-index">

    <?php
    $exportColumns = [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        'id',
        'name',
        'category.category_name.name:text:Category',
        'created_at:datetime',
        'createdBy.username:text:Created By',
        'updated_at:datetime',
        'updatedBy.username:text:Updated By',
    ];

    $exportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $exportColumns,
        'filename' => 'Subcategory',
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
        'name',
        [
            'attribute' => 'category_id',
            'value' => 'category.category_name',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Category::find()->orderBy('category_name')->asArray()->all(), 'id', 'category_name'),
            'filterInputOptions' => ['placeholder' => ''],
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
        ],
        // 'created_at:integer',
        // 'created_by:integer',
        // 'updated_at:integer',
        // 'updated_by:integer',
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'pjax' => true,
        'hover' => true,
        'striped' => false,
        'bordered' => false,
        'toolbar' => [
            Html::a('<i class="fa fa-angle-double-left"></i> ' . 'Kembali', ['category/index'], ['class' => 'btn btn-primary']),
            Html::a('<i class="fa fa-repeat"></i> ' . 'Reload', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default']),
            '{toggleData}',
            // $exportMenu,
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
    ]); ?>

</div>