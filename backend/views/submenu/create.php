<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Submenu */

$this->title = 'Tambah Submenu';
$this->params['breadcrumbs'][] = ['label' => 'Submenu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submenu-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
