<?php

use common\models\entity\Menu;
use yii\helpers\Url;

$model1 = Menu::find()->all();
?>

<aside class="main-sidebar">

    <section class="sidebar" style="  background-image: radial-gradient(#1FBFA2 1%, #011F26 99%);">

        <!-- Sidebar user panel -->
        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= Url::base() . '/img/user.jpg' ?>" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="font-family:Gemunu Libre, sans-serif; font-size:16px;color:white"><?= Yii::$app->user->identity->name ?></p>

                    <a href=" #" style="color:#9D9D9D"><i class="circle text-success"></i> <?= Yii::$app->user->identity->roles ?></a>
                </div>
            </div>
        <?php } ?>

        <?php if (!Yii::$app->user->isGuest) { ?>
            <?php
            $menuItems = [
                ['label' => '<font color="#9D9D9D"><b>MENU</b></font>', 'encode' => false, 'options' => ['class' => 'header']],

                ['label' => '<font color="white">Dashboard</font>', 'encode' => false, 'icon' => 'dashboard', 'url' => ['/site/index']],
                [
                    'label' => '<font color="white">Pengaturan Web</font>',
                    'icon' => 'gear',
                    'encode' => false,
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                        ['label' => '<font color="white">Kontak</font>', 'encode' => false, 'url' => ['/contact/index']],
                        ['label' => '<font color="white">Profil</font>', 'encode' => false, 'url' => ['/profil/view?id=1']],
                    ],
                ],
                ['label' => '<font color="white">Pengaturan Menu</font>', 'encode' => false, 'url' => ['/menu/index']],

                [
                    'label' => '<font color="white">Manajemen Laman</font>',
                    'icon' => 'clone',
                    'encode' => false,
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                        ['label' => '<font color="white">Laman</font>', 'encode' => false, 'icon' => 'file-o', 'url' => ['/pages/index']],
                        ['label' => '<font color="white">Tambah Laman</font>', 'encode' => false, 'icon' => 'plus', 'url' => ['/pages/create']],
                    ],
                ],
                [
                    'label' => '<font color="white">Manajemen Artikel</font>',
                    'icon' => 'folder',
                    'encode' => false,
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                        ['label' => '<font color="white">Kategori</font>', 'encode' => false, 'icon' => 'list', 'url' => ['/category/index']],
                        ['label' => '<font color="white">Artike</font>', 'encode' => false, 'icon' => 'newspaper-o', 'url' => ['/news/index']],
                        ['label' => '<font color="white">Tambah Artikel</font>', 'encode' => false, 'icon' => 'plus', 'url' => ['/news/create']],
                    ],
                ],
                [
                    'label' => '<font color="white">Manajemen Banner</font>',
                    'icon' => 'file-image-o',
                    'encode' => false,
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                        ['label' => '<font color="white">Banner</font>', 'encode' => false,  'url' => ['/banner/index']],
                    ],
                ],
                [
                    'label' => '<font color="white">Manajemen User</font>',
                    'icon' => 'lock',
                    'encode' => false,
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    'visible' => Yii::$app->user->can('Admin'),
                    'items' => [
                        ['label' => '<font color="white">User</font>', 'encode' => false, 'url' => ['/user/index']],
                        //['label' => 'Assignment',   'url' => ['/acf/assignment']],
                        //['label' => 'Role',         'url' => ['/acf/role']],
                        //['label' => 'Permission',   'url' => ['/acf/permission']],
                        //['label' => 'Route',        'url' => ['/acf/route']],
                        //['label' => 'Rule',         'url' => ['/acf/rule']],
                    ],
                ],
                ['label' => 'User', 'icon' => 'user', 'url' => ['/user/index'], 'visible' => Yii::$app->user->can('superuser')],
                ['label' => 'Log', 'icon' => 'clock-o', 'url' => ['/log/index'], 'visible' => Yii::$app->user->can('superuser')],
            ];

            // $menuItems = mdm\admin\components\Helper::filter($menuItems);
            ?><br />
        <?php } else { ?>
            <?php
            $menuItems = [
                ['label' => '<b>MENU</b>', 'encode' => false, 'options' => ['class' => 'header']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Lupa Password', 'url' => ['site/request-password-reset'], 'visible' => Yii::$app->user->isGuest],
            ];
            ?>
        <?php } ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $menuItems,

            ]
        ) ?>

        <!-- <ul class="sidebar-menu"><li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" data-method="post"><i class="sign-out"></i>  <span>Logout</span></a></li></ul> -->

    </section>

</aside>