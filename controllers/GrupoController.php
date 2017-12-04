<?php

namespace app\controllers;

use Yii;
use app\models\Grupo;
use app\models\GrupoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Participante;
use app\models\ParticipanteSearch;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller
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
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupoSearch();
        $searchModel->Estado = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new ParticipanteSearch();
        $searchModel->Estado = 1;
        $searchModel->CodGrupo = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grupo();
        $model->CodGrupo = Yii::$app->db->createCommand('SELECT UUID()')->queryScalar();
        $model->CodBus = '00000000-0000-0000-0000-000000000000';
        $model->Estado = 1;
        $model->LastModified = $this->LastModified();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodGrupo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->LastModified = $this->LastModified();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodGrupo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Grupo model.
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
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupo::findOne($id)) !== null) {
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
