<?php

use common\models\entity\Item;
use common\models\entity\Files;
use common\models\entity\Person;
use common\models\entity\User;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<td style="vertical-align: top;">

    <?= Html::activeHiddenInput($model, "[$key]id") ?>

    <b><span id="no<?= $key ?>"></span></b>
<td><?= $form->field($model, "[$key]file_news")->textInput(['maxlength' => true])->label(false); ?></td>
<td><?= $form->field($model, "[$key]page")->textInput(['maxlength' => true])->label(false); ?></td>

</td>
<td style="vertical-align: center;"><a data-action="delete" class="btn btn-outline-danger btn-icon btn-circle"><i class="fa fa-minus"></i></a></td>


<?php

$js = <<<JAVASCRIPT
    var no = $key;
    if(no > 1)
    $('#triallecturer-'+$key+'-position').val(no);
    else
    $('#triallecturer-'+$key+'-position').val(no+1);
    console.log(1);
    $('#no{$key}').html(no + 1)
JAVASCRIPT;

$this->registerJs($js, \yii\web\View::POS_END);
?>