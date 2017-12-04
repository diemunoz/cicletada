<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Grupo;

/* @var $this yii\web\View */
/* @var $model app\models\Participante */

$this->title = $model->Nro;
$this->params['breadcrumbs'][] = ['label' => 'Participantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->Nro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->Nro], [
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
            'Nro',
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
            'ApellidoPaterno',
            'ApellidoMaterno',
            'Nombres',
            'Zona',
            'Rut',
            'Edad',
            'Telefono',
            'TallaPolera',
            'CategoriaKms',
            'Observaciones',
        ],
    ]) ?>

</div>
