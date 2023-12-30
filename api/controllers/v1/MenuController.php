<?php

namespace api\controllers\v1;

use common\models\entity\Menu;
use common\models\entity\Submenu;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * LogController implements the CRUD actions for Log model.
 */
class MenuController extends \yii\rest\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Menu::find()->all();
        $data = [];
        foreach ($model as $model) {
            $submenu = Submenu::find()->where(['menu_id' => $model->id])->all();
            $dataSub = [];
            foreach ($submenu as $submenu) {
                $arrSub = [
                    'menu' => $submenu->name,
                    'news_id' => $submenu->news_id,
                ];
            }
            $dataSub = array_merge($dataSub, $arrSub);
            $arr = [
                'menu' => $model->name,
                'news_id' => $model->news_id,
                'submenu' => $arrSub
            ];
        }
        $data = array_merge($data, $dataSub);

        return $data;
    }
}
