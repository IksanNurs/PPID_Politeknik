<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Contact */

$this->title = 'Tambah Kontak';
$this->params['breadcrumbs'][] = ['label' => 'Contact', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>