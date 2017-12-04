<?php

//use macgyer\yii2materializecss\lib\Html;
//use macgyer\yii2materializecss\widgets\grid\GridView;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Grupo;
use yii\helpers\ArrayHelper;-

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipanteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participante-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Participante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Número',
                'attribute' => 'Nro',
                'options' => ['style' => 'width:20px;'],
            ],
            [
                'label' => 'Grupo',
                'attribute' => 'CodGrupo',
                'value' => function($model){
                    $grupo = Grupo::find()->where(['Estado' => 1])->andWhere(['CodGrupo' => $model->CodGrupo])->one();
                    if(empty($grupo)){
                        return 'SIN GRUPO';
                    }else{
                        return $grupo->Grupo;
                    }
                },
                'filter' => ArrayHelper::map(Grupo::find()->where(['Estado' => 1])->asArray()->all(),'CodGrupo','Grupo'),
            ],
            'ApellidoPaterno',
            'ApellidoMaterno',
            'Nombres',
            'Zona',
            'Rut',
            //'Edad',
            // 'Telefono',
            // 'TallaPolera',
            // 'CategoriaKms',
            // 'Observaciones',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
