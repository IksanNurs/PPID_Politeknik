<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <div class="box box-primary form-panel" style="padding:20px; overflow:hidden; background:#1FBFA2; margin:-20px auto;">
        <div class="text-center">
            <h2>
                <b style="font-family: cursive; color:#023e8a; text-shadow: 1px 1px 1px #0FF29F;font-size:50px" class="animate__animated animate__flipInX">PPID PNP</b>
            </h2>
            <p class="text-muted animate__animated animate__bounceInRight" style="font-size:18px;">Please fill out your email. A link to reset password will be sent there.</p>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="row">
            <div class="col-xs-8">
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="col-xs-12">
                <?= Html::a('Kembali ke Login', ['site/login']) ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>