<?php

namespace frontend\controllers;

use common\models\entity\Menu;
use common\models\entity\News;
use common\models\entity\Submenu;
use common\models\entity\TokenFcm;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;

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
                $arrSub = [[
                    'menu' => $submenu->news->title,
                    'news_id' => $submenu->news_id,
                ]];
                $dataSub = array_merge($dataSub, $arrSub);
            }
            $arr = [[
                'menu' => $model->name,
                'title' => $model->news_id ? $model->news->title : '',
                'news_id' => $model->news_id,
                'submenu' => $dataSub
            ]];
            $data = array_merge($arr, $data);
        }

        return json_encode($data);
    }

    public function actionArticles()
    {
        $modelpopular = News::find()->where(['type' => 2, 'status'=>'1'])->orderBy('views ASC')->limit(15)->all();
        $popular = [];
        foreach ($modelpopular as $modelpopular) {
            $diff = time() - $modelpopular->publish_at;
            $jam = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);
            $hari = floor($diff / (60 * 60 * 24));
    
            if ($jam < 24) {
                if ($menit < 60)
                    $publish_at = $menit . ' menit yang lalu';
                else
                    $publish_at = $jam . ' Jam yang lalu';
            } else {
                if ($hari < 5)
                    $publish_at = $hari . ' Hari yang lalu';
                else
                    $publish_at = date('Y-m-d');
            }

            $arr = [[
                'id' => $modelpopular->id,
                'title' => $modelpopular->title,
                'desc' => '',
                'publish_at' => $publish_at,
                'uri' => $modelpopular->photo ? Url::home('http') . Url::to('menu/file-news?id=' . $modelpopular->id) : null
            ]];

            $popular = array_merge($arr, $popular);
        }
        $dataPopular = [['title' => 'Terpopuler', 'horizontal' => true, 'data' => $popular]];

        $modelrecent = News::find()->where(['type' => 2, 'status'=>'1'])->orderBy('id ASC')->limit(15)->all();
        $popular = [];
        foreach ($modelrecent as $modelrecent) {

            $diff = time() - $modelrecent->publish_at;
            $jam = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);
            $hari = floor($diff / (60 * 60 * 24));
    
            if ($jam < 24) {
                if ($menit < 60)
                    $publish_at = $menit . ' menit yang lalu';
                else
                    $publish_at = $jam . ' Jam yang lalu';
            } else {
                if ($hari < 5)
                    $publish_at = $hari . ' Hari yang lalu';
                else
                    $publish_at = date('Y-m-d');
            }

            $arr = [[
                'id' => $modelrecent->id,
                'title' => $modelrecent->title,
                'desc' => $modelrecent->content,
                'publish_at' => $publish_at,
                'uri' => $modelrecent->photo ? Url::home('http') . Url::to('menu/file-news?id=' . $modelrecent->id) : null
            ]];

            $popular = array_merge($arr, $popular);
        }
        $dataRecent = [['title' => 'Recent', 'data' => $popular]];

        $data = array_merge($dataPopular, $dataRecent);

        return json_encode($data);
    }

    public function actionAll(){
        $query = News::find()->where(['type' => 2, 'status'=>'1'])->orderBy('id ASC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 2, //set page size here
            ]
        ]);
        $relationShips = $dataProvider->getModels();
        $data = [];
        foreach ($relationShips as $key) {
            $diff = time() - $key->publish_at;
            $jam = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);
            $hari = floor($diff / (60 * 60 * 24));
    
            if ($jam < 24) {
                if ($menit < 60)
                    $publish_at = $menit . ' menit yang lalu';
                else
                    $publish_at = $jam . ' Jam yang lalu';
            } else {
                if ($hari < 5)
                    $publish_at = $hari . ' Hari yang lalu';
                else
                    $publish_at = date('Y-m-d');
            }
            $arr = [[
                'id' => $key->id,
                'title' => $key->title,
                'author' => $key->author->name,
                'desc' => $key->content,
                'publish_at' => $publish_at,
                // 'category' => $key->category->category_name,
                // 'url_photo' => Url::base(true) . '/file/file-news?id='.$key->id,
                'uri' => $key->photo ? Url::home('http') . Url::to('menu/file-news?id=' . $key->id) : null,
                'views' => $key->views
            ]];
            $data = array_merge($data, $arr);
        }

        $dataRecent = [['title' => 'Semua Berita & Informasi', 'data' => $data,  'total_item' => count($data)]];
        return json_encode($dataRecent);

    }
    
    public function actionDetail($id)
    {
        $model = News::findOne($id);
        $model->views = $model->views + 1;
        $model->save();

        $diff = time() - $model->publish_at;
        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $hari = floor($diff / (60 * 60 * 24));

        if ($jam < 24) {
            if ($menit < 60)
                $publish_at = $menit . ' menit yang lalu';
            else
                $publish_at = $jam . ' Jam yang lalu';
        } else {
            if ($hari < 5)
                $publish_at = $hari . ' Hari yang lalu';
            else
                $publish_at = date('Y-m-d');
        }

        $data = [
            'title' => $model->title,
            'uri' => $model->photo ? Url::home('http') . Url::to('menu/file-news?id=' . $model->id) : null,
            'desc' => $model->content,
            'publish_at' => $publish_at,
            'author' => $model->author->name
        ];

        return json_encode($data);
    }

    public function actionFileNews($id, $field = 'photo')
    {
        if ($model = News::findOne($id))
            downloadFile($model, $field, $model->photo);
        else
            echo "file tidak ditemukan";
    }

    public function actionToken($token)
    {
        $model = TokenFcm::find()->where(['token' => $token])->count();
        if ($model == 0) {
            $model = new TokenFcm();
            $model->token = $token;
            $model->save();
        }
    }
}
