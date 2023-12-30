<?php

namespace backend\controllers;

use Yii;
use common\models\entity\Category;
use common\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->Subcategory = Yii::$app->request->post('Subcategory', []);
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
            if (!$model->save()) Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($model->errors));
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->Subcategory = Yii::$app->request->post('Subcategory', []);
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
            return $this->redirect(['view', 'id' => $model->id]);
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id = '')
    {
        $model = new Category();
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
