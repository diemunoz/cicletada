<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Nuevo Celular';
$this->params['breadcrumbs'][] = ['label' => 'Celulares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
