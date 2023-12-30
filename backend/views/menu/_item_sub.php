<?php

use common\models\entity\Item;
use common\models\entity\Files;
use common\models\entity\News;
use common\models\entity\Person;
use common\models\entity\User;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::activeHiddenInput($model, "[$key]id") ?>

<td style="width:100%"><?= $form->field($model, "[$key]news_id")->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(News::find()->all(), 'id', 'title'),
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => ['allowClear' => true],
                        ])->label(false); ?></td>
<td style="vertical-align: center;"><a data-action="delete" class="btn btn-outline-danger btn-icon btn-circle"><i class="fa fa-minus"></i></a></td>