<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Actividad;

$this->title = 'Informes de Actividades';
?>



<div class="site-index">

    <div class="text-center"><img class="img-fluid img-responsive"  src="images/LOGOS4.png" style="display:inline; vertical-align:top; height:256px; margin-top: -10px;"></div>



    <div class="body-content">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <legend><h3 class="text-center"><?= Html::encode($this->title) ?></h3></legend>

            <p class="text-center">Ingrese los siguientes datos para descargar el informe</p>

            <br>

            <form class="form-horizontal" action="index.php?r=site%2Finforme" method="post">
                <div class="form-group col-md-12">
                    <p class="text-center"><strong>Actividad</strong></p>
                    <?php echo Select2::widget([
                                                    'name' => 'actividad',
                                                    'data' => ArrayHelper::map(Actividad::find()->where(['Estado' => 1])->asArray()->all(),'CodActividad','Actividad'),
                                                    'theme' => Select2::THEME_BOOTSTRAP,
                                                    'options' => ['placeholder' => 'Seleccione una Actividad ...','required'=>true],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]); ?>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-primary" type="submit" value="Generar" />
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>

    </div>
</div>
