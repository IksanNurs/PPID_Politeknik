<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use common\models\entity\Menu;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Submenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="submenu-form">

    <div class="row">
        <div class="col-md-12 col-sm-12">

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'id_menu')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Menu::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => ''],
                'pluginOptions' => ['allowClear' => true],
            ])->label('Menu Utama'); ?>

            <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sub_url')->textInput(['maxlength' => true]) ?>

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