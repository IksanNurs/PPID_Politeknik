<?php

namespace backend\controllers;

use common\models\entity\News;
use Yii;
use common\models\entity\Pages;
use common\models\search\NewsSearch;
use common\models\search\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch(['type'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new News();
        $model->author_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->publish_at = time();
            $model->type = 1;
            try {
                if ($model->save()) {
                } else {
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
                }
            } catch (\Exception $ecx) {
                Yii::$app->session->addFlash('error', $ecx->getMessage());
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
            try {
                if ($model->save()) {
                } else {
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
                }
            } catch (\Exception $ecx) {
                Yii::$app->session->addFlash('error', $ecx->getMessage());
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

    /**
     * Deletes an existing Pages model.
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

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
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
                $url = Url::base() . "/uploads" . $newImageName;
                $message = "";
                echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'
                    . $funcNum . '", "' . $url . '", "' . $message . '" );</script>';
            }
        }
    }
}
