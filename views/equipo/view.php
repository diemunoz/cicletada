<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Grupo;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->Equipo;
$this->params['breadcrumbs'][] = ['label' => 'Celulares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->ImeiEquipo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->ImeiEquipo], [
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
            'ImeiEquipo',
            'Equipo',
            [
                'label' => 'Grupo',
                'attribute' => 'CodGrupo',
                'value' => function($model){
                    $Grupo = Grupo::findOne($model->CodGrupo);
                    if(empty($Grupo)){
                        return 'SIN GRUPO';
                    }else{
                        return $Grupo->Grupo;
                    }
                },
            ],
        ],
    ]) ?>

</div>
