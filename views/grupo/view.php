<?php

use yii\helpers\Html;
//use macgyer\yii2materializecss\widgets\grid\GridView;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = $model->Grupo;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->CodGrupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->CodGrupo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <a class="btn btn-info" data-toggle="modal" data-target="#modal">Agregar Variedades</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Grupo',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'class' => 'bordered highlight',
        'columns' => [

            [
                'label' => 'Número',
                'attribute' => 'Nro',
                'options' => ['style' => 'width:20px;'],
            ],
            'ApellidoPaterno',
            'Nombres',
            'Zona',
            'Rut',
            'Edad',
            // 'Telefono',
            // 'TallaPolera',
            // 'CategoriaKms',
            // 'Observaciones',

        ],
    ]); ?>

    <?php
        Modal::begin([
                    'header'=>'<h4>Asignación participantes: '.$model->Grupo.' </h4>',
                    'id'=>'modal',
                    'size'=>'modal-lg',
                    ]);
    ?>
    <div class="container">
        <form class="form-horizontal col-md-12" action="index.php?r=participante%2Fasignagrupo" method="post">
            <div class="form-group text-center">
                <input name="CodGrupo" type="text" value="<?= $model->CodGrupo ?>" hidden />
            </div>

            <?php echo $model->getParticipantes(); ?>

            <div class="form-group text-center">
                <input class="btn btn-primary pull-left" type="submit" value="Asignar" />
            </div>
        </form>
    </div>
    <?php
    Modal::end();
    ?>
