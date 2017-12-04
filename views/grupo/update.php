<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = 'Modificar Grupo: ' . ' ' . $model->Grupo;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Grupo, 'url' => ['view', 'id' => $model->CodGrupo]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
