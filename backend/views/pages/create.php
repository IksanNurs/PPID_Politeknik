<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Pages */

$this->title = 'Tambah Laman';
$this->params['breadcrumbs'][] = ['label' => 'Laman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
