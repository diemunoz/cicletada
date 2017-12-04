<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Actividad */

$this->title = $model->Actividad;
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->CodActividad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->CodActividad], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
