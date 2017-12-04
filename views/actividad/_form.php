<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Actividad */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="actividad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Actividad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoActividad')->dropDownList((['1' => 'ACTIVA','2' => 'INACTIVA']),
                                                                ['prompt'=>'Seleccione...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
