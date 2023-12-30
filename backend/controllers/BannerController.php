<?php

namespace backend\controllers;

use Yii;
use common\models\entity\Banner;
use common\models\search\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        if ($model->load(Yii::$app->request->post())) {
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
            if (!$model->save()) Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
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
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } catch (IntegrityException $e) {
            throw new \yii\web\HttpException(500, "Integrity Constraint Violation. This data can not be deleted due to the relation.", 405);
        }
    }
    public function actionFileBanner($id, $field = 'photo')
    {
        if ($model = Banner::findOne($id))
            downloadFile($model, $field, $model->photo);
        else
            echo "file tidak ditemukan";
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
