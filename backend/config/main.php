<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'APP-backend',
    'name' => '
    <i class="fa fa-university" aria-hidden="true" style="color:white;"></i><font style="color:white;"> PPID </font><font style="color:#1FBFA2;">PNP</font>',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'id-ID',
    'params' => $params,
    'modules' => [
        'acf' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],

        /* 'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd MMM yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a', 
            ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:U',
            ],
            'displayTimezone' => 'Asia/Jakarta',
            'saveTimezone' => 'UTC',
            'autoWidget' => true,
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], 
                Module::FORMAT_DATETIME => [], 
                Module::FORMAT_TIME => [], 
            ],
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'kartik\widgets\DatePicker', 'type' => 1
                ]
            ]                    
        ], */
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\entity\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'UKW-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'defaultRoles' => ['superuser'],
            // 'cache' => 'cache',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@mdm/admin/views' => '@backend/views/acf',
                ],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'area/*',
            'site/*',
            'gridview/*',
            'datecontrol/*',
            'debug/*',
            'acf/*',
            '*',
        ]
    ],
];
