<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Grupo;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ImeiEquipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Equipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodGrupo')->dropDownList(ArrayHelper::map(Grupo::find()->where(['Estado' => 1])->all(),'CodGrupo','Grupo'),
                                                                ['prompt'=>'Seleccione...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
