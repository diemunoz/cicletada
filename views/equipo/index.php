<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Grupo;
use yii\helpers\ArrayHelper;-

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Celulares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Celular', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ImeiEquipo',
            'Equipo',
            [
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
