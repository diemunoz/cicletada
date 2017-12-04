<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParticipanteSearch */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="participante-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Nro') ?>

    <?= $form->field($model, 'CodGrupo') ?>

    <?= $form->field($model, 'ApellidoPaterno') ?>

    <?= $form->field($model, 'ApellidoMaterno') ?>

    <?= $form->field($model, 'Nombres') ?>

    <?php echo $form->field($model, 'Zona') ?>

    <?php echo $form->field($model, 'Rut') ?>

    <?php echo $form->field($model, 'Edad') ?>

    <?php echo $form->field($model, 'Telefono') ?>

    <?php echo $form->field($model, 'TallaPolera') ?>

    <?php echo $form->field($model, 'CategoriaKms') ?>

    <?php echo $form->field($model, 'Observaciones') ?>


    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
