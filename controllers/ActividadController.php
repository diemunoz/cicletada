<?php

namespace app\controllers;

use Yii;
use app\models\Actividad;
use app\models\ActividadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadController implements the CRUD actions for Actividad model.
 */
class ActividadController extends Controller
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
     * Lists all Actividad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadSearch();
        $searchModel->Estado = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actividad model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Actividad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Actividad();
        $model->CodActividad = Yii::$app->db->createCommand('SELECT UUID()')->queryScalar();
        $model->Estado = 1;
        $model->LastModified = $this->LastModified();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodActividad]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Actividad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->LastModified = $this->LastModified();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodActividad]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Actividad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->Estado = 2;
        $model->LastModified = $this->LastModified();
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Actividad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Actividad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actividad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function LastModified(){
        list($Mili, $bot) = explode(" ", microtime());
        $DM=substr(strval($Mili),2,4);
        return strval(date("Y").date("m").date("d").date("H").date("i").date("s") . $DM);
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && Yii::$app->controller->action->id != 'login') {
            return $this->redirect(\Yii::$app->urlManager->createUrl("site/login"));
        }else{
            //something code right here if user valid
            return true;
        }
    }
}
