<?php

use common\models\entity\Banner;
use common\models\entity\Category;
use common\models\entity\Contact;
use common\models\entity\Log;
use common\models\entity\Menu;
use common\models\entity\User;
use common\models\entity\News;
use common\models\entity\Submenu;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'PPID Politeknik Negeri Padang';
// $this->title = Yii::$app->name;
// Yii::$app->params['showTitle'] = false;
?>

<div class="row">
    <div class="alert alert-info text-right">
        Tanggal : <?= date('d M Y') ?>
    </div>

    <div class="col-md-6">
        <div class="panel panel-warning panel-body" style="color:#34401A;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-user fa-3x"></span>
            </div>
            <div class="col-md-8 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= User::find()->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">User</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-warning panel-body" style="color:#252617;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-newspaper-o fa-3x"></span>
            </div>
            <div class="col-md-8 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= News::find()->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">Berita</span>
            </div>
        </div>
    </div>

</div>

<div class="row" style="margin-top:10px;">
    <div class=" col-md-1"></div>
    <div class="col-md-2">
        <div class="panel panel-warning panel-body" style="color:#A3BF3B;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-bars fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= Category::find()->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">Kategori</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-info panel-body" style="color:#7F8C16;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-cloud-upload fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= News::find()->where(['status' => 1])->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">Publish</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-danger panel-body" style="color:#64732F;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-ban fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= News::find()->where(['status' => 2])->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;"> Banned</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-danger panel-body" style="color:#B4BF5E;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-folder-open-o fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= News::find()->where(['status' => 0])->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">Draft</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-warning panel-body" style="color:#A3BF3B;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-file-image-o fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= Banner::find()->count() ?></span>
                <span style="font-size:10pt;font-weight:bold;">Banner</span>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row" style="margin-top:5px;">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="panel panel-danger panel-body" style="color:#59341E;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa fa-address-book-o fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= Contact::find()->count() ?></span><br>
                <span style="font-size:10pt;font-weight:bold;">Kontak</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-2">
        <div class="panel panel-danger panel-body" style="color:#A68160;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa  fa-caret-square-o-right fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"><?= Menu::find()->count() ?></span><br>
                <span style="font-size:10pt;font-weight:bold;">Menu</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-danger panel-body" style="color:#A68160;background:rgb(38, 92, 140,0.1);">
            <div class="col-md-3">
                <span class="fa  fa-caret-square-o-down fa-3x"></span>
            </div>
            <div class="col-md-9 text-right">
                <span style="font-size:25pt;font-weight:bold;"></span><br>
                <span style="font-size:10pt;font-weight:bold;">SubMenu</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>