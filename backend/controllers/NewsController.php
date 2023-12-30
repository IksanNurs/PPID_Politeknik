<?php

namespace backend\controllers;

use Yii;
use common\models\entity\News;
use common\models\entity\Subcategory;
use common\models\entity\TokenFcm;
use common\models\search\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch(['type' => 2]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->author_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->type = 2;
            $model->publish_at = time();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->Files = Yii::$app->request->post('Files', []);
                if ($model->save()) {
                    $tokens = TokenFcm::find()->all();
                    foreach ($tokens as $token) {
                        $model->sendPush($token->token, substr($model->title,0,10), substr($model->content, 0,100), 'https://picsum.photos/id/10/200', 'https://picsum.photos/id/10/200');
                    }
                    $transaction->commit();
                } else {
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
                    $transaction->rollBack();
                }
            } catch (\Exception $ecx) {
                Yii::$app->session->addFlash('error', $ecx->getMessage());
                $transaction->rollBack();
            }

            foreach ($model->uploadableFields() as $field) {
                unset($model->$field);
            }
            if ($model->save()) {
                foreach ($model->uploadableFields() as $field) {
                    $uploadedFile = UploadedFile::getInstance($model, $field);
                    if ($uploadedFile) uploadFile($model, $field, $uploadedFile);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->Files = Yii::$app->request->post('Files', []);
                if ($model->save()) {
                    $transaction->commit();
                } else {
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
                    $transaction->rollBack();
                }
            } catch (\Exception $ecx) {
                Yii::$app->session->addFlash('error', $ecx->getMessage());
                $transaction->rollBack();
            }
            foreach ($model->uploadableFields() as $field) {
                unset($model->$field);
            }
            if ($model->save()) {
                foreach ($model->uploadableFields() as $field) {
                    $uploadedFile = UploadedFile::getInstance($model, $field);
                    if (!empty($uploadedFile)) {
                        uploadFile($model, $field, $uploadedFile);
                    } else {
                        uploadFile1();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionFileNews($id, $field = 'photo')
    {
        if ($model = News::findOne($id))
            downloadFile($model, $field, $model->photo);
        else
            echo "file tidak ditemukan";
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id = '')
    {
        $model = new News();
        try {
            if (Yii::$app->request->isAjax) {
                $data = [];
                if (($row = Yii::$app->request->post('pilihHapus'))) {
                    foreach ($row as $val) {
                        $data[] = $val;
                        $model->findOne($val)
                            ->delete();
                    }
                }
                return $this->redirect(['index']);
            } else {
                $this->findModel($id)->delete();
                return $this->redirect(['index']);
            }
        } catch (IntegrityException $e) {
            throw new \yii\web\HttpException(500, "Integrity Constraint Violation. This data can not be deleted due to the relation.", 405);
        }
    }

    public function actionSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Subcategory::find()->where(['category_id' => $cat_id])->asArray()->all();
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return Json::encode(['output' => $out, 'selected' => '']);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCkeditorupload()
    {
        $funcNum = $_REQUEST['CKEditorFuncNum'];

        if (isset($_FILES['upload']['tmp_name'])) {

            $file = $_FILES['upload']['tmp_name'];
            $fileName = $_FILES['upload']['name'];
            $fileNameArray = explode(".", $fileName);
            $extension = end($fileNameArray);
            $newImageName = rand() . "." . $extension;
            $allowExtention = array("jpg", "jpeg", "png", "JPG", "JPEG", "PNG");
            if (in_array($extension, $allowExtention)) {
                move_uploaded_file($file, "./uploads" . $newImageName);
                $url = Url::base('http') . "/uploads" . $newImageName;
                $message = "";
                echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'
                    . $funcNum . '", "' . $url . '", "' . $message . '" );</script>';
            }
        }
    }
}
