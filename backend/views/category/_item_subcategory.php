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

<?= Html::activeHiddenInput($model, "[$key]id") ?>

<td style="width:100%"><?= $form->field($model, "[$key]name")->textInput(['maxlength' => true])->label(false); ?></td>
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