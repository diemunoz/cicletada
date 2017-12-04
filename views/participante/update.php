<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Participante */

$this->title = 'Modificar Participante: ' . ' ' . $model->Nro;
$this->params['breadcrumbs'][] = ['label' => 'Participantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nro, 'url' => ['view', 'id' => $model->Nro]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="participante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
