<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadSearch */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="actividad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Actividad') ?>

    <?= $form->field($model, 'EstadoActividad')->dropDownList((['1' => 'ACTIVA','2' => 'INACTIVA']),
                                                                ['prompt'=>'Seleccione...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
