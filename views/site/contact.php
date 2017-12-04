<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <center><legend><h3><?= Html::encode($this->title) ?></h3></legend></center>

    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

            <div class="alert alert-success">
                Gracias por ponerse en contacto con nosotros. Vamos a responder a usted tan pronto como sea posible.
            </div>

        <?php else: ?>

            <p>
                Si tiene consultas comerciales u otras preguntas, por favor llene el siguiente formulario para contactar con nosotros. Gracias.
            </p>

            <div class="row">
                <div class="col-lg-12">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        <?php endif; ?>
    </div>
    <div class="col-md-3"></div>

    
</div>
