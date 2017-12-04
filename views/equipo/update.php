<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Modificar Celular: ' . $model->Equipo;
$this->params['breadcrumbs'][] = ['label' => 'Celulares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Equipo, 'url' => ['view', 'id' => $model->ImeiEquipo]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
