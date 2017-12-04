<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodRegistro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodParticipante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodActividad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha')->textInput() ?>

    <?= $form->field($model, 'TipoRegistro')->textInput() ?>

    <?= $form->field($model, 'ImeiEquipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Latitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Longitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Estado')->textInput() ?>

    <?= $form->field($model, 'LastModified')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaServer')->textInput() ?>

    <?= $form->field($model, 'RowGuidControl')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
