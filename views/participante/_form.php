<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Grupo;

/* @var $this yii\web\View */
/* @var $model app\models\Participante */
/* @var $form macgyer\yii2materializecss\widgets\form\ActiveForm */
?>

<div class="participante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nro')->textInput() ?>

    <?= $form->field($model, 'CodGrupo')->dropDownList(ArrayHelper::map(Grupo::find()->where(['Estado' => 1])->all(),'CodGrupo','Grupo'),
                                                                ['prompt'=>'Seleccione...']) ?>

    <?= $form->field($model, 'ApellidoPaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellidoMaterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Zona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Rut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Edad')->textInput() ?>

    <?= $form->field($model, 'Telefono')->textInput() ?>

    <?= $form->field($model, 'TallaPolera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CategoriaKms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Observaciones')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
