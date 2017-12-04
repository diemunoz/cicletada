<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Participante;
use app\models\Actividad;
use yii\helpers\ArrayHelper;-

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Registro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*'CodRegistro',
            [
                'label' => 'Nro Participante',
                'attribute' => 'CodParticipante',
                'value' => function($model){
                    $Participante = Participante::find()->where(['Estado' => 1])->andWhere(['Nro' => $model->CodParticipante])->one();
                    if(empty($Participante)){
                        return 'SIN PARTICIPANTE';
                    }else{
                        return $Participante->Nro;
                    }
                },
                'filter' => ArrayHelper::map(Participante::find()->where(['Estado' => 1])->asArray()->all(),'Nro','Nro'),
            ],
            [
                'label' => 'Nombre Participante',
                'attribute' => 'CodParticipante',
                'value' => function($model){
                    $Participante = Participante::find()->where(['Estado' => 1])->andWhere(['Nro' => $model->CodParticipante])->one();
                    if(empty($Participante)){
                        return 'SIN PARTICIPANTE';
                    }else{
                        return $Participante->NombreCompleto;
                    }
                },
                'filter' => ArrayHelper::map(Participante::find()->where(['Estado' => 1])->asArray()->all(),'Nro','Nro'),
            ],
            [
                'label' => 'Actividad',
                'attribute' => 'CodActividad',
                'value' => function($model){
                    $Actividad = Actividad::find()->where(['Estado' => 1])->andWhere(['CodActividad' => $model->CodActividad])->one();
                    if(empty($Actividad)){
                        return 'SIN ACTIVIDAD';
                    }else{
                        return $Actividad->Actividad;
                    }
                },
                'filter' => ArrayHelper::map(Actividad::find()->where(['Estado' => 1])->asArray()->all(),'CodActividad','Actividad'),
            ],*/
            'Nro',
            'NombreCompleto',
            'Grupo',
            'Actividad',
            'IDA',
            'REGRESO',
            //'ImeiEquipo',
            // 'Latitud',
            // 'Longitud',
            // 'Estado',
            // 'LastModified',
            // 'FechaServer',
            // 'RowGuidControl',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
