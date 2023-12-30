<?php

use common\models\entity\Subcategory;
use mdm\widgets\TabularInput;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <div class="row">
        <div class="col-md-12 col-sm-12">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'category_name')->textInput(['maxlength' => true])->label('Nama Kategori') ?>

            <table class="table table-condensed table-hover" style="margin-left:-5px;margin-top:-10px;">
                <thead>
                    <tr>
                        <th>Nama SubKategori</th>
                        <th class="text-right"><a id="btn-add" class="btn btn-success"><i class="fa fa-plus"></i></a></th>
                    </tr>
                </thead>

                <?= TabularInput::widget([
                    'id'            => 'detail-grid',
                    'allModels'     => $model->subcategory,
                    'model'         => Subcategory::className(),
                    'tag'           => 'tbody',
                    'form'          => $form,
                    'itemOptions'   => ['tag' => 'tr'],
                    'itemView'      => '_item_subcategory',
                    'clientOptions' => [
                        'btnAddSelector' => '#btn-add',
                    ]
                ]); ?>

            </table>

            <p style="margin-top:-15px;"><?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?></p>

            <?= $form->field($model, 'status')->dropDownList(['' => '--Pilih--', '1' => 'Aktif', '0' => 'Non Aktif']) ?>



            <div class="form-panel">
                <div class="row">
                    <div class="col-sm-12">
                        <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> ' . ($model->isNewRecord ? 'Simpan' : 'Edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>