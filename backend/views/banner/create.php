<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Banner */

$this->title = 'Tambah Banner';
$this->params['breadcrumbs'][] = ['label' => 'Banner', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>