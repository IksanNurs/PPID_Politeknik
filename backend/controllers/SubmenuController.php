<?php

namespace backend\controllers;

use Yii;
use common\models\entity\Submenu;
use common\models\search\SubmenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;

/**
 * SubmenuController implements the CRUD actions for Submenu model.
 */
class SubmenuController extends Controller
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
     * Lists all Submenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubmenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Submenu model.
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
     * Creates a new Submenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Submenu();

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Submenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Submenu model.
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

    /**
     * Finds the Submenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Submenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Submenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
