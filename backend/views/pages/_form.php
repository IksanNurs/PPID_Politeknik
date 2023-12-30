<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use common\models\entity\Category;
use common\models\entity\User;
use common\models\entity\Files;
use common\models\entity\News;
use mdm\widgets\TabularInput;
use dosamigos\ckeditor\CKEditor;
use kartik\depdrop\DepDrop;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\entity\News */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="news-form">

    <div class="row">
        <div class="col-md-12 col-sm-12">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-warning" style="margin-top:30px">
                        <div class="panel-heading" style="background:#A9E4D7;">
                            Konten
                        </div>
                        <div class="panel-body">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


                            <?= $form->field($model, 'content')->widget(CKEditor::className(),  [
                                'options' => [],
                                'preset' => 'full',
                                'clientOptions' => [
                                    'extraPlugins' => '',
                                    'height' => 500,
                                    'filebrowserUploadUrl' => 'ckeditorupload',
                                    'filebrowserUploadMethod'  => "form",

                                    'toolbarGroups' => [
                                        ['name' => 'undo'],
                                        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                                        ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi']],
                                        ['name' => 'styles'],
                                        ['name' => 'links', 'groups' => ['links', 'insert']]
                                    ]

                                ]

                            ]) ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="panel panel-warning" style="margin-top:30px">
                            <div class="panel-heading" style="background:#A9E4D7;">
                                Status & Visibilitas
                            </div>
                            <div class="panel-body">
                                <?= $form->field($model, 'status')->widget(Select2::classname(), [
                                    'data' => News::statuses(),
                                    'options' => ['placeholder' => '', 'value' => '1',],
                                    'pluginOptions' => ['allowClear' => true],
                                ]); ?>
                                <?= $form->field($model, 'publish_at', [
                                    'inputOptions' =>
                                    [
                                        'value' => date('Y-m-d'),
                                    ],
                                ])->widget(DatePicker::classname(), [
                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                    'readonly' => true,
                                    'disabled' => true,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ],
                                ]); ?>
                                <?= $form->field($model, 'author_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(User::find()->all(), 'id', 'name'),
                                    'options' => ['placeholder' => '', 'value' => Yii::$app->user->identity->id],
                                    'pluginOptions' => ['allowClear' => true],
                                ]); ?>
                            </div>
                        </div>
                        <div class="panel panel-warning" style="margin-top:30px">
                            <div class="panel-heading" style="background:#A9E4D7;">
                                Foto Utama
                            </div>
                            <div class="panel-body">
                                <?= $form->field($model, 'photo')->FileInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-panel">
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <?= Html::submitButton('<i class="fa fa-plane-paper"></i> Terbitkan', ['class' => 'btn btn-primary']) ?>
                        <?= Html::submitButton('<i class="fa fa-file-o"></i> Arsipkan', ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>