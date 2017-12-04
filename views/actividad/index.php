<?php

//use macgyer\yii2materializecss\lib\Html;
//use macgyer\yii2materializecss\widgets\grid\GridView;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Actividad',
            [
                'attribute' => 'EstadoActividad',
                'value' => function($model){
                    if($model->EstadoActividad == 1){
                        return 'ACTIVA';
                    }else{
                        return 'INACTIVA';
                    }
                },
                'filter' => ['1' => 'ACTIVA','2' => 'INACTIVA'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
