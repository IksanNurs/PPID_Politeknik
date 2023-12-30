<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
Yii::$app->params['showTitle'] = false;
?>
<div class="login-box">

    <div class="box box-primary form-panel" style="padding:20px; overflow:hidden; background:#1FBFA2; margin:-20px auto;">
        <div class="text-center">
            <h2>
                <b style="font-family: cursive; color:#023e8a; text-shadow: 1px 1px 1px #0FF29F;font-size:50px" class="animate__animated animate__flipInX">PPID PNP</b>
            </h2>
            <p class="text-muted animate__animated animate__bounceInRight" style="font-size:18px;">Sign in to start your session</p>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="row">
            <div class="col-xs-8">
                <?php // echo $form->field($model, 'rememberMe')->checkbox() 
                ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <div class="col-xs-12">
                <div class="text" style="margin-right:20px"><?= Html::a('Forgot Password', ['site/request-password-reset']) ?></div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>