<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<?php

use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (Yii::$app->params['showTitle']) { ?>
            <?php if (isset($this->blocks['content-header'])) { ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php } else { ?>
                <h1 style="font-family: cursive; color:#023e8a; text-shadow: 1px 1px 1px #0FF29F" class="animate__animated  animate__headShake">
                    <?php
                    if ($this->title !== null) {
                        // echo \yii\helpers\Html::encode($this->title);
                        echo $this->title;
                    } else {
                        echo \yii\helpers\Inflector::camel2words(
                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    } ?>
                </h1>
            <?php } ?>

            <?=
            Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]
            ) ?>
        <?php } ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!-- <b>Version</b> 2.0 -->
    </div>
    <strong>POLITEKNIK NEGERI PADANG &copy; </strong>
    <small>
        All rights reserved.
    </small>
</footer>