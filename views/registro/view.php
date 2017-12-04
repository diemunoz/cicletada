<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */

$this->title = $model->CodRegistro;
$this->params['breadcrumbs'][] = ['label' => 'Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CodRegistro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CodRegistro], [
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
            'CodRegistro',
            'CodParticipante',
            'CodActividad',
            'Fecha',
            'TipoRegistro',
            'ImeiEquipo',
            'Latitud',
            'Longitud',
            'Estado',
            'LastModified',
            'FechaServer',
            'RowGuidControl',
        ],
    ]) ?>

</div>
