<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Profil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profil-form">

    <div class="row">
        <div class="col-md-8 col-sm-12">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'notelp')->textInput(['maxlength' => true]) ?>


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