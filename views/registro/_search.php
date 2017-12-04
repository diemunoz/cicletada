<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodRegistro') ?>

    <?= $form->field($model, 'CodParticipante') ?>

    <?= $form->field($model, 'CodActividad') ?>

    <?= $form->field($model, 'Fecha') ?>

    <?= $form->field($model, 'TipoRegistro') ?>

    <?php // echo $form->field($model, 'ImeiEquipo') ?>

    <?php // echo $form->field($model, 'Latitud') ?>

    <?php // echo $form->field($model, 'Longitud') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'LastModified') ?>

    <?php // echo $form->field($model, 'FechaServer') ?>

    <?php // echo $form->field($model, 'RowGuidControl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
