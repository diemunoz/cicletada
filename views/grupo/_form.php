<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Grupo */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Grupo')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
