<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\ProfileLaundry */

$this->title = 'Profil';
$this->params['breadcrumbs'][] = ['label' => 'Profile News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-laundry-view">
    <div class="panel panel-body">
        <p>
            <?php if (Yii::$app->user->identity->roles == 'admin') {
                echo Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']);
            } ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'Id',
                'nama',
                'notelp',
                'alamat:ntext',
            ],
        ]) ?>
    </div>
</div>