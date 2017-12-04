<?php

namespace app\controllers;

use Yii;
use app\models\Registro;
use app\models\RegistroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * RegistroController implements the CRUD actions for Registro model.
 */
class RegistroController extends Controller
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
     * Lists all Registro models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new RegistroSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $totalCount = Yii::$app->db->createCommand("select count(*) from (select C.Nro as Nro,concat(C.Nombres,' ',C.ApellidoPaterno,' ',C.ApellidoMaterno) as NombreCompleto,(select Grupo from TB_Grupo where CodGrupo = C.CodGrupo) as Grupo,B.Actividad,max(A.IDA) as IDA,max(A.REGRESO) as REGRESO
        from (select CodParticipante,
                        CodActividad,
                        case TipoRegistro when 1 then Fecha else '-' end as IDA,
                        case TipoRegistro when 2 then Fecha else '-' end REGRESO 
                        from TB_Registro 
                        where Estado=1 
                        group by CodActividad,CodParticipante,TipoRegistro) as A 
        left join TB_Actividad B on B.CodActividad=A.CodActividad 
        left join TB_Participante C on C.Nro=A.CodParticipante
        group by A.CodActividad,A.CodParticipante
        order by Grupo)")->queryScalar();
        
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "select C.Nro as Nro,concat(C.Nombres,' ',C.ApellidoPaterno,' ',C.ApellidoMaterno) as NombreCompleto,(select Grupo from TB_Grupo where CodGrupo = C.CodGrupo) as Grupo,B.Actividad,max(A.IDA) as IDA,max(A.REGRESO) as REGRESO
                        from (select CodParticipante,
                                        CodActividad,
                                        case TipoRegistro when 1 then Fecha else '-' end as IDA,
                                        case TipoRegistro when 2 then Fecha else '-' end REGRESO 
                                        from TB_Registro 
                                        where Estado=1 
                                        group by CodActividad,CodParticipante,TipoRegistro) as A 
                        left join TB_Actividad B on B.CodActividad=A.CodActividad 
                        left join TB_Participante C on C.Nro=A.CodParticipante
                        group by A.CodActividad,A.CodParticipante
                        order by Grupo",
            //'totalCount' => $totalCount,
            //'sort' =>true,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registro model.
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
     * Creates a new Registro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Registro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodRegistro]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Registro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodRegistro]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Registro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Registro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
