<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Menu */

$this->title = 'Create Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
