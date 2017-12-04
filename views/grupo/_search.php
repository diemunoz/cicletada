<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoSearch */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="grupo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Grupo') ?>

    <?= $form->field($model, 'ImeiEquipo') ?>


    <?php // echo $form->field($model, 'LastModified') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
